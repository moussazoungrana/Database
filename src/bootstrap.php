<?php

use moussazoungrana\Database\Config;

require_once __DIR__ . DIRECTORY_SEPARATOR . '../vendor/autoload.php';
Config::getInstance()->register(__DIR__ . '/../db.php');