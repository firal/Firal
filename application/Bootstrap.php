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
 * @package    Firal_Bootstrap
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * Bootstrap
 *
 * @category   Firal
 * @package    Firal_Bootstrap
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    /**
     * Initialize the plugin loader
     *
     * @return void
     */
    protected function _initPluginLoader()
    {
        $this->getPluginLoader()->addPrefixPath(
            'Firal_Application_Resource',
            'Firal/Application/Resource/'
        );
    }

    /**
     * Initialize the autoloader for the default module
     *
     * @return void
     */
    protected function _initDefaultModuleAutoloader()
    {
        $this->bootstrap('pluginLoader');
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'Default',
            'basePath'  => MODULE_PATH . DIRECTORY_SEPARATOR . 'default'
        ));
    }

    /**
     * Initialize database
     *
     * @return void
     */
    protected function _initDatabase()
    {
        $this->bootstrap('db');

        Firal_Model_Mapper_MapperAbstract::setDefaultAdapter($this->getResource('db'));
    }

    /**
     * Initialize Zend_Auth
     *
     * @return void
     */
    protected function _initAuth()
    {
        $this->bootstrap('defaultModuleAutoloader');
        $this->bootstrap('database');

        Zend_Session::start();

        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            $auth->getStorage()->write(new Default_Model_User(array(
                'role' => 'guest'
            )));
        }
    }


    /**
     * Initialize the DI container
     *
     * @return Default_DiContainer
     */
    protected function _initDiContainer()
    {
        $this->bootstrap('defaultModuleAutoloader');
        $this->bootstrap('database');
        $this->bootstrap('cachemanager');
        $this->bootstrap('modules');

        $front = $this->getResource('frontcontroller');

        $modules = $front->getControllerDirectory();

        foreach ($modules as $module => $dir) {
            $module = $this->_formatModuleName($module);
            $class  = $module . '_DiContainer';

            if (!class_exists($class, false)) {
                $file = dirname($dir) . '/DiContainer.php';

                if (file_exists($file)) {
                    require_once $file;
                } else {
                    continue;
                }
            }

            Zend_Registry::set($class, new $class(array(
                'mapper' => array(
                    'cache' => $this->getResource('cachemanager')->getCache('database')
                )
            )));
        }
    }

    /**
     * Initalize config
     *
     * @return void
     */
    protected function _initConfig()
    {
        $this->bootstrap('defaultModuleAutoloader');
        $this->bootstrap('database');
        $this->bootstrap('diContainer');

        $service = Zend_Registry::get('Default_DiContainer')->getConfigService();

        return $service->getConfig();
    }

    /**
     * Initialize the theme
     *
     * @return void
     */
    protected function _initTheme()
    {
        $this->bootstrap('config');
        $this->bootstrap('frontcontroller');
        $this->bootstrap('layout');
        $this->bootstrap('view');

        // configure the view
        $view = $this->getResource('view');

        $view->doctype(Zend_View_Helper_Doctype::XHTML1_STRICT);

        // configure the view renderer helper
        $config       = $this->getResource('config');
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');

        $viewRenderer->setTheme($config->theme);
        $viewRenderer->setThemesDirectory(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'themes');

        // setup the layout
        $frontcontroller = $this->getResource('frontcontroller');
        $layout          = Zend_Layout::getMvcInstance();
        $plugin          = $frontcontroller->getPlugin($layout->getPluginClass());

        $plugin->setTheme($config->theme);
        $plugin->setThemesDirectory(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'themes');
    }

    /**
     * Format a module name to the module class prefix
     *
     * @param  string $name
     * @return string
     */
    protected function _formatModuleName($name)
    {
        $name = strtolower($name);
        $name = str_replace(array('-', '.'), ' ', $name);
        $name = ucwords($name);
        $name = str_replace(' ', '', $name);
        return $name;
    }
}
