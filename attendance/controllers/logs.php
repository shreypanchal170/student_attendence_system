<?php

class Logs extends Controller 
{
    function __construct() 
	{
        parent::__construct();
        Auth::handleLogin();
    }
    
    function index() 
	{
		$this->view->customlibrary = array("logs/js/index");
		$this->view->csslibrary = array( 'adminlte/plugins/datatables/dataTables.bootstrap' );
        $this->view->jslibrary = array( 'adminlte/plugins/datatables/jquery.dataTables.min', 'adminlte/plugins/datatables/dataTables.bootstrap.min' );

		$this->view->logs = $this->model->logs();

		$this->view->menu = 'logs';
		$this->view->title = 'Logs';
		$this->view->render('header');
		$this->view->render('middlearea');
		$this->view->render('logs/index');
		$this->view->render('bottomarea');
        $this->view->render('footer');
    }
}