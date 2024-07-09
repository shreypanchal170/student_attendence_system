<?php

class Sanction extends Controller 
{
    function __construct() 
	{
        parent::__construct();
        Auth::handleLogin();
    }

    function index()
    {
    	$this->view->customlibrary = array("sanction/js/index");
		$this->view->csslibrary = array( 'adminlte/plugins/datatables/dataTables.bootstrap' );
		$this->view->jslibrary = array( 'adminlte/plugins/datatables/jquery.dataTables.min', 'adminlte/plugins/datatables/dataTables.bootstrap.min' );

        $this->view->menu = 'sanction';
		$this->view->title = 'Sanction';
		$this->view->render('header');
		$this->view->render('middlearea');
		$this->view->render('sanction/index');
		$this->view->render('bottomarea');
        $this->view->render('footer');
    }

    function tableLists()
    {
    	echo $this->model->getSanctionLists();
    }

    function add()
    {
    	echo json_encode( $this->model->add($_POST) );
    }

    function edit($sanctionId)
    {
    	$this->view->sanction = $this->model->getSanctionInfo($sanctionId);
    	$this->view->render('sanction/edit');
    }

    function update($sanctionId)
    {
    	echo json_encode( $this->model->update($sanctionId, $_POST) );
    }
}