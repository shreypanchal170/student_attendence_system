<?php

class Profile extends Controller 
{
    function __construct() 
	{
        parent::__construct();
        Auth::handleLogin();
    }
    
    function index() 
	{
		$this->view->customlibrary = array("profile/js/index");
		$this->view->jslibrary = array( 'adminlte/plugins/flot/jquery.flot.min', 'adminlte/plugins/flot/jquery.flot.resize.min', 'adminlte/plugins/flot/jquery.flot.pie.min', 'adminlte/plugins/flot/jquery.flot.categories.min', 'webcamjs/webcam.min' );

		$this->view->user = $this->model->getUserInfo();

		$this->view->menu = 'profile';
		$this->view->title = 'Profile';
		$this->view->render('header');
		$this->view->render('middlearea');
		$this->view->render('profile/index');
		$this->view->render('bottomarea');
        $this->view->render('footer');
    }

    function update()
    {
        echo json_encode( $this->model->update($_POST) );
    }
}