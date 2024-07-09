<?php

class Events extends Controller 
{
    function __construct() 
	{
        parent::__construct();
        Auth::handleLogin();
    }
    
    function index() 
	{
        if(Session::get('role') == "admin")
        {
    		$this->view->customlibrary = array("events/js/index");
        }
        else
        {
            $this->view->customlibrary = array("events/js/index-officer");
        }

		$this->view->csslibrary = array( 'adminlte/plugins/daterangepicker/daterangepicker', 'adminlte/plugins/timepicker/bootstrap-timepicker.min', 'adminlte/plugins/datatables/dataTables.bootstrap' );
		$this->view->jslibrary = array( 'adminlte/plugins/select2/select2.full.min', 'adminlte/plugins/moment/moment', 'adminlte/plugins/daterangepicker/daterangepicker', 'adminlte/plugins/timepicker/bootstrap-timepicker.min', 'adminlte/plugins/datatables/jquery.dataTables.min', 'adminlte/plugins/datatables/dataTables.bootstrap.min' );

		$this->view->menu = 'events';
		$this->view->title = 'Events';
		$this->view->render('header');
		$this->view->render('middlearea');

        if(Session::get('role') == "admin")
        {
    		$this->view->render('events/index');
        }
        else
        {
            $this->view->render('events/index-officer');
        }

		$this->view->render('bottomarea');
        $this->view->render('footer');
    }

    function new() 
    {
        $this->view->render('events/add');
    }

    function tableLists()
    {
    	echo $this->model->getEventsLists();
    }

    function officersTableLists()
    {
        echo $this->model->getOfficerEventsLists();
    }

    function add()
    {
    	echo json_encode( $this->model->add($_POST) );
    }

    function edit($eventId)
    {
        $this->view->event = $this->model->getEventInfo($eventId);
        $this->view->render('events/edit');
    }

    function update($eventId)
    {
        echo json_encode( $this->model->update($eventId, $_POST) );
    }

    function editOfficers($eventId)
    {
        $this->view->officers = $this->model->getOfficers();
        $this->view->eventOfficers = $this->model->getEventOfficers($eventId);
        $this->view->event = $this->model->getEventInfo($eventId);
        $this->view->render('events/editOfficers');
    }

    function assignOfficer($eventId)
    {
        echo json_encode( $this->model->assignOfficer($eventId, $_POST) );
    }
}