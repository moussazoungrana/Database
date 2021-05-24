<?php

namespace moussazoungrana\Database;


class QueryBuilder
{

    protected $query;


    public function __construct()
    {
        $this->query=DB::getInstance();
    }

}