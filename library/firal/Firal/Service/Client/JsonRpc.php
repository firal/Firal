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
 * Abstract client service
 *
 * @category   Firal
 * @package    Firal_Service
 * @subpackage Client
 * @copyright  Copyright (c) 2009-2010 Firal (http://firal.org/)
 * @license    http://firal.org/licenses/new-bsd    New BSD License
 */
class Firal_Service_Client_JsonRpc implements Firal_Service_Client_ClientInterface
{

    const JSON_RPC_VERSION = '2.0';

    /**
     * The API url
     *
     * @var string
     */
    protected $_url;

    /**
     * HTTP client
     *
     * @var Zend_Http_Client
     */
    protected $_client;

    /**
     * Request id
     *
     * @var int
     */
    protected $_id = 0;


    /**
     * Constructor
     *
     * @param string $url
     * @param Zend_Http_Client $client
     *
     * @return void
     */
    public function __construct($url, Zend_Http_Client $client = null)
    {
        if ($url instanceof Zend_Http_Client) {
            $client = $url;
            $url    = $client->getUri();
        } elseif (null === $client) {
            $client = new Zend_Http_Client($url);
        } else {
            $client->setUri($url);
        }

        $this->_url    = $url;
        $this->_client = $client;
    }

    /**
     * Magic call method to call an RPC method
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

    /**
     * Call an RPC method
     *
     * This method's name argument must be a string like:
     *
     * <namespace>.<namespace>.<method>
     *
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     */
    public function call($method, $params = array())
    {
        $request = array(
            'jsonrpc' => self::JSON_RPC_VERSION,
            'method'  => $method,
            'params'  => $params,
            'id'      => ++$this->_id
        );

        $client->setRawData(Zend_Json::encode($request), 'application/json');

        $response = Zend_Json::decode($this->_client->request(Zend_Http_Client::POST));

        if (isset($response['error'])) {
            switch ($response['error']['code']) {
                case -32700:
                case -32603:
                    throw new Firal_Service_Client_RuntimeException($response['error']['message'], $response['error']['code']);
                    break;
                case -32600:
                case -32601:
                    throw new Firal_Service_Client_BadMethodCallException($response['error']['message'], $response['error']['code']);
                    break;
                case -32602:
                    throw new Firal_Service_Client_InvalidArgumentException($response['error']['message'], $response['error']['code']);
                    break;
            }
        }

        return $response['result'];
    }
}
