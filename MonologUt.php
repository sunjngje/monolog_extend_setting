<?php
//namespace log;
//echo dirname(__FILE__).'/../../vendor/autoload.php';
include dirname(__FILE__).'/../../vendor/autoload.php';

use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
class MonologUt implements LogInterface {
    private static $log;
    private $monolog;


/*    private function MonologUt(){
        echo 'dd777777777777777dd';
        try{
            $this->monolog=new Logger();
            echo 'dddd';
            $this->monolog->pushHandler(new \Monolog\Handler\RotatingFileHandler());
            throw new RuntimeException('dddd-----');
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }*/

   private function __construct()
    {
        try{
            $this->monolog=new Logger('local');
            //echo '_____2______';
            $dateFormat = "Y-m-d H:i:s";
            $output = "%datetime% > %channel%_%level_name% > %message% %context% %extra%".PHP_EOL;
            $formatter = new LineFormatter($output, $dateFormat);
            $stream = new RotatingFileHandler(dirname(__FILE__).'/../../../logs/funxin.log');
            $stream->setFormatter($formatter);
            //$this->monolog->pushHandler(new RotatingFileHandler(dirname(__FILE__).'/../../../logs/funxin.log'));
            $this->monolog->pushHandler($stream);
            $this->monolog->pushProcessor(function ($record){
                //$record['extra']['dummy'] = 'log';
                $record['extra'] = '';
                return $record;
            });
           // $log->pushHandler(new StreamHandler('path/to/your.log', Logger::WARNING));
            //$logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));
//            throw new RuntimeException('_____2-1______');
        }catch (Exception $e){
            echo 'error:'.$e->getMessage();
        }
    }

//    public static function processor($arr){
//        $arr['extra']='';
//        return $arr;
//    }
    public static function getInstance(){

        //echo '____3_____';

        if (self::$log instanceof MonologUt){
            //echo '____3-1_____';
            return self::$log;
        }
        else{
            self::$log = new MonologUt();
            //echo '____3-2_____';
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