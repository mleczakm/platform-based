<?php
/**
 * Created by PhpStorm.
 * User: mleczakm
 * Date: 15.02.17
 * Time: 21:52
 */

namespace PlatformInstaller;


/**
 * Interface HttpRequestInterface
 * @package PlatformInstaller
 */
interface HttpRequestInterface
{
    /**
     * @param $url
     * @return string
     */
    public function get($url);

    /**
     * @return string
     */
    public function getLastError();

    /**
     * @return mixed
     */
    public function close();
}