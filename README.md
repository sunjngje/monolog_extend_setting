# monolog_extend_php_setting
The monolog extension PHP configuration
#扩展的引用及实例的定义
MonologUt.php
<?php
include vendor/autoload.php';
use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
class MonologUt implements LogInterface {
    private static $log;
    private $monolog;
   private function __construct()
    {
        try{
            $this->monolog=new Logger('local');
            $dateFormat = "Y-m-d H:i:s";
            $output = "%datetime% > %channel%_%level_name% > %message% %context% %extra%".PHP_EOL;
            $formatter = new LineFormatter($output, $dateFormat);
            $stream = new RotatingFileHandler(dirname(__FILE__).'/../../../logs/funxin.log');
            $stream->setFormatter($formatter);
            $this->monolog->pushHandler($stream);
            $this->monolog->pushProcessor(function ($record){
                $record['extra'] = '';
                return $record;
            });
        }catch (Exception $e){
            echo 'error:'.$e->getMessage();
        }
    }

    public static function getInstance(){
        if (self::$log instanceof MonologUt){
            return self::$log;
        }
        else{
            self::$log = new MonologUt();
            return self::$log;
        }
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public function info($msg,$context=[]){

        $this->monolog->addInfo($msg,$context);
    }

    public function error($msg,$context=[])
    {
        $this->monolog->addError($msg,$context);

        // TODO: Implement error() method.
    }

    public function warning($msg,$context=[])
    {
        $this->monolog->addWarning($msg,$context);
        // TODO: Implement warring() method.
    }
}
?>
#接口的定义
LogInterface.php
<?php
interface LogInterface
{
    public function info($msg,$context=[]);
    public function error($msg,$context=[]);
    public function warning($msg,$context=[]);
}
#static类的定义
Log.php
<?php
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


