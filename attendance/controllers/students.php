<?php

class Students extends Controller 
{
    function __construct() 
	{
        parent::__construct();
        Auth::handleLogin();
    }
    
    function index() 
	{
        $this->view->checkIfYearLevelIsUpdatedForCurrentSchoolYear = $this->model->checkIfYearLevelIsUpdatedForCurrentSchoolYear();
		$this->view->customlibrary = array("students/js/index");
		$this->view->csslibrary = array( 'adminlte/plugins/datatables/dataTables.bootstrap' );
		$this->view->jslibrary = array( 'adminlte/plugins/datatables/jquery.dataTables.min', 'adminlte/plugins/datatables/dataTables.bootstrap.min' );

		$this->view->menu = 'students';
		$this->view->title = 'Students';
		$this->view->render('header');
		$this->view->render('middlearea');
		$this->view->render('students/index');
		$this->view->render('bottomarea');
        $this->view->render('footer');
    }

    function new() 
    {
        $this->view->customlibrary = array("students/js/add");
        $this->view->jslibrary = array( 'webcamjs/webcam.min' );

        $this->view->courses = $this->model->getCourses();
        $this->view->departments = $this->model->getDepartments();
        $this->view->menu = 'students';
        $this->view->title = 'Students';
        $this->view->render('header');
        $this->view->render('middlearea');
        $this->view->render('students/add');
        $this->view->render('bottomarea');
        $this->view->render('footer');
    }

    function view($studentId)
    {
        $this->view->student = $this->model->getStudentInfo($studentId);
        $this->view->render('students/view');
    }

    function tableLists()
    {
    	echo $this->model->getStudentsLists();
    }

    function add()
    {
    	echo json_encode( $this->model->add($_POST) );
    }

    function edit($studentId) 
    {
        $this->view->student = $this->model->getStudentInfo($studentId);

        $this->view->customlibrary = array("students/js/edit");
        $this->view->csslibrary = array( 'adminlte/plugins/datatables/dataTables.bootstrap' );
        $this->view->jslibrary = array( 'adminlte/plugins/datatables/jquery.dataTables.min', 'adminlte/plugins/datatables/dataTables.bootstrap.min', 'webcamjs/webcam.min' );

        $this->view->departments = $this->model->getDepartments();
        $this->view->courses = $this->model->getCourses();
        $this->view->menu = 'students';
        $this->view->title = 'Edit Student';
        $this->view->render('header');
        $this->view->render('middlearea');
        $this->view->render('students/edit');
        $this->view->render('bottomarea');
        $this->view->render('footer');
    }

    function update($studentId)
    {
        echo json_encode( $this->model->update($studentId, $_POST) );
    }

    function barcode($studentId)
    {
        $this->view->orientation = "A4 portrait";
        $this->view->render('headerEmpty');
        $this->view->student = $this->model->getStudentInfo($studentId);
        $this->view->render('students/barcode');
        $this->view->render('footerEmpty');
    }

    function attendance($studentId)
    {
        $this->view->customlibrary = array("students/js/index");
        $this->view->csslibrary = array( 'adminlte/plugins/datatables/dataTables.bootstrap' );
        $this->view->jslibrary = array( 'adminlte/plugins/datatables/jquery.dataTables.min', 'adminlte/plugins/datatables/dataTables.bootstrap.min' );

        $this->view->studentInfo = $this->model->getStudentInfo($studentId);
        $this->view->attendances = $this->model->getAttendances($studentId);
        $this->view->events = $this->model->getCurrentEventsLists();
        $this->view->sanctions = $this->model->getSanctions();

        $this->view->menu = 'students';
        $this->view->title = 'Student Attendance Profile';
        $this->view->render('header');
        $this->view->render('middlearea');
        $this->view->render('students/attendance');
        $this->view->render('bottomarea');
        $this->view->render('footer');
    }

    function printAttendance($studentId)
    {
        $this->view->studentInfo = $this->model->getStudentInfo($studentId);
        $this->view->attendances = $this->model->getAttendances($studentId);
        $this->view->events = $this->model->getCurrentEventsLists();
        $this->view->sanctions = $this->model->getSanctions();

        $this->view->orientation = "A4 landscape";
        $this->view->render('headerEmpty');
        $this->view->render('students/printAttendance');
        $this->view->render('footerEmpty');
    }

