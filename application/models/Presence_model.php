<?php

class Presence_model extends CI_Model
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function insert_into($table_name, $data)
    {
        $this->db->insert_batch($table_name, $data);
    }
}