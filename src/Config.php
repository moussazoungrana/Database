<?php

namespace moussazoungrana\Database;



class Config
{



    private static $instance;

    private $configs;

    private $files;






    private function __construct(?string $filename = null)
    {
        $this->register(__DIR__ . '/../../config.php');
        $this->load();
    }



    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Config();
        }
        return self::$instance;
    }



    public static function get($key, $default = null)
    {
        return static::getInstance()->getConfig($key) ?? $default;
    }


    public function register($filename)
    {
        $this->files = $filename;
      return  $this->load();
    }

    protected function load()
    {
       return $this->configs[] =  include $this->files;
    }


    public function getConfig(string $key)
    {
        return $this->configs[$key];
    }
}
