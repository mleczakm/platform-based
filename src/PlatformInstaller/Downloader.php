<?php
/**
 * Created by PhpStorm.
 * User: mleczakm
 * Date: 15.02.17
 * Time: 20:59
 */

namespace PlatformInstaller;

/**
 * Class Downloader
 * @package PlatformInstaller
 */
class Downloader
{
    /**
     * @var HttpRequestInterface
     */
    private $httpRequest;

    public function __construct(HttpRequestInterface $httpRequest)
    {

        $this->httpRequest = $httpRequest;
    }

    /**
     * @param $url
     * @param $destination
     * @throws \Exception
     */
    public function download($url, $destination)
    {
        $parsedUrl = parse_url($url);
        $filename = basename($parsedUrl['path']);

        $data = $this->httpRequest->get($url);
        $error = $this->httpRequest->getLastError();

        if($error)
            throw new \Exception($error);

        $file = fopen($destination . DIRECTORY_SEPARATOR . $filename, "w+");
        fputs($file, $data);
        fclose($file);

        return;
    }
}