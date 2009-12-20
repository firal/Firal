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
 * @copyright  Copyright (c) 2009 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * Abstract model collection
 *
 * @category   Firal
 * @package    Firal_Model
 * @copyright  Copyright (c) 2009 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
abstract class Firal_Model_CollectionAbstract implements Countable, SeekableIterator, ArrayAccess
{

    /**
     * Entities
     *
     * @var string
     */
    protected $_entities = array();


    /**
     * @see ArrayAccess::offsetExists()
     *
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->_entities);
    }

    /**
     * @see ArrayAccess::offsetGet()
     *
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->_entities[$offset];
    }

    /**
     * @see ArrayAccess::offsetSet()
     *
     * @param mixed $offset
     * @param mixed $value
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->_entities[$offset] = $value;
    }

    /**
     * @see ArrayAccess::offsetUnset()
     *
     * @param mixed $offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->_entities[$offset]);
    }

    /**
     * @see SeekableIterator::seek()
     *
     * @param int $index
     *
     * @throws Firal_Model_OutOfBoundsException When the seek index doesn't exist
     *
     * @return void
     */
    public function seek($index)
    {
        $this->rewind();
        $position = 0;

        while ($position < $index && $this->valid()) {
            $this->next();
            $position++;
        }

        if (!$this->valid()) {
            throw new Firal_Model_OutOfBoundsException('Seek position doesn\'t exist.');
        }
    }

    /**
     * @see SeekableIterator::current()
     *
     * @return mixed
     */
    public function current()
    {
        return current($this->_entities);
    }

    /**
     * @see SeekableIterator::next()
     *
     * @return mixed
     */
    public function next()
    {
        return next($this->_entities);
    }

    /**
     * @see SeekableIterator::key()
     *
     * @return mixed
     */
    public function key()
    {
        return key($this->_entities);
    }

    /**
     * @see SeekableIterator::valid()
     *
     * @return bool
     */
    public function valid()
    {
        return $this->_current !== false;
    }

    /**
     * @see SeekableIterator::rewind()
     *
     * @return void
     */
    public function rewind()
    {
        return reset($this->_entities);
    }

    /**
     * @see Countable::count()
     *
     * @return int
     */
    public function count()
    {
        return count($this->_entities);
    }

}