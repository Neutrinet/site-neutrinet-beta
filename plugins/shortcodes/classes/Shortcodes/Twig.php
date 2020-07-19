<?php
/**
 * Twig
 *
 * This file is part of Grav Shortcodes plugin.
 *
 * Dual licensed under the MIT or GPL Version 3 licenses, see LICENSE.
 * http://benjamin-regler.de/license/
 */

namespace Grav\Plugin\Shortcodes\Shortcodes;

use RocketTheme\Toolbox\Event\Event;
use Grav\Plugin\Shortcodes\Shortcode;

/**
 * Twig
 *
 * Render custom texts using the Twig templating engine.
 */
class Twig extends Shortcode
{
  /**
   * Get informations about the shortcode.
   *
   * @return array An associative array needed to register the shortcode.
   */
  public function getShortcode()
  {
    return ['name' => 'twig', 'type' => 'block'];
  }

  /**
   * Execute shortcode.
   *
   * @param  Event        $event An event object.
   * @return string|null         Return modified contents.
   */
  public function execute(Event $event)
  {
    /* @var \Grav\Common\Data\Data $options */
    $options = $event['options'];
    $options->setDefaults($this->defaults);

    /* @var \Grav\Common\Grav $grav */
    $grav = $event['grav'];
    $body = trim($event['body']);

    if ($template = $options->get('template')) {
      $page = clone $event['page'];
      $page->content($body);

      $content = $grav['twig']->processTemplate($template, [$page]);
    } else {
      $content = $grav['twig']->processString($body);
    }
    return $content;
  }
}
