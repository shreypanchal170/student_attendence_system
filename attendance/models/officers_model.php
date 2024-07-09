<?php

class Officers_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getOfficers()
    {
    	return $this->db->select("SELECT * FROM user WHERE position = 'officer' AND semester = ".$this->currentSemester()." AND schoolyear = '".$this->currentSchoolYear()."'");
    }

    public function getOfficerInfo($officerId)
    {
        return $this->db->selectSingleData("SELECT * FROM user WHERE userid = $officerId");
    }

    public function getOfficersLists()
    {
    	$lists = $this->getOfficers();

    	$data = array();

    	foreach($lists as $item)
    	{
    		$name = $item['lastname'] . ", " . $item['firstname'] . ((trim($item['middlename']) != "") ? " " . $item['middlename'] : "");
    		$data[] = array($name, $item['position_description'], $item['mobile'], '<a class="btn btn-xs btn-success" href="'.URL.'officers/edit/'.$item['userid'].'"><i class="fa fa-edit"></i></a> <a class="btn btn-xs btn-success" href="'.URL.'officers/events/'.$item['userid'].'"><i class="fa fa-list"></i></a>');
    	}	

    	return json_encode( array("data" => $data) );
    }

    public function getOfficerEvents($officerId)
    {
        return $this->db->select("SELECT event.*, event_officer.status AS assignedSession FROM event LEFT JOIN event_officer ON event_officer.eventid = event.eventid WHERE event_officer.userid = $officerId AND event.semester = ".$this->currentSemester()." AND event.schoolyear = '".$this->currentSchoolYear()."'");
    }

    public function add($POST)
    {
    	$checkUser = $this->db->selectSingleData("SELECT * FROM user WHERE username = '{$POST['username']}'");

    	if($checkUser != null)
    	{
    		return array("result" => -1, "reason" => "Username already taken.");
    	}

    	$hasMiddlename = "";

    	if(trim($POST['middlename']) != "")
    	{
    		$hasMiddlename = " AND middlename = '{$POST['middlename']}'";
    	}

        if(trim($POST['mobile']) == "")
        {
            return array("result" => -2, "reason" => "Mobile Number cannot be empty");
        }

        if(!is_numeric($POST['mobile']) || strlen($POST['mobile']) != 10)
        {
            return array("result" => -3, "reason" => "Invalid Mobile Number");
        }

    	$checkName = $this->db->selectSingleData("SELECT * FROM user WHERE firstname = '{$POST['firstname']}' AND lastname = '{$POST['lastname']}'".$hasMiddlename);

    	if($checkName != null)
    	{
    		return array("result" => -2, "reason" => "Name already exist.");
    	}

        if($POST['image'] != "")
        {
            $ext = $this->getStringBetween($POST['image'], "data:image/", ";base64,");
            $image = str_replace("data:image/".$ext.";base64,", "", $POST['image']);
            $POST['image'] = $this->base64ToImageFile($image, $ext, UPLOAD_DIR . "user/");
        }

    	$POST['password'] = Hash::create('sha256', $POST['password'], HASH_PASSWORD_KEY);

    	$dataArr = array(
            "semester" => $this->currentSemester(),
            "schoolyear" => $this->currentSchoolYear()
        );

        $dataArr = array_merge($dataArr, $POST);

    	$this->db->insert("user", $dataArr);

    	return array("result" => 1, "reason" => "Officer successfully added.");
    }

    public function update($officerId, $POST)
    {
        $info = $this->getOfficerInfo($officerId);

        $checkUser = $this->db->selectSingleData("SELECT * FROM user WHERE username = '{$POST['username']}' AND userid != $officerId");

        if($checkUser != null)
        {
            return array("result" => -1, "reason" => "Username already taken.");
        }

        $hasMiddlename = "";

        if(trim($POST['middlename']) != "")
        {
            $hasMiddlename = " AND middlename = '{$POST['middlename']}'";
        }

        $checkName = $this->db->selectSingleData("SELECT * FROM user WHERE userid != $officerId AND firstname = '{$POST['firstname']}' AND lastname = '{$POST['lastname']}'".$hasMiddlename);

        if($checkName != null)
        {
            return array("result" => -2, "reason" => "Name already exist.");
        }

        if(trim($POST['mobile']) == "")
        {
            return array("result" => -2, "reason" => "Mobile Number cannot be empty");
        }

        if(!is_numeric($POST['mobile']) || strlen($POST['mobile']) != 10)
        {
            return array("result" => -3, "reason" => "Invalid Mobile Number");
        }

        if($POST['image'] != "")
        {
            $ext = $this->getStringBetween($POST['image'], "data:image/", ";base64,");
            $image = str_replace("data:image/".$ext.";base64,", "", $POST['image']);
            $POST['image'] = $this->base64ToImageFile($image, $ext, UPLOAD_DIR . "user/");

            if($info['image'] != "")
            {
                unlink(UPLOAD_DIR . "user/" . $info['image']);
            }
        }
        else
        {
            unset($POST['image']);
        }

        if($POST['password'] != "")
        {
            $POST['password'] = Hash::create('sha256', $POST['password'], HASH_PASSWORD_KEY);
        }
        else
        {
            unset($POST['password']);
        }
        
        $this->db->update("user", $POST, "userid = $officerId");

        return array("result" => 1, "reason" => "Officer successfully updated.");
    }
}