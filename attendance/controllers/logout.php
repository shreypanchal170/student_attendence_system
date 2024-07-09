<?php

class Logout extends Controller {

    function __construct() 
	{
        parent::__construct();   
		Session::init();		
    }
    
    function index() 
    {    
        $this->model->process();
    }
}