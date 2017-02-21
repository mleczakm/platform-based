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

        exec($command . " " . $arguments, $output, $returnValue);

        echo implode("\n", $output);

        return $returnValue;
    }
}