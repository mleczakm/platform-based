<?php
/**
 * Created by PhpStorm.
 * User: mleczakm
 * Date: 21.02.17
 * Time: 19:56
 */

namespace mleczakm\PlatformBased;


class Executor
{
    public function execute($command, $arguments = '')
    {

        passthru($command . " " . $arguments, $returnValue);

        return $returnValue;
    }

    public function commandExist($command)
    {
        $whereIsCommand = (PHP_OS == 'WINNT') ? 'where' : 'which';

        $process = proc_open(
            "$whereIsCommand $command",
            array(
                0 => array("pipe", "r"), //STDIN
                1 => array("pipe", "w"), //STDOUT
                2 => array("pipe", "w"), //STDERR
            ),
            $pipes
        );
        if ($process !== false) {
            $stdout = stream_get_contents($pipes[1]);
            $stderr = stream_get_contents($pipes[2]);
            fclose($pipes[1]);
            fclose($pipes[2]);
            proc_close($process);

            return $stdout != '';
        }

        return false;
    }
}