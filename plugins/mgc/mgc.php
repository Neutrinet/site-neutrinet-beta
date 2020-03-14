<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;
use RocketTheme\Toolbox\File\File;
use Symfony\Component\Yaml\Yaml;

class MgcPlugin extends Plugin
{
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        // Enable the main event we are interested in
        $this->enable([
            'onUserLoginRegisterData' => ['onUserLoginRegisterData',0],
            'onFormProcessed' => ['onFormProcessed',0],
            'onTwigVariables' => ['onTwigVariables', 0]
        ]);
    }

    public function onTwigVariables() {
        $this->grav['twig']->twig_vars['mgc'] =
            $this->grav['session']->getFlashObject('mgc' );
    }

    public function onUserLoginRegisterData(Event $event) {
        $data = $event['data'];
        $un = $data['username'];
        $id  = $data['hiker_id'];
        // adjust the database
        $sql =<<<SQL
            UPDATE hikers SET username="$un"
            WHERE hiker_id="$id"
SQL;
        $db = $this->grav['sqlite']['db'];
        try {
          $db->exec($sql) ;
        } catch ( \Exception $e ) {
        }
        // adjust persistent data
        $path = DATA_DIR . 'persistent' . DS . $un . '.yaml';
        $datafh = File::instance($path);
        $userinfo['hiker'] = $data['fullname'];
        $userinfo['hiked'] = $data['hiked'];
        $userinfo['hiker_id'] = $id;
        $datafh->save(Yaml::dump($userinfo));
        chmod($path, 0664);
    }

    public function onFormProcessed(Event $event) {
        $action = $event['action'];
        $form = $event['form'];
        $data = $form->getData()->toArray();
        switch ($action) {
            case 'mgc':
                $stored = $this->grav['session']->getFlashObject('mgc');
                foreach( $data as $key => $value) {
                    $stored[$key] = ($value == ' ')? null : $value;
                }
                $this->grav['session']->setFlashObject('mgc', $stored );
                $this->grav['twig']->twig_vars['mgc'] = $stored;
                break;
            case 'mgc-cleanup':
                $hkname=str_replace(' ','_', $data['hiker_name'] );
                $images = '';
                if (isset($data['images']) && is_array($data['images'])) {
                    foreach( $data['images'] as $img ) {
                        if ( file_exists($img['path']) ) {
                            $im = 'user/images/' . "$hkname-" . $this->grav['sqlite']['db']->escapeString($img['name']);
                            $images .=  "<div class=\"mgc-th\"><img src=\"$im\"><span data-src=\"$im\">Image</span></div>";
                            rename($img['path'], $im );
                        }
                    }
                }
                // for UPDATE if necessary
                $set = isset($data['meetuphike']) ? "meetuphike=\"{$data['meetuphike']}\"":'';
                if  (isset($data['images']) ) {
                    $set .= ( $set?',':'' ) . "images='$images' ";
                }
                // check on meetuphike
                if (! isset($data['meetuphike'])
                    || ! preg_match('/Self\-guided|No info|https\:\/\/www\.meetup.com\/hongkonghikingmeetup\/events\/\d+/',$data['meetuphike']))
                    {
                        $data['meetuphike'] = 'invalid';
                }
                if ( isset($data['done']) && $data['done'] ) {
                    $sql = <<<SQL
                        UPDATE treks SET $set WHERE peak="{$data['peak']}" and hiker="{$data['hiker']}"
SQL;
                } else {
                    $sql = <<<SQL
                        INSERT INTO treks (hiker, peak, meetuphike, images)
                        VALUES ( "{$data['hiker']}", "{$data['peak']}", "{$data['meetuphike']}", '{$images}')
SQL;
                }
                $this->grav['sqlite']['db']->exec($sql);
            }
    }
}