<?php
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: mleczakm
 * Date: 15.02.17
 * Time: 21:43
 */
class DownloaderTest extends TestCase
{
    /**
     * @test
     */
    public function downloadsExampleFileAndPutsToDestinationDirectory()
    {
        $httpRequestMock = $this->createMock('GuzzleHttp\ClientInterface');
        $httpResponseMock = $this->createMock('\GuzzleHttp\Psr7\Response');
        $httpResponseMock->method('getBody')->willReturn('exampleZipArchiveContent');
        $httpRequestMock->method('request')->willReturn($httpResponseMock);

        $downloader = new \PlatformInstaller\Downloader($httpRequestMock);

        $downloader->download('filename.zip', '.');

        $this->assertFileExists('filename.zip');

        unlink('filename.zip');
    }
}