    function printAttendanceExcel($studentId)
    {
        $studentInfo = $this->model->getStudentInfo($studentId);
        $attendances = $this->model->getAttendances($studentId);
        $events = $this->model->getCurrentEventsLists();
        $sanctions = $this->model->getSanctions();

        $exporter = new ExportDataExcel('browser', 'attendanceExcel.xls');
        $exporter->initialize();

        $middleName = ($studentInfo['middlename'] != "") ? " " . strtoupper(substr($studentInfo['middlename'], 0, 1)) . ". " : " ";
        $fullName = ucwords($studentInfo['lastname']).", ".ucwords($studentInfo['firstname']).$middleName;

        $exporter->addRow(array("Name:", $fullName));
        $exporter->addRow(array("Event", "Status", "-", "-", "-", "Total No. of Present", "Total No. of Absent")); 
        
        foreach($events as $event):
            $startDate = strtotime($event['event_start_date'] . " 00:00:00");
            $endDate = strtotime($event['event_end_date'] . " 00:00:00");
            $countDays = 1;

            if($startDate != $endDate):
                $countDays = $endDate - $startDate;
                $countDays = ($countDays / (60 * 60 * 24)) + 1;
            endif;

            if($countDays == 1):
                $currentTotalPresent = 0;
                $currentTotalAbsent = ($event['status'] == "wholeday") ? 4 : 2;

                $morningIn = 0;
                $morningOut = 0;
                $afternoonIn = 0;
                $afternoonOut = 0;

                foreach($attendances as $attendance):
                    if($attendance['eventid'] == $event['eventid']):
                        if($attendance['status'] == "in" && $attendance['time_status'] == "morning"):
                            $morningIn = 1;
                            $currentTotalPresent++;
                            $currentTotalAbsent--;
                        endif;
                        if($attendance['status'] == "out" && $attendance['time_status'] == "morning"):
                            $morningOut = 1;
                            $currentTotalPresent++;
                            $currentTotalAbsent--;
                        endif;
                        if($attendance['status'] == "in" && $attendance['time_status'] == "afternoon"):
                            $afternoonIn = 1;
                            $currentTotalPresent++;
                            $currentTotalAbsent--;
                        endif;
                        if($attendance['status'] == "out" && $attendance['time_status'] == "afternoon"):
                            $afternoonOut = 1;
                            $currentTotalPresent++;
                            $currentTotalAbsent--;
                        endif;
                    endif;
                endforeach;

                $morningInStr = "-----";

                if($event['status'] == "wholeday"):
                    $morningInStr =  ($morningIn == 0) ? 'Absent' : 'Present';
                else:
                    if($event['status'] == "morning"):
                        $morningInStr =  ($morningIn == 0) ? 'Absent' : 'Present';
                    endif;
                endif;

                $morningOutStr = "-----";

                if($event['status'] == "wholeday"):
                    $morningOutStr = ($morningOut == 0) ? 'Absent' : 'Present';
                else:
                    if($event['status'] == "morning"):
                        $morningOutStr = ($morningOut == 0) ? 'Absent' : 'Present';
                    endif;
                endif;

                $afternoonInStr = "-----";

                if($event['status'] == "wholeday"):
                    $afternoonOutStr = ($afternoonIn == 0) ? 'Absent' : 'Present';
                else:
                    if($event['status'] == "afternoon"):
                        $afternoonOutStr = ($afternoonIn == 0) ? 'Absent' : 'Present';
                    endif;
                endif;

                $afternoonOutStr = "-----";

                if($event['status'] == "wholeday"):
                    $afternoonOutStr ($afternoonOut == 0) ? 'Absent' : 'Present';
                else:
                    if($event['status'] == "afternoon"):
                        $afternoonOutStr ($afternoonOut == 0) ? 'Absent' : 'Present';
                    endif;
                endif;

                $totalPresent += $currentTotalPresent;
                $totalAbsent += $currentTotalAbsent;

                $exporter->addRow(array($event['event_name'], $morningInStr, $morningOutStr, $afternoonInStr, $afternoonOutStr, $currentTotalPresent, $currentTotalAbsent));
            else:

                for($i = 1; $i <= $countDays; $i++):
                    $currentTotalPresent = 0;
                    $currentTotalAbsent = ($event['status'] == "wholeday") ? 4 : 2;

                    $currentEventDateTime = strtotime($event['event_start_date']);

                    if($i > 1):
                        $currentEventDateTime = $currentEventDateTime + ((60 * 60 * 24) * $i);
                    endif;

                    $currentEventDate = date("Y-m-d", $currentEventDateTime);

                    $totalEventAttendanceCount = 0;
                    $eventAttendanceCount = 0;

                    $morningIn = 0;
                    $morningOut = 0;
                    $afternoonIn = 0;
                    $afternoonOut = 0;

                    foreach($attendances as $attendance):
                        $attendanceDate = date("Y-m-d", strtotime($attendance['dateadded']));

                        if($attendance['eventid'] == $event['eventid'] && $attendanceDate == $currentEventDate):
                            if($attendance['status'] == "in" && $attendance['time_status'] == "morning"):
                                $morningIn = 1;
                                $currentTotalPresent++;
                                $currentTotalAbsent--;
                            endif;
                            if($attendance['status'] == "out" && $attendance['time_status'] == "morning"):
                                $morningOut = 1;
                                $currentTotalPresent++;
                                $currentTotalAbsent--;
                            endif;
                            if($attendance['status'] == "in" && $attendance['time_status'] == "afternoon"):
                                $afternoonIn = 1;
                                $currentTotalPresent++;
                                $currentTotalAbsent--;
                            endif;
                            if($attendance['status'] == "out" && $attendance['time_status'] == "afternoon"):
                                $afternoonOut = 1;
                                $currentTotalPresent++;
                                $currentTotalAbsent--;
                            endif;
                        endif;
                    endforeach;

                    $morningInStr = "-----";

                    if($event['status'] == "wholeday"):
                        $morningInStr =  ($morningIn == 0) ? 'Absent' : 'Present';
                    else:
                        if($event['status'] == "morning"):
                            $morningInStr =  ($morningIn == 0) ? 'Absent' : 'Present';
                        endif;
                    endif;

                    $morningOutStr = "-----";

                    if($event['status'] == "wholeday"):
                        $morningOutStr = ($morningOut == 0) ? 'Absent' : 'Present';
                    else:
                        if($event['status'] == "morning"):
                            $morningOutStr = ($morningOut == 0) ? 'Absent' : 'Present';
                        endif;
                    endif;

                    $afternoonInStr = "-----";

                    if($event['status'] == "wholeday"):
                        $afternoonOutStr = ($afternoonIn == 0) ? 'Absent' : 'Present';
                    else:
                        if($event['status'] == "afternoon"):
                            $afternoonOutStr = ($afternoonIn == 0) ? 'Absent' : 'Present';
                        endif;
                    endif;

                    $afternoonOutStr = "-----";

                    if($event['status'] == "wholeday"):
                        $afternoonOutStr ($afternoonOut == 0) ? 'Absent' : 'Present';
                    else:
                        if($event['status'] == "afternoon"):
                            $afternoonOutStr ($afternoonOut == 0) ? 'Absent' : 'Present';
                        endif;
                    endif;

                    $totalPresent += $currentTotalPresent;
                    $totalAbsent += $currentTotalAbsent;

                    $exporter->addRow(array($event['event_name'] . " Day " . $i, $morningInStr, $morningOutStr, $afternoonInStr, $afternoonOutStr, $currentTotalPresent, $currentTotalAbsent));

                endfor;
            endif;
        endforeach;

        $sanctionsLists = array();
        $totalSanctionCount = 0;
        foreach($sanctions as $sanction):
            if($sanction['no_of_absences'] < $totalAbsent):
                $totalSanctionCount += $sanction['no_of_absences'];
                $sanctionsLists[] = $sanction['item_name'];
            endif;
            
            if($sanction['no_of_absences'] == $totalAbsent):
                $sanctionsLists = array($sanction['item_name']);
                break;
            endif;

            if($totalSanctionCount >= $totalAbsent):
                break;
            endif;
        endforeach;

        $exporter->addRow(array("-", "-", "-", "-", "-", "-", "Remarks/Sanction")); 
        $exporter->addRow(array("-", "-", "-", "-", "-", "-", ucwords(implode(", ", $sanctionsLists)))); 

        $exporter->finalize();

        exit();
    }

    function import()
    {
        $this->model->processStudentImport();
    }

    function updateYearLevel()
    {
        $this->model->updateYearLevel();
    }
}