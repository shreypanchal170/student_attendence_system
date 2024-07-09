<?php

class Backup extends Controller 
{
    function __construct() 
	{
        parent::__construct();
        Auth::handleLogin();
    }

    function index() 
	{
		$this->view->customlibrary = array("backup/js/index");
		$this->view->csslibrary = array( 'adminlte/plugins/datatables/dataTables.bootstrap' );
        $this->view->jslibrary = array( 'adminlte/plugins/datatables/jquery.dataTables.min', 'adminlte/plugins/datatables/dataTables.bootstrap.min' );

		$this->view->backups = $this->model->backups();

		$this->view->menu = 'backup';
		$this->view->title = 'Backup';
		$this->view->render('header');
		$this->view->render('middlearea');
		$this->view->render('backup/index');
		$this->view->render('bottomarea');
        $this->view->render('footer');
    }

    function process()
    {
    	
    }
}