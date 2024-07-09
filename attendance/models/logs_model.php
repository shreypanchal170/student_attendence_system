<?php

class Logs_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function logs()
    {
    	return $this->db->select("SELECT user_log.*, user.firstname, user.lastname FROM user_log LEFT JOIN user ON user.userid = user_log.userid ORDER BY user_log.datelog DESC");
    }
}