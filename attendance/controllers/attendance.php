<?php

class Attendance extends Controller 
{
    function __construct() 
	{
        parent::__construct();
        Auth::handleLogin();
    }
    
    function index() 
	{
		$events = $this->model->getEvents();

		if(count($events) > 0)
		{
			$this->view->customlibrary = array("attendance/js/index");
		}

		$this->view->events = $events;
		$this->view->menu = 'attendance';
		$this->view->title = 'Attendance';
		$this->view->render('headerAttendance');
		$this->view->render('middleareaAttendance');
		$this->view->render('attendance/index');
		$this->view->render('bottomareaAttendance');
        $this->view->render('footer');
    }

    function scan()
    {
    	$student = $this->model->getStudentByBarcode($_POST['barcode']);
        $recentStudent = null;

    	if($student != null)
    	{
    		$process = $this->model->processAttendance($student['studentid'], $_POST['eventid']);

            if($process < 1)
            {
                switch($process)
                {
                    case 0:
                        echo '<p class="alert alert-danger no-margin">Already Logged</p>';
                        break;
                    case -1:
                        echo '<p class="alert alert-danger no-margin">Invalid Event Session</p>';
                        break;
                    case -2:
                        echo '<p class="alert alert-danger no-margin">Sorry! You can\'t log at this moment.</p>';
                        break;
                }

                die();
            }

            $recentStudent = $this->model->getRecentLoggedInStudent($student['studentid'], $_POST['eventid']);
    	}

        $this->view->student = $student;
    	$this->view->recentStudent = $recentStudent;
    	$this->view->render('attendance/scan');
    }

    function loadEventAttendance($eventId, $studentIdExclude)
    {
        $this->view->attendance = $this->model->eventAttendance($eventId, $studentIdExclude);
        $this->view->render('attendance/eventAttendance');
    }
}