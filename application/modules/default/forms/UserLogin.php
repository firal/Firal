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
 * @package    Default_Forms
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * User model mapper class
 *
 * @category   Firal
 * @package    Default_Forms
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Default_Form_UserLogin extends Zend_Form
{

    /**
     * Init function
     *
     * @return void
     */
    public function init()
    {
        $this->addElement('text', 'username', array(
            'validators' => array(
                array('StringLength', false, array(4, 30))
            ),
            'label'      => 'Username',
            'required'   => true
        ));
        $this->addElement('password', 'password', array(
            'validators' => array(
                array('StringLength', false, array(6, 30))
            ),
            'label'      => 'Password',
            'required'   => true
        ));
        $this->addElement('submit', 'submit', array(
            'label'      => 'Login'
        ));
    }
}