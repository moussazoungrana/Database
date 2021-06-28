<?php

namespace moussazoungrana\Database\Config;

use PDO;

class Configg
{

    /**
     * @var string
     */
    public static $driver = 'mysql';
    /**
     * @var string
     */
    public static $host = 'localhost';

    /**
     * @var string
     */
    public static $dbname = 'test';

    /**
     * @var string
     */
    public static $username = 'root';

    /**
     * @var string
     */
    public static $password = 'Passroot@2021';

    /**
     * @var string
     */
    public static $charset = 'utf8';

    /**
     * @var array
     */
    public static $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ];




    

}