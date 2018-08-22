<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/22
 * Time: 10:57
 */

interface LogInterface
{

    public function info($msg,$context=[]);
    public function error($msg,$context=[]);
    public function warning($msg,$context=[]);

}