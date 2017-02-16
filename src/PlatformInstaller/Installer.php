<?php
/**
 * Created by PhpStorm.
 * User: mleczakm
 * Date: 15.02.17
 * Time: 20:59
 */

namespace PlatformInstaller;


use Sinergi\BrowserDetector\Os;


/**
 * Class Installer
 * @package PlatformInstaller
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
     * @param Os $operationSystem
     * @param string $tempDirectory
     */
    public function __construct(Downloader $downloader, UnZipper $unZipper, Os $operationSystem, $tempDirectory)
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
        $actualOs = $this->operationSystem->getName();

        if(!isset($sources[$actualOs]))
            throw new \Exception(sprintf('Source for OS "%s" not defined!', $actualOs));

        $architecture = strlen(decbin(~0));

        if(isset($source[$actualOs][$architecture]))
            $source = $sources[$actualOs][$architecture];
        elseif (isset($source[$actualOs]['32']))
            $source = $source[$actualOs]['32'];
        elseif (isset($source[$actualOs]['all']))
            $source = $source[$actualOs]['all'];
        elseif (is_string($source[$actualOs]))
            $source = $source[$actualOs];
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