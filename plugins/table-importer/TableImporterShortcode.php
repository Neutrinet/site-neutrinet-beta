<?php

namespace Grav\Plugin\Shortcodes;

use DOMDocument;
use DOMElement;
use Exception;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Grav\Common\Utils;
use Symfony\Component\Yaml\Yaml;
use League\Csv\Reader;
use League\Csv\Statement;

 

class TableImporterShortcode extends Shortcode
{
    protected $outerEscape = null;

    public function init()
    {
        $this->shortcode->getHandlers()->add('ti', array($this, 'process'));
    }

    public function process(ShortcodeInterface $sc) {
        $fn = $sc->getParameter('file', null);

        //Process the file in the shortcode if no "file" param set
        if ($fn === null) {
            $fn = $sc->getShortcodeText();
            $fn = str_replace('[ti=', '', $fn);
            $fn = str_replace('/]', '', $fn);
            $fn = trim($fn);
        }

        if ( ($fn === null) && ($fn === '') ) {
            return "<p>Table Importer: Malformed shortcode (<tt>".htmlspecialchars($sc->getShortcodeText())."</tt>).</p>";
        }

        //Grab all the shortcode params
        $type = $sc->getParameter('type', null);
        $delim = $sc->getParameter('delimiter', ',');
        $encl = $sc->getParameter('enclosure', '"');
        $esc = $sc->getParameter('escape', '\\');
        $class = $sc->getParameter('class', null);
        $id = $sc->getParameter('id', null);
        $sc->getParameter('caption', null);

        $raw = filter_var(
            $sc->getParameter('raw', null), FILTER_VALIDATE_BOOLEAN);
        $header = filter_var(
            $sc->getParameter('header', null), FILTER_VALIDATE_BOOLEAN);
        $footer = filter_var(
            $sc->getParameter('footer', null), FILTER_VALIDATE_BOOLEAN);

        // Get absolute file name
        $abspath = null;
        if ($fn !== null) {
            $abspath = $this->getPath(static::sanitize($fn));
        }
        if ($abspath === null) {
            return "<p>Table Importer: Could not resolve file name '$fn'.</p>";
        }
        if (! file_exists($abspath)) {
            return "<p>Table Importer: Could not find the requested data file '$fn'.</p>";
        }

        $data = null;
        if ($type === null) {
            $type = pathinfo($fn, PATHINFO_EXTENSION);

            switch($type){

                case 'yml':
                case 'yaml':
                    $data = Yaml::parse(file_get_contents($abspath));
                    break;
            
                case 'json':
                    $data = json_decode(file_get_contents($abspath));
                    break;
                
                case 'csv':
                    $reader = Reader::createFromPath($abspath, 'r');
                    $reader->setDelimiter($delim);
                    $reader->setEnclosure($encl);
                    $this->outerEscape = $esc;
                    $reader->setEscape($esc);
    
                    $resultSet = Statement::create()->process($reader);
                    $data = iterator_to_array($resultSet,true);
                    break;

                default:
                    return "<p>Table Importer: Could not determine the type of the requested data file '$fn'. This plugin only supports YAML, JSON, and CSV.</p>";
            }
        }


        try {
            if ($data === null) {
                throw new Exception("Table Importer: Something went wrong loading '$type' data from the requested file '$fn'.");
            }

            if($header) $headerData = array_shift($data);
            if($footer) $footerData = array_pop($data);

            $doc = new DOMDocument('1.0');
            $table = $doc->createElement('table');

            if(!empty($id))
                $table->setAttribute('id', $id);

            if(!empty($class)) 
                $table->setAttribute('class', htmlspecialchars($class));

            if(!empty($caption))
                $table->appendChild(
                    $doc->createElement('caption', htmlspecialchars($caption)));
            
            if($header)
                $table->appendChild(
                    $this->createNested($doc, $headerData, 'thead', 'tr', 'th'));

            $tbody = $table->appendChild($doc->createElement('tbody'));
            
            foreach ($data as $row) {
                $tr = $tbody->appendChild($doc->createElement("tr"));
                foreach ($row as $cell) {
                    if ($raw) {
                        $tr->appendChild($doc->createElement("td", $cell));
                    } else {
                        $tr->appendChild($doc->createElement("td", htmlspecialchars($cell)));
                    }
                }
            }
            
            if($footer)
                $table->appendChild(
                    $this->createNested($doc, $footerData, 'tfoot', 'tr', 'td'));

            $doc->formatOutput = true;
            $doc->appendChild($table);
            $content = $doc->saveHTML();

            return $content;

            //TODO: Smarten this response formatting to assist with errors
        } catch (\Exception $e) {
            return '<p>The data in "'.$fn.'" appears to be malformed. Please review the documentation.</p><p>'. $e->getTraceAsString() .'</p>';
        }
    }

    private function getPath($fn) 
    {
        if (Utils::startswith($fn, 'data:')) {
            $path = $this->grav['locator']->findResource('user://data', true);
            $fn = str_replace('data:', '', $fn);
        } else {
            $path = $this->grav['shortcode']->getPage()->path();
        }
        if ( (Utils::endswith($path, DS)) || (Utils::startswith($fn, DS)) ) {
            $path = $path . $fn;
        } else {
            $path = $path . DS . $fn;
        }
        if (file_exists($path)) {
            return $path;
        }
        return null;
    }

    private static function sanitize($fn) 
    {
        $fn = trim($fn);
        $fn = str_replace('..', '', $fn);
        $fn = ltrim($fn, DS);
        $fn = str_replace(DS.DS, DS, $fn);
        return $fn;
    }
    
    private function createNested(DOMDocument $dom, array $data, string $pNode, string $rNode, string $cNode): DOMElement
    {
        $retElement = $dom->createElement($pNode);
        $rowNode = $retElement->appendChild($dom->createElement($rNode));
        
        foreach($data as $cell) {
            $rowNode->appendChild($dom->createElement($cNode, $cell));
        }

        return $retElement;
    }
}
