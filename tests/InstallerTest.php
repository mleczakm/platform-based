<?php
use mleczakm\PlatformBased\Downloader;
use mleczakm\PlatformBased\Installer;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: mleczakm
 * Date: 21.02.17
 * Time: 20:27
 */
class InstallerTest extends TestCase
{

    /**
     * @test
     */
    public function downloadRightPackageVersionBasedOnOsVersion()
    {
        $installer = new Installer(
            new Downloader(new GuzzleHttp\Client()),
            new \mleczakm\PlatformBased\UnZipper(),
            '/tmp',
            'LINUX'
        );

        $dirName = md5(microtime());

        mkdir( '/tmp' . DIRECTORY_SEPARATOR . $dirName);

        $installer->installPackage(
            array(
                'linux' => array('64' => 'http://downloads.pulpo18.com/1.1.0.47/Pulpo-1.1.0.47-Linux-all-64bit.zip')
            ),
            '/tmp' . DIRECTORY_SEPARATOR . $dirName
        );

        $this->assertFileExists('/tmp' . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . 'Pulpo');
    }
}
