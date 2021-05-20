<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use moussazoungrana\Database\DB;



$db = DB::getInstance();
//$db->truncate('user');
/*$db->query("CREATE TABLE user(
    id INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    firstname VARCHAR (255),
    lastname VARCHAR (255),
    age INT
    )");*/

/*$db->query(" INSERT INTO user(firstname,lastname,age) VALUES (?,?,?)",['moussa','Zoungrana',10]);
$db->query(" INSERT INTO user(firstname,lastname,age) VALUES (?,?,?)",['mike','kongo',15]);
$db->query(" INSERT INTO user(firstname,lastname,age) VALUES (?,?,?)",['kevin','Ilboudo',18]);*/


$query = $db->select('user',['firstname','lastname','age']);
var_dump($query);