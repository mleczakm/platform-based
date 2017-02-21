<?php
/**
 * Created by PhpStorm.
 * User: mleczakm
 * Date: 15.02.17
 * Time: 20:59
 */

namespace mleczakm\PlatformBased;
use GuzzleHttp\ClientInterface;

/**
 * Class Downloader
 * @package PlatformBased
 */
class Downloader
{
    /**
     * @var
     */
    private $httpClient;

    public function __construct(ClientInterface $httpClient)
    {

        $this->httpClient = $httpClient;
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
        $data = (string) $this->httpClient->request('GET', $url)->getBody();

        $file = fopen($destination . DIRECTORY_SEPARATOR . $filename, "w+");
        fputs($file, $data);
        fclose($file);

        return;
    }
}