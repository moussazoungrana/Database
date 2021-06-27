<?php  

namespace moussazoungrana\Database;



class Config{



    private static $instance;

    private static $values ;

    private static $defaultconfigfile= __DIR__.'/../../../config.php';




    private function __construct(?string $filename = null)
    {
        
    }



    public static function getInstance()
    {
        if(is_null(self::$instance)){
            self::$instance = new Config();
        }
        return self::$instance;

    }



    public static function get($key , $default = null)
    {
        if(isset(self::$values[$key])){
            return self::$values[$key];
        }

        return $default;

    }


    public static function load($values=null)
    {
        if(!file_exists($values)){
          return  include self::$defaultconfigfile;
        }
        self::$values = $values;
        return include self::$values;
    }















}