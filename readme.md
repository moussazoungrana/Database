
## Installation

You can install the package via composer:

```bash
composer require moussazoungrana/database
```

## Usage

First create a config file with your database configuration (IMPORTANT)
- Example of config file
```php 
<?php
 
 return [
   'driver' => 'mysql',
    'dbname' => 'database',
    'host' => 'localhost',
    "username" => "root",
    "password" => "",
    'charset' => 'utf8'
 ];
```

- Then Register your composer autoloader
```php
   <?php
   // After registered your composer autoloader (e.g: require_one __DIR_."/../vendor/autoload.php"
   // Register your config files
   \moz\Database\Config::instance()->register(__DIR__.'/../db.php');
   
```
- Usage example

```php 

require dirname(__DIR__) . '/vendor/autoload.php';

\moz\Database\Config::getInstance()->register('../db.php');





$db = \moz\Database\DB::getInstance();
//$db->dropDatabase('test');
$db->truncate('user');
$db->query("CREATE TABLE IF NOT EXISTS user(
    id INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    firstname VARCHAR (255),
    lastname VARCHAR (255),
    age INT
    )");
/*
$db->query(
    " INSERT INTO user(firstname,lastname,age) VALUES (:firstname,:lastname,:age)",
    ['firstname' => 'moussa', 'lastname' => 'Zoungrana', 'age' => 10]
);
$db->query(" INSERT INTO user(firstname,lastname,age) VALUES (?,?,?)", ['mike', 'kongo', 15]);
$db->query(" INSERT INTO user(firstname,lastname,age) VALUES (?,?,?)", ['kevin', 'Ilboudo', 18]);
*/

 $db->insert(
    'user',
    [
        'firstname' => 'moussa',
        'lastname' => 'Zoungrana',
        'age' => 15
    ]
);

$data =[
    'firstname' => 'kevin',
    'lastname' => 'Ilboudo',
    'age' => 15
];

$db->insert('user',$data); 

// $db->delete('user',"id = ?",[1]);

$query = $db->select('user', ['age','id'],"id=1");

var_dump($query);

//var_dump($db->queryfetchOne("SELECT * FROM user WHERE id= ? ",[1]));

```

## QueryBuilder

```php

use moz\Database\QueryBuilder;

require dirname(__DIR__) . '/vendor/autoload.php';

$db = new QueryBuilder();

 $result= $db->select('id,firstname')->from('user')->orderBy('id Desc')->run();

 var_dump($result);


```

