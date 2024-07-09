<?php

class Profile_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserInfo()
    {
    	$userId = Session::get('userid');

        return $this->db->selectSingleData("SELECT * FROM user WHERE userid = $userId");
    }

    public function update($POST)
    {
    	$userId = Session::get('userid');

        $info = $this->getUserInfo();

        $checkUser = $this->db->selectSingleData("SELECT * FROM user WHERE username = '{$POST['username']}' AND userid != $userId");

        if($checkUser != null)
        {
            return array("result" => -1, "reason" => "Username already taken.");
        }

        $hasMiddlename = "";

        if(trim($POST['middlename']) != "")
        {
            $hasMiddlename = " AND middlename = '{$POST['middlename']}'";
        }

        $checkName = $this->db->selectSingleData("SELECT * FROM user WHERE userid != $userId AND firstname = '{$POST['firstname']}' AND lastname = '{$POST['lastname']}'".$hasMiddlename);

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

            Session::set('image', $POST['image']);
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
        
        $this->db->update("user", $POST, "userid = $userId");

        Session::set('firstname', $POST['firstname']);
        Session::set('lastname', $POST['lastname']);

        return array("result" => 1, "reason" => "User successfully updated.");
    }
}