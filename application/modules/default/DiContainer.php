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
 * @package    Firal_Di
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */


/**
 * An event
 *
 * @category   Firal
 * @package    Firal_Di
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Default_DiContainer extends Firal_Di_Container_ContainerAbstract
{

    /**
     * Get the user service
     *
     * @return Default_Service_User
     */
    public function getUserService()
    {
        if (!isset($this->_services['userService'])) {
            $this->_services['userService'] = new Default_Service_User($this->getUserMapper());
        }

        return $this->_services['userService'];
    }

    /**
     * Get the user mapper
     *
     * @return Default_Model_Mapper_UserInterface
     */
    public function getUserMapper()
    {
        if (!isset($this->_services['userMapper'])) {
            $this->_services['userMapper'] = new Default_Model_Mapper_UserCache(
                new Default_Model_Mapper_User(),
                $this->_config['mapper']['cache']
            );
        }

        return $this->_services['userMapper'];
    }

    /**
     * Get the config service
     *
     * @return Default_Service_Config
     */
    public function getConfigService()
    {
        if (!isset($this->_services['configService'])) {
            $this->_services['configService'] = new Default_Service_Config($this->getConfigMapper());
        }

        return $this->_services['configService'];
    }

    /**
     * Get the config mapper
     *
     * @return Default_Model_Mapper_ConfigInterface
     */
    public function getConfigMapper()
    {
        if (!isset($this->_services['configMapper'])) {
            $this->_services['configMapper'] = new Default_Model_Mapper_ConfigCache(
                new Default_Model_Mapper_Config(),
                $this->_config['mapper']['cache']
            );
        }

        return $this->_services['configMapper'];
    }

}