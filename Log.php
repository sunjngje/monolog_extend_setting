<?php

//include_once 'MonologUtUt.php';
class Log{
    public static function info($msg,$context=[]){
        $data = debug_backtrace();
        $script =' [msg] : '. $msg .'|| script file path in : ' . $data[0]['file'].' || line : '.$data[0]['line'];
    $log =MonologUt::getInstance();
        $context['ip']=get_ip();
    $log->info($script,$context);
    }

    public static function error($msg,$context=[])
    {
        //var_dump(debug_backtrace());die;
        $data = debug_backtrace();
        $script =' [msg] : '. $msg .' || script file path in : ' . $data[0]['file'].' || class : '.$data[1]['class'].' || function : '.$data[1]['function'].' || line : '.$data[0]['line'];
        $log =MonologUt::getInstance();
        $context['ip']=get_ip();
        $log->error($script,$context);
        // TODO: Implement error() method.
    }

    public static function warning($msg,$context=[])
    {
        $data = debug_backtrace();
        $script =' [msg] : '. $msg .' || script file path in : ' . $data[0]['file'].' || class : '.$data[1]['class'].' || function : '.$data[1]['function'].' || line : '.$data[0]['line'];
        $log =MonologUt::getInstance();
        $context['ip']=get_ip();
        $log->warning($script,$context);
        // TODO: Implement warring() method.
    }
}