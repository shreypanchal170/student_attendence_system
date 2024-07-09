<?php

class Reports extends Controller 
{
    function __construct() 
	{
        parent::__construct();
        Auth::handleLogin();
    }
    
    function index() 
	{
		$this->view->customlibrary = array("reports/js/index");
		$this->view->jslibrary = array( 'adminlte/plugins/flot/jquery.flot.min', 'adminlte/plugins/flot/jquery.flot.resize.min', 'adminlte/plugins/flot/jquery.flot.pie.min', 'adminlte/plugins/flot/jquery.flot.categories.min' );

        $this->view->courses = $this->model->getCourses();
        $this->view->departments = $this->model->getDepartments();
        $this->view->events = $this->model->getEvents();
        $this->view->currentSY = $this->model->currentSchoolYear();
        $this->view->schoolYears = $this->model->getSchoolYears();

        $this->view->menu = 'reports';
		$this->view->submenu = 'generate';
		$this->view->title = 'Reports';
		$this->view->render('header');
		$this->view->render('middlearea');
		$this->view->render('reports/index');
		$this->view->render('bottomarea');
        $this->view->render('footer');
    }

    function loadEventsBySchoolYear()
    {
        $lists = $this->model->getEventsBySchoolYear($_POST['schoolyear']);

        if($lists == null)
        {
            echo json_encode( array() );
            die();
        }

        $dataArr = array();

        foreach($lists as $item)
        {
            $dataArr[] = array(
                "id" => $item['eventid'],
                "name" => $item['event_name']
            );
        }

        echo json_encode( $dataArr );
    }

    function printReport()
    {
    	switch($_POST['report_type'])
    	{
    		case "print-student-barcode":
    			$this->view->orientation = "A4 portrait";
    			$this->view->render('headerEmpty');
    			$this->view->students = $this->model->getStudents($_POST['schoolyear']);
    			$this->view->render('reports/printReportStudentBarcodeID');
    			$this->view->render('footerEmpty');
    			break;
            case "print-student-attendance":
                $this->view->students = $this->model->getStudentsBySelection($_POST['departmentid'], $_POST['courseid'], $_POST['year'], $_POST['section'], $_POST['schoolyear']);
                $this->view->attendances = $this->model->getStudentsAttendanceBySelection($_POST['departmentid'], $_POST['courseid'], $_POST['year'], $_POST['section'], $_POST['schoolyear']);
                $this->view->sanctions = $this->model->getSanctionLists();
                $this->view->events = $this->model->getEventsBySchoolYear($_POST['schoolyear']);
                $this->view->courseInfo = $this->model->getCourseInfo($_POST['courseid']);
                $this->view->yearSection = $_POST['year']."".$_POST['section'];

                $this->view->orientation = "A4 landscape";
                $this->view->render('headerEmpty');
                $this->view->render('reports/printStudentAttendance');
                $this->view->render('footerEmpty');
                break;
            case "print-event-attendance":
                $this->view->students = $this->model->getStudentsBySelection($_POST['departmentid'], $_POST['courseid'], $_POST['year'], $_POST['section'], $_POST['schoolyear']);
                $this->view->attendances = $this->model->getStudentsAttendanceBySelectionWithEvent($_POST['departmentid'], $_POST['courseid'], $_POST['year'], $_POST['section'], $_POST['eventid'], $_POST['schoolyear']);
                $this->view->eventInfo = $this->model->getEventInfo($_POST['eventid']);

                $this->view->courseInfo = $this->model->getCourseInfo($_POST['courseid']);
                $this->view->yearSection = $_POST['year']."".$_POST['section'];

                if($_POST['print-status'] == "all")
                {
                    $this->view->orientation = "Legal landscape";
                    $this->view->printZoom = 80;
                    $this->view->render('headerEmpty');
                    $this->view->render('reports/printEventAttendance');
                }
                elseif($_POST['print-status'] == "present")
                {
                    $this->view->printTitle = "Present Lists";
                    $this->view->session = $_POST['print-session'];
                    $this->view->orientation = "A4 portrait";
                    $this->view->render('headerEmpty');
                    $this->view->render('reports/printEventAttendanceByTypePresent');
                }
                elseif($_POST['print-status'] == "absent")
                {
                    $this->view->printTitle = "Absent Lists";
                    $this->view->session = $_POST['print-session'];
                    $this->view->orientation = "A4 portrait";
                    $this->view->render('headerEmpty');
                    $this->view->render('reports/printEventAttendanceByTypeAbsent');
                }

                $this->view->render('footerEmpty');
                break;
    	}
    }

    function getCourseYearSection($courseId, $year, $schoolYear)
    {
        $sections = $this->model->getCourseSection($courseId, $year, $schoolYear);

        $dataArr = array();

        if($sections != null && count($sections) > 0)
        {
            foreach($sections as $section)
            {
                $dataArr[] = $section['section'];
            }
        }

        echo json_encode(array("results" => $dataArr));
    }

    function sanction()
    {
        $this->view->customlibrary = array("reports/js/sanction");
        $this->view->csslibrary = array( 'adminlte/plugins/datatables/dataTables.bootstrap' );
        $this->view->jslibrary = array( 'adminlte/plugins/datatables/jquery.dataTables.min', 'adminlte/plugins/datatables/dataTables.bootstrap.min' );

        $this->view->menu = 'reports';
        $this->view->submenu = 'sanction';
        $this->view->title = 'Sanction';
        $this->view->render('header');
        $this->view->render('middlearea');
        $this->view->render('reports/sanction');
        $this->view->render('bottomarea');
        $this->view->render('footer');
    }

    function tableLists()
    {
        echo $this->model->getSanctionListsJSON();
    }

    function graphs() 
    {
        $this->view->customlibrary = array("reports/js/graphs");
        $this->view->jslibrary = array( 'adminlte/plugins/flot/jquery.flot.min', 'adminlte/plugins/flot/jquery.flot.resize.min', 'adminlte/plugins/flot/jquery.flot.pie.min', 'adminlte/plugins/flot/jquery.flot.categories.min', 'adminlte/plugins/chartjs/Chart.min' );

        $schoolYear = isset($_GET['schoolyear']) ? $_GET['schoolyear'] : $this->model->currentSchoolYear();

        $this->view->piegraph = $this->model->getPieGraphInfo($schoolYear);
        $this->view->bargraph = $this->model->getBarGraphInfo($schoolYear);
        $this->view->currentSY = $this->model->currentSchoolYear();
        $this->view->schoolYears = $this->model->getSchoolYears();
        $this->view->selectedSchoolYear = $schoolYear;
        
        $this->view->menu = 'reports';
        $this->view->submenu = 'graphs';
        $this->view->title = 'Graph Reports';
        $this->view->render('header');
        $this->view->render('middlearea');
        $this->view->render('reports/graphs');
        $this->view->render('bottomarea');
        $this->view->render('footer');
    }

    function printSanction()
    {
        $this->view->sanctions = $this->model->getSanctionLists();

        $this->view->orientation = "A4 landscape";
        $this->view->render('headerEmpty');
        $this->view->render('reports/printSanction');
        $this->view->render('footerEmpty');
    }
}