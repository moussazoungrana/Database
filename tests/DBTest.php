<?php

namespace moussazoungrana\Database\Test;

use moussazoungrana\Database\DB;
use PDO;
use PDOStatement;
use PHPUnit\Framework\TestCase;

class DBTest extends TestCase
{

    public function testQuery()
    {
        $db=DB::getInstance();
        $query =$db->query("SELECT * FROM test.user WHERE id = ?",[5]);
        $this->assertInstanceOf(PDOStatement::class,$query);
    }


    public function testGetPDO()
    {
        $pdo=DB::getInstance()->getPDO();
        $this->assertInstanceOf(PDO::class,$pdo);

    }
}
