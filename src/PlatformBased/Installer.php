<?php
/**
 * Created by PhpStorm.
 * User: mleczakm
 * Date: 15.02.17
 * Time: 20:59
 */

namespace mleczakm\PlatformBased;


use Sinergi\BrowserDetector\Os;


/**
 * Class Installer
 * @package PlatformBased
 */
class Installer
{
    /**
     * @var Downloader
     */
    private $downloader;
    /**
     * @var Unzipper
     */
    private $unZipper;
    /**
     * @var string
     */
    private $tempDirectory;
    /**
     * @var Os
     */
    private $operationSystem;

    /**
     * Installer constructor.
     * @param Downloader $downloader
     * @param UnZipper $unZipper
     * @param string $operationSystem
     * @param string $tempDirectory
     */
    public function __construct(Downloader $downloader, UnZipper $unZipper, $tempDirectory = __DIR__, $operationSystem = PHP_OS )
    {

        $this->downloader = $downloader;
        $this->unZipper = $unZipper;
        $this->tempDirectory = $tempDirectory;
        $this->operationSystem = $operationSystem;
    }

    /**
     * @param $sources [OSName => [architecture => sourceUrl], ...]
     * @param $destination
     * @throws \Exception
     */
    public function installPackage(array $sources, $destination)
    {
        $actualOs = $this->operationSystem;

        if(!isset($sources[$actualOs]))
            throw new \Exception(sprintf('Source for OS "%s" not defined!', $actualOs));

        $architecture = strlen(decbin(~0));

        if(isset($sources[$actualOs][$architecture]))
            $source = $sources[$actualOs][(string) $architecture];
        elseif (isset($sources[$actualOs]['32']))
            $source = $sources[$actualOs]['32'];
        elseif (isset($sources[$actualOs]['all']))
            $source = $sources[$actualOs]['all'];
        elseif (is_string($sources[$actualOs]))
            $source = $sources[$actualOs];
        else
            throw new \Exception(sprintf(
                'Source for OS "%s" and architecture %s or compatible not found!',
                $actualOs,
                $architecture
            ));

        $sourceName = basename($source);
        $this->downloader->download($source, $this->tempDirectory);
        $archivePath = $this->tempDirectory . DIRECTORY_SEPARATOR . $sourceName;

        if(!file_exists($archivePath))
            throw new \Exception('Downloaded source file not found.');

        $this->unZipper->unZip($archivePath, $destination);

        return;
    }
}