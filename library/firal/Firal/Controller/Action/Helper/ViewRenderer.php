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
 * @package    Firal_Controller
 * @subpackage Action_Helper
 * @copyright  Copyright (c) 2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * Bootstrap
 *
 * @category   Firal
 * @package    Firal_Controller
 * @subpackage Action_Helper
 * @copyright  Copyright (c) 2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Firal_Controller_Action_Helper_ViewRenderer extends Zend_Controller_Action_Helper_ViewRenderer
{

    /**
     * Current theme
     *
     * @var string
     */
    protected $_theme = '';


    /**
     * Get the base path
     *
     *
     */
    protected function _getBasePath()
    {
        $path = parent::_getBasePath();

        echo $path;

        return $path;
    }

    /**
     * Set the theme
     *
     * @param string $theme
     *
     * @return Firal_Controller_Action_Helper_ViewRenderer
     */
    public function setTheme($theme)
    {
        $this->_theme = $theme;

        return $this;
    }

    /**
     * Get the theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->_theme;
    }

}