<?php

namespace moussazoungrana\Database;

//use moussazoungrana\Database\Config\Config;
use PDO;
use PDOStatement;

class DB
{
    /**
     * @var DB
     */
    private static $instance;
    /**
     * @var PDO
     */
    private $pdo;


    /**
     * DB constructor.
     */
    private function __construct()
    {
        $config = Config::get('db');
        $dns = $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset'];
        $this->pdo = new PDO($dns, $config['username'], $config['password'], $this->getOptions());
    }


    /**
     * @return DB
     */
    public static function getInstance(): DB
    {
        if (is_null(self::$instance)) {
            self::$instance = new DB();
        }
        return self::$instance;
    }


    /**
     * Perform a database query
     * @param string $statement
     * @param array|null $option
     * @return false|PDOStatement
     */
    public function query(string $statement, ?array $option = null)
    {
        $query = $this->getPDO()->prepare($statement);
        $query->execute($option);

        return $query;
    }

    /**
     * Perform a database query and fetch One row
     * @param string $statement
     * @param array|null $option
     * @param null $fetch_style
     * @return mixed
     */
    public function queryfetchOne(string $statement, ?array $option = null, $fetch_style = null)
    {
        $query = $this->query($statement, $option);
        return $query->fetch($fetch_style);
    }

    /**
     * Perform a database query and fetch all row
     * @param string $statement
     * @param array|null $option
     * @param null $fetch_style
     * @return array
     */
    public function queryfetchAll(string $statement, ?array $option = null, $fetch_style = null): array
    {
        $query = $this->query($statement, $option);
        return $query->fetchAll($fetch_style);
    }


    /**
     * Get Connection to the database
     * @return PDO
     */
    public function getPDO(): PDO
    {
        return $this->pdo;
    }

    /**
     * @param string $table
     * @param array|string[] $columns
     * @param string|null $condition
     * @return array
     */
    public function select(string $table, array $columns = ['*'], ?string $condition = null)
    {
        $columns = implode(',', $columns);

        if (!is_null($condition)) {

            return $this->queryfetchAll("SELECT {$columns} FROM {$table} WHERE {$condition}");
        }

        return $this->queryfetchAll("SELECT {$columns} FROM {$table}");
    }


    /**
     * @param string $table
     * @param array $data
     * @return false|PDOStatement
     */
    public function insert(string $table, array $data)
    {
        $sql = "INSERT INTO {$table}";
        $columns = "(" . implode(',', array_keys($data)) . ")";
        $values = " VALUES (:" . implode(',:', array_keys($data)) . ")";

        return $this->query($sql . $columns . $values, $data);
    }


    /**
     * @param string $table
     * @param string $condition
     * @param array|null $data
     * @return false|PDOStatement
     */
    public function delete(string $table, string $condition, ?array $data = null)
    {
        return $this->query(" DELETE FROM {$table} WHERE {$condition} ", $data);
    }


    /**
     * Truncate table
     * @param string $table
     * @return false|PDOStatement
     */
    public function truncate(string $table)
    {
        return $this->query("TRUNCATE TABLE {$table}");
    }


    /**
     * @param string $table
     * @return false|PDOStatement
     */
    public function dropTable(string $table)
    {
        return $this->query("DROP TABLE {$table}");
    }

    public function dropDatabase(string $database)
    {
        return $this->query(" DROP DATABASE IF EXISTS {$database} ");
    }


    protected function getOptions()
    {
        return [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];
    }


}
