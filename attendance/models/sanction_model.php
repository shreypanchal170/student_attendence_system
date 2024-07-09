<?php

class Sanction_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getLists()
    {
    	return $this->db->select("SELECT * FROM sanction");
    }

    public function getSanctionInfo($sanctionId)
    {
    	return $this->db->selectSingleData("SELECT * FROM sanction WHERE sanction_id = $sanctionId");
    }

    public function getSanctionLists()
    {
    	$lists = $this->getLists();

    	$data = array();

    	foreach($lists as $item)
    	{
    		$data[] = array($item['item_name'], $item['no_of_absences'], '<a class="btn btn-xs btn-success modalMode" href="'.URL.'sanction/edit/'.$item['sanction_id'].'"><i class="fa fa-edit"></i></a>');
    	}	

    	return json_encode( array("data" => $data) );
    }

    public function add($POST)
    {
    	if(trim($POST['item_name']) == "")
        {
            return array("result" => -1, "reason" => "Item Name must not be empty");
        }

        if(trim($POST['no_of_absences']) == "")
        {
            return array("result" => -1, "reason" => "No of Absences must not be empty");
        }

        if(!is_numeric($POST['no_of_absences']))
        {
            return array("result" => -1, "reason" => "No of Absences must be numeric");
        }

        if(strlen($POST['no_of_absences']) > 2)
        {
            return array("result" => -1, "reason" => "Length must not exceed to digits");
        }

        $checkItem = $this->db->selectSingleData("SELECT * FROM sanction WHERE item_name = '{$POST['item_name']}'");

        if($checkItem != null)
        {
        	return array("result" => -1, "reason" => "Item already exists");
        }

        $this->db->insert("sanction", $POST);

        return array("result" => 1, "reason" => "Item successfully added.");
    }

    public function update($sanctionId, $POST)
    {
    	if(trim($POST['item_name']) == "")
        {
            return array("result" => -1, "reason" => "Item Name must not be empty");
        }

        if(trim($POST['no_of_absences']) == "")
        {
            return array("result" => -1, "reason" => "No of Absences must not be empty");
        }

        if(!is_numeric($POST['no_of_absences']))
        {
            return array("result" => -1, "reason" => "No of Absences must be numeric");
        }

        if(strlen($POST['no_of_absences']) > 2)
        {
            return array("result" => -1, "reason" => "Length must not exceed to digits");
        }

        $checkItem = $this->db->selectSingleData("SELECT * FROM sanction WHERE sanctionid = {$sanctionId} AND item_name = '{$POST['item_name']}'");

        if($checkItem != null)
        {
        	return array("result" => -1, "reason" => "Item already exists");
        }

        $this->db->update("sanction", $POST, "sanction_id = $sanctionId");

        return array("result" => 1, "reason" => "Item successfully updated.");
    }
}