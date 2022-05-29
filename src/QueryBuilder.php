<?php

namespace moz\Database;


class QueryBuilder
{

    protected $db;

    //protected $table = [];

    protected $select = [];

    protected $from = [];

    protected $join = [];

    protected $orderBy = [];

    protected $where = [];


    public function __construct()
    {
        $this->db=DB::getInstance();
    }


    public function select(string $statement="*")
    {
        $this->select[] = $statement;

        return $this;

    }


    public function from(string $statement)
    {
        $this->from[]=$statement;

        return $this;
    }


    public function join(string $column)
    {
        $this->join[] = $column;

        return $this;

    }


    public function orderBy(string $column)
    {
        $this->orderBy[] = $column;

        return $this;

    }


    public function run()
    {
        if(isset($this->select)){

            $columns = implode(',', $this->select);
            $table = implode(',', $this->from);
            $orderBy= implode(',', $this->orderBy);


         return  $this->db->queryfetchAll("SELECT {$columns} FROM {$table} ORDER BY {$orderBy}");

        }
       
    }









}