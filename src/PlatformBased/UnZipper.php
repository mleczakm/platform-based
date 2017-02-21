<?php
/**
 * Created by PhpStorm.
 * User: mleczakm
 * Date: 15.02.17
 * Time: 21:03
 */

namespace mleczakm\PlatformBased;


/**
 * Class UnZipper
 * @package PlatformBased
 */
class UnZipper
{
    /**
     * UnZipper constructor.
     */
    public function __construct()
    {
        $this->zipArchive = new \ZipArchive();
    }

    /**
     * @param $archivePath
     * @param $destination
     * @throws \Exception
     */
    public function unZip($archivePath, $destination)
    {
        if ($this->zipArchive->open($archivePath) !== true)
            throw new \Exception('Archive could not be opened.');

        $this->zipArchive->extractTo($destination);
        $this->zipArchive->close();

        return;
    }
}