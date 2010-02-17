<?php
/**
 * Firal
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://firal.org/licenses/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to firal-dev@googlegroups.com so we can send you a copy immediately.
 *
 * @category   Firal
 * @package    Firal_Application
 * @subpackage Resource
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * View resource
 *
 * @category   Firal
 * @package    Firal_Application
 * @subpackage Resource
 * @copyright  Copyright (c) 2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Firal_Application_Resource_Plugin extends Zend_Application_Resource_ResourceAbstract
{


    /**
     * Initialize this resource
     *
     * @return Firal_Event_Dispatcher
     */
    public function init()
    {
        $dispatcher = new Firal_Event_Dispatcher();
        Firal_Plugin::setDefaultDispatcher($dispatcher);

        // initialize the plugins
        $options = $this->getOptions();

        // loop through the plugins path, and initialize them
        $dir = new DirectoryIterator($options['path']);

        foreach ($dir as $file) {
            if ($file->isFile() && (substr($file->getFilename(), -4, 4) == '.php')) {
                $class = 'Plugin_' . $this->_formatPluginName(substr($file->getFilename(), 0, -4));

                include_once $file->getPath() . DIRECTORY_SEPARATOR . $file->getFilename();

                if (!class_exists($class)) {
                    throw new Firal_Application_Resource_RuntimeException("Plugin file '{$file->getFilename()}' is found, but '{$class}' does not exist.");
                }

                // initialize the plugin
                new $class;
            }
        }

        return $dispatcher;
    }

    /**
     * Format a plugin name
     *
     * @param string $name
     *
     * @return string
     */
    protected function _formatPluginName($name)
    {
        return ucfirst(strtoupper($name));
    }
}
