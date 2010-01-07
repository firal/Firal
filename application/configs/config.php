<?php
return array_merge_recursive(array(
    'bootstrap' => array(
        'path'  => APPLICATION_PATH . '/Bootstrap.php',
        'class' => 'Bootstrap'
    ),
    'autoloaderNamespaces' => array(
        'Firal_'
    ),
    'resources'   => array(
        'frontController' => array(
            'moduleDirectory' => APPLICATION_PATH . '/modules'
        ),
        'modules' => array(),
        'view' => array(),
        'layout' => array(
            'layout'     => 'layout',
            'layoutPath' => APPLICATION_PATH . '/layouts/scripts'
        ),
        'db' => array(
            'adapter' => 'pdo_mysql'
        ),
        'cachemanager' => array(
            'database' => array(
                'frontend' => array(
                    'name'    => 'Core',
                    'options' => array(
                        'automatic_serialization' => true
                    )
                ),
                'backend'  => array()
            )
        )
    )
), include dirname(__FILE__) . '/' . APPLICATION_ENV . '.config.php');