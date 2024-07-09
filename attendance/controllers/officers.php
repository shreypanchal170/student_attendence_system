<?php

class Officers extends Controller 
{
    function __construct() 
	{
        parent::__construct();
        Auth::handleLogin();
    }
    
    function index() 
	{
		$this->view->customlibrary = array("officers/js/index");
		$this->view->csslibrary = array( 'adminlte/plugins/datatables/dataTables.bootstrap' );
		$this->view->jslibrary = array( 'adminlte/plugins/datatables/jquery.dataTables.min', 'adminlte/plugins/datatables/dataTables.bootstrap.min', 'webcamjs/webcam.min' );

		$this->view->menu = 'officers';
		$this->view->title = 'Officers';
		$this->view->render('header');
		$this->view->render('middlearea');
		$this->view->render('officers/index');
		$this->view->render('bottomarea');
        $this->view->render('footer');
    }

    function new() 
    {
        $this->view->customlibrary = array("officers/js/add");
        $this->view->jslibrary = array( 'webcamjs/webcam.min' );

        $this->view->menu = 'officers';
        $this->view->title = 'Officers';
        $this->view->render('header');
        $this->view->render('middlearea');
        $this->view->render('officers/add');
        $this->view->render('bottomarea');
        $this->view->render('footer');
    }

    function tableLists()
    {
    	echo $this->model->getOfficersLists();
    }

    function add()
    {
    	echo json_encode( $this->model->add($_POST) );
    }

    function edit($officerId)
    {
        $this->view->officer = $this->model->getOfficerInfo($officerId);

        $this->view->customlibrary = array("officers/js/edit");
        $this->view->csslibrary = array( 'adminlte/plugins/datatables/dataTables.bootstrap' );
        $this->view->jslibrary = array( 'adminlte/plugins/datatables/jquery.dataTables.min', 'adminlte/plugins/datatables/dataTables.bootstrap.min', 'webcamjs/webcam.min' );

        $this->view->menu = 'officers';
        $this->view->title = 'Edit Officer';
        $this->view->render('header');
        $this->view->render('middlearea');
        $this->view->render('officers/edit');
        $this->view->render('bottomarea');
        $this->view->render('footer');
    }

    function update($officerId)
    {
        echo json_encode( $this->model->update($officerId, $_POST) );
    }

    function events($officerId)
    {
        $this->view->officerInfo = $this->model->getOfficerInfo($officerId);
        $this->view->events = $this->model->getOfficerEvents($officerId);

        $this->view->menu = 'officers';
        $this->view->title = 'Officer Profile';
        $this->view->render('header');
        $this->view->render('middlearea');
        $this->view->render('officers/attendance');
        $this->view->render('bottomarea');
        $this->view->render('footer');
    }

    function printEvents($officerId)
    {
        $this->view->officerInfo = $this->model->getOfficerInfo($officerId);
        $this->view->events = $this->model->getOfficerEvents($officerId);

        $this->view->orientation = "A4 landscape";
        $this->view->render('headerEmpty');
        $this->view->render('officers/print-attendance');
        $this->view->render('footerEmpty');
    }
}