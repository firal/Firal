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
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * ViewRenderer action helper
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
    protected $_theme;

    /**
     * Themes directory
     *
     * @var string
     */
    protected $_themesDirectory;


    /**
     * Render, and add the theme directory as base path
     *
     * @return void
     */
    public function render($action = null, $name = null, $noController = null)
    {
        $this->view->addBasePath($this->getThemeDirectory());

        parent::render($action, $name, $noController);
    }

    /**
     * Get the theme directory
     *
     * @return string
     */
    public function getThemeDirectory()
    {
        return $this->_themesDirectory
             . DIRECTORY_SEPARATOR . $this->_theme
             . DIRECTORY_SEPARATOR . $this->getModule();
    }

    /**
     * Get the themes directory
     *
     * @return string
     */
    public function getThemesDirectory()
    {
        return $this->_themesDirectory;
    }

    /**
     * Set the themes directory
     *
     * @param string $themesDirectory
     *
     * @return Firal_Controller_Action_Helper_ViewRenderer
     */
    public function setThemesDirectory($themesDirectory)
    {
        $this->_themesDirectory = $themesDirectory;

        return $this;
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
