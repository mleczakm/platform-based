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
}