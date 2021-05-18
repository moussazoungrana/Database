<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use moussazoungrana\Database\DB;




$db = DB::getInstance();

$db->query(" DROP TABLE user;
CREATE TABLE user(
    id int(10)
)
");


$db->query(" INSERT into  user values (?)",[5]);


$result = $db->queryFetchOne(" SELECT id FROM  user WHERE id=?",[5]);




 var_dump($result);

 //echo $result[0]->id;

