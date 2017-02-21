<?php

use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: mleczakm
 * Date: 21.02.17
 * Time: 20:25
 */
class ExecutorTest extends TestCase
{
    /**
     * @test
     */
    public function runCommandWithoutExeFileExtensionOnLinuxAndMac()
    {
        $executor = new \mleczakm\PlatformBased\Executor();

        ob_start();
        $executor->execute('echo', 'test');
        $output = ob_get_contents();
        ob_end_flush();

        $this->assertEquals('test', $output);
    }
}
