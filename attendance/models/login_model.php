<?php

class Login_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        $sth = $this->db->prepare("SELECT * FROM user WHERE username = :username AND password = :password AND isdeleted = :isdeleted");
        $sth->execute(array(
            ':username' => $_POST['username'],
            ':password' => Hash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY),
            ':isdeleted' => 0
        ));
        
        $data = $sth->fetch();
        
        $count =  $sth->rowCount();

		$error = "";

        if ($count > 0)
		{
			Session::init();
			Session::set('loggedIn', true);
			Session::set('userid', $data['userid']);
			Session::set('firstname', $data['firstname']);
            Session::set('lastname', $data['lastname']);
            Session::set('image', $data['image']);
            Session::set('role', $data['position']);

            $this->saveLog("Logged In");
        }
        else
        {
            $error = "?hasError";
        }

		header("location: " . URL . $error);		
    }
}