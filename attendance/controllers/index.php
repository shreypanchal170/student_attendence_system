<?php

class Index extends Controller 
{
    function __construct() 
	{
        parent::__construct();
    }
    
    function index() 
	{
		Session::init();
		if(Session::get('loggedIn')):
			$this->view->customlibrary = array("index/js/index");
			$this->view->csslibrary = array( 'adminlte/plugins/fullcalendar/fullcalendar.min' );
			$this->view->jslibrary = array( 'adminlte/plugins/moment/moment', 'adminlte/plugins/fullcalendar/fullcalendar.min' );

			$this->view->currentEvents = $this->getTodaysEvents();
			$this->view->upcomingEvents = $this->upcomingEvents();

			$this->view->menu = 'dashboard';
			$this->view->title = 'Dashboard';
			$this->view->render('header');
			$this->view->render('middlearea');
			$this->view->render('index/index');
			$this->view->render('bottomarea');
		else:
			$this->view->title = 'Login Page';
			$this->view->render('header');
			$this->view->render('index/login');
		endif;
		
        $this->view->render('footer');
    }

    function loadEventsJSON()
    {
    	echo $this->model->loadEventsJSON();
    }

    function getTodaysEvents()
    {
    	$model = new Model();

        $lists = $model->db->select("SELECT *, (SELECT COUNT(*) FROM attendance WHERE attendance.eventid = event.eventid AND attendance.time_status = 'morning' AND DATE(attendance.dateadded) = '".date('Y-m-d')."') AS currentAttendanceMorning, (SELECT COUNT(*) FROM attendance WHERE attendance.eventid = event.eventid AND attendance.time_status = 'afternoon' AND DATE(attendance.dateadded) = '".date('Y-m-d')."') AS currentAttendanceAfternoon FROM event WHERE '".date('Y-m-d')."' BETWEEN event.event_start_date AND event.event_end_date ORDER BY event_starttime_am, event_starttime_pm ASC LIMIT 5");

        $dataArr = array();

        if($lists != null)
        {
        	$currentHour = date('H');

        	foreach($lists as $item)
        	{
        		if($currentHour <= 12 && in_array($item['status'], array("morning", "wholeday")))
        		{
        			$eventDateTime = strtotime(date('Y-m-d') . " " . $item['event_endtime_am']);

        			if($eventDateTime >= time())
        			{
        				$dataArr[] = $item;
        			}
        		}

        		if($currentHour > 12 && in_array($item['status'], array("afternoon", "wholeday")))
        		{
        			$eventDateTime = strtotime(date('Y-m-d') . " " . $item['event_endtime_pm']);

        			if($eventDateTime >= time())
        			{
        				$dataArr[] = $item;
        			}
        		}
        	}
        }

        return $dataArr;
    }

    function upcomingEvents()
    {
    	$model = new Model();

        return $model->db->select("SELECT *, (SELECT COUNT(*) FROM attendance WHERE attendance.eventid = event.eventid AND attendance.time_status = 'morning') AS currentAttendanceMorning, (SELECT COUNT(*) FROM attendance WHERE attendance.eventid = event.eventid AND attendance.time_status = 'afternoon') AS currentAttendanceAfternoon FROM event WHERE event.event_start_date > '".date('Y-m-d')."' AND event.semester = ".$model->currentSemester()." AND event.schoolyear = '".$model->currentSchoolYear()."' ORDER BY event_starttime_am, event_starttime_pm ASC LIMIT 5");
    }

    function updateYearLevel()
    {
		$model = new Model();

		$year = $model->currentSchoolFirstYear();
		$previousSchoolYear = ($year - 1) . "-" . $year;

		$model->db->truncate("student_yearlevel_update");
		$model->db->update("student_academic_details", array("schoolyear" => $previousSchoolYear), "schoolyear = '".$model->currentSchoolYear()."'");
		$model->db->insert("student_yearlevel_update", array("schoolyear" =>  ($year - 1) . "-" . $year));

		header("location: " . URL);
    }
}