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
 * Dependency Injection container for the Pages module
 *
 * @category   Firal
 * @package    Firal_Di
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Pages_DiContainer extends Firal_Di_Container_ContainerAbstract
{

    /**
     * Get the page service
     *
     * @return Pages_Service_Page
     */
    public function getPageService()
    {
        if (!isset($this->_storage['pageService'])) {
            $this->_storage['pageService'] = new Pages_Service_Page($this->getPageMapper());
        }

        return $this->_storage['pageService'];
    }

    /**
     * Get the page mapper
     *
     * @return Default_Model_Mapper_PageInterface
     */
    public function getPageMapper()
    {
        if (!isset($this->_storage['pageMapper'])) {
            $this->_storage['pageMapper'] = new Default_Model_Mapper_Page();
        }

        return $this->_storage['pageMapper'];
    }
}
