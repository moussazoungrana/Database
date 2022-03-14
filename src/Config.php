<?php

namespace moussazoungrana\Database;



use Composer\Autoload\ClassLoader;
use moussazoungrana\Database\Helpers\Arr;

class Config
{

    protected static $instance = null;

    protected array $configs = [];

    protected array $files = [];


    private function __construct(?string $filename = null)
    {
        if(is_null($filename)){
            $reflection = new \ReflectionClass(ClassLoader::class);
            $root = dirname($reflection->getFileName(), 2);
            $filename = realpath($root . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . "db.php");
        }
        $this->register($filename);
        $this->load();
    }


    public static function getInstance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public static function get($key, $default = null)
    {
        return static::getInstance()->getConfigs($key) ?? $default;
    }


    public function register(?string $filename)
    {
        if (is_dir($filename)) {
            $this->files = array_merge($this->getFiles(), glob($filename . '**/*.php'));
        } else {
            $this->files[] = $filename;
        }
        $this->load();
    }

    protected function load()
    {
        foreach ($this->getFiles() as $file) {
            $name = basename($file, '.php');
            $this->configs[$name] = include $file;
        }
    }


    public function getConfigs(string $key)
    {
        return Arr::get($this->configs, $key);
    }

    /**
     * @return array
     */
    public function getFiles(): array
    {
        return $this->files;
    }
}
