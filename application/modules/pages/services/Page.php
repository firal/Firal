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
 * @package    Pages_Services
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * Page service class
 *
 * @category   Firal
 * @package    Pages_Services
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Pages_Service_Page extends Firal_Service_ServiceAbstract
{

    /**
     * Datamapper used for articles
     *
     * @var Pages_Model_Mapper_PageInterface
     */
    protected $_mapper;

    
    /**
     * Constructor
     *
     * @param Pages_Model_Mapper_PageInterface $mapper
     *
     * @return void
     */
    public function __construct(Pages_Model_Mapper_PageInterface $mapper)
    {
        $this->_mapper = $mapper;
    }

    /**
     * Setup default privileges
     *
     * Empty for now, there should be some setup code later
     *
     * @return void 
     */
    protected function _setupPrivileges()
    {

    }

    /**
     * Get one page by its name
     *
     * @param string $name
     *
     * @return Pages_Model_Page
     */
    public function getPage($name)
    {
        return $this->_mapper->fetchByName($name);
    }
}
