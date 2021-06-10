
## Installation

You can install the package via composer:

```bash
composer require moussazoungrana/database dev-master
```

## Usage


```php 


require dirname(__DIR__) . '/vendor/autoload.php';

use moussazoungrana\Database\DB;




$db = DB::getInstance();
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

use moussazoungrana\Database\QueryBuilder;

require dirname(__DIR__) . '/vendor/autoload.php';

$db = new QueryBuilder();

 $result= $db->select('id,firstname')->from('user')->orderBy('id Desc')->run();

 var_dump($result);


```

