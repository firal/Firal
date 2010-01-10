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
 * @package    Firal_Model
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * Abstract model
 *
 * Fields for a model are defined by doing:
 *
 * <code>
 * protected $_<fieldname>;
 * </code>
 *
 * The __get() and __set() magic functions will route any requests to the
 * get<fieldname> and set<fieldname> methods, if that method doesn't exist for
 * the requested fieldname, they will throw an OutOfBoundsException.
 *
 * @category   Firal
 * @package    Firal_Model
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
abstract class Firal_Model_ModelAbstract
{

    /**
     * Magic __get() function
     *
     * @param string $field
     *
     * @throws Firal_Model_OutOfBoundsException
     *
     * @return mixed
     */
    public function __get($field)
    {
        $method = 'get' . ucfirst($field);

        if (method_exists($this, $method)) {
            return $this->$method();
        }

        throw new Firal_Model_OutOfBoundsException('Field with name ' . $field
                                                 . ' does not exist or doesn\'t have a getter');
    }

    /**
     * Magic __set() function
     *
     * @param string $field
     * @param mixed $value
     *
     * @throws Firal_Model_OutOfBoundsException
     *
     * @return void
     */
    public function __set($field, $value)
    {
        $method = 'set' . ucfirst($field);

        if (method_exists($this, $method)) {
            return $this->$method($value);
        }

        throw new Firal_Model_OutOfBoundsException('Field with name ' . $field
                                                 . ' does not exist or doesn\'t have a setter');
    }

}