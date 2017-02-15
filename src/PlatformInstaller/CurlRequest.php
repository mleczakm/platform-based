<?php
/**
 * Created by PhpStorm.
 * User: mleczakm
 * Date: 15.02.17
 * Time: 21:53
 */

namespace PlatformInstaller;


/**
 * Class CurlRequest
 * @package PlatformInstaller
 */
class CurlRequest implements HttpRequestInterface
{
    /**
     * @var null|resource
     */
    private $handle = null;

    /**
     * CurlRequest constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $this->handle = curl_init($url);
        curl_setopt($this->handle, CURLOPT_RETURNTRANSFER, 1);
    }


    /**
     *
     */
    public function close()
    {
        curl_close($this->handle);
    }

    /**
     * @param $url
     * @return string
     */
    public function get($url)
    {
        curl_setopt($this->handle, CURLOPT_URL, $url);

        return curl_exec($this->handle);
    }

    /**
     * @return string
     */
    public function getLastError()
    {
        return curl_error($this->handle);
    }
}
