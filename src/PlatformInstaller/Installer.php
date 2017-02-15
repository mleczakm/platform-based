<?php
/**
 * Created by PhpStorm.
 * User: mleczakm
 * Date: 15.02.17
 * Time: 20:59
 */

namespace PlatformInstaller;


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
     * Installer constructor.
     * @param Downloader $downloader
     * @param UnZipper $unZipper
     * @param string $tempDirectory
     */
    public function __construct(Downloader $downloader, UnZipper $unZipper, $tempDirectory)
    {

        $this->downloader = $downloader;
        $this->unZipper = $unZipper;
        $this->tempDirectory = $tempDirectory;
    }

    /**
     * @param $source
     * @param $destination
     * @throws \Exception
     */
    public function installPackage($source, $destination)
    {
        $sourceName = basename($source);
        $this->downloader->download($source, $this->tempDirectory);
        $archivePath = $this->tempDirectory . DIRECTORY_SEPARATOR . $sourceName;

        if(!file_exists($archivePath))
            throw new \Exception('Downloaded source file not found.');

        $this->unZipper->unZip($archivePath, $destination);

        return;
    }
}