<?php

use moussazoungrana\Database\QueryBuilder;

require dirname(__DIR__) . '/vendor/autoload.php';

$db = new QueryBuilder();

 $result= $db->select('id,firstname')->from('user')->orderBy('id Desc')->run();

 var_dump($result);














?>