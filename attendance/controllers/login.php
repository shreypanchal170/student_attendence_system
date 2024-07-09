<?php

class Login extends Controller {

    function __construct()
    {
        parent::__construct();	
    }
    
    function index() 
    {
    	header("location: ".URL);
    }
    
    function run()
    {
        $this->model->run();
    }
}