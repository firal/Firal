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
 * @package    Firal_Service
 * @subpackage Client
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */

/**
 * XmlRpc Client
 *
 * @category   Firal
 * @package    Firal_Service
 * @subpackage Client
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Firal_Service_Client_XmlRpc extends Zend_XmlRpc_Client implements Firal_Service_Client_ClientInterface
{

    /**
     * The API url
     *
     * @var string
     */
    protected $_url;

    /**
     * Service map
     *
     * @var unkown
     * @todo determine the type of this variable
     */
    protected $_serviceMap;


    /**
     * Constructor
     *
     * @param string $url
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->_url = $url;
        parent::__construct($url);
    }

    /**
     * Magic call method must proxy through to call()
     *
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     */
    public function __call($name, array $arguments)
    {
        return $this->call($name, $arguments);
    }

    /**
     * Magic get method to get a namespace
     *
     * @param string $name
     *
     * @return Firal_Service_Client_Namespace
     */
    public function __get($name)
    {
        return new Firal_Service_Client_Namespace($this, $name);
    }
}
