<?php

class Backup_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function backups()
    {
    	return $this->db->select("SELECT * FROM backup");
    }
}