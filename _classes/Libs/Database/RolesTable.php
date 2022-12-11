<?php

namespace Libs\Database;

class RolesTable 
{
    private $db;

    public function __construct(MySQL $mysql)
    {
        $this->db = $mysql->connect();
    }

    public function getAll()
    {
        $result = $this->db->query("SELECT * FROM roles");
		return $result->fetchAll();
    }
}