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
        if (!isset($this->_storage['userService'])) {
            $this->_storage['userService'] = new Default_Service_User($this->getUserMapper());
        }

        return $this->_storage['userService'];
    }

    /**
     * Get the user mapper
     *
     * @return Default_Model_Mapper_UserInterface
     */
    public function getUserMapper()
    {
        if (!isset($this->_storage['userMapper'])) {
            $this->_storage['userMapper'] = new Default_Model_Mapper_UserCache(
                new Default_Model_Mapper_User(),
                $this->_config['mapper']['cache']
            );
        }

        return $this->_storage['userMapper'];
    }

    /**
     * Get the config service
     *
     * @return Default_Service_Config
     */
    public function getConfigService()
    {
        if (!isset($this->_storage['configService'])) {
            $this->_storage['configService'] = new Default_Service_Config($this->getConfigMapper());
        }

        return $this->_storage['configService'];
    }

    /**
     * Get the config mapper
     *
     * @return Default_Model_Mapper_ConfigInterface
     */
    public function getConfigMapper()
    {
        if (!isset($this->_storage['configMapper'])) {
            $this->_storage['configMapper'] = new Default_Model_Mapper_ConfigCache(
                new Default_Model_Mapper_Config(),
                $this->_config['mapper']['cache']
            );
        }

        return $this->_storage['configMapper'];
    }
}
