<?php

class Reports_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getSanctionLists()
    {
        return $this->db->select("SELECT * FROM sanction");
    }

    public function getStudents($schoolYear=null)
    {
        $schoolYear = ($schoolYear != null) ? $schoolYear : $this->currentSchoolYear();
    	return $this->db->select("SELECT * FROM student LEFT JOIN student_academic_details ON student_academic_details.studentid = student.studentid LEFT JOIN course ON course.courseid = student_academic_details.courseid LEFT JOIN student_barcode ON student_barcode.studentid = student.studentid WHERE student_academic_details.schoolyear = '{$schoolYear}'");
    }

    public function getDepartments()
    {
        return $this->db->select("SELECT * FROM department ORDER BY department_name ASC");
    }

    public function getCourses()
    {
    	return $this->db->select("SELECT * FROM course ORDER BY course_name ASC");
    }

    public function getCourseInfo($courseId)
    {
        return $this->db->selectSingleData("SELECT * FROM course WHERE courseid = $courseId");
    }

    public function getCourseSection($courseId, $year, $schoolYear)
    {
    	return $this->db->select("SELECT section FROM student_academic_details WHERE courseid = {$courseId} AND year = {$year} AND schoolyear = '{$schoolYear}' GROUP BY section ORDER BY section ASC");
    }

    public function getSanctionListsJSON()
    {
        $lists = $this->getSanctionLists();

        $data = array();

        foreach($lists as $item)
        {
            $data[] = array($item['item_name'], $item['no_of_absences']);
        }   

        return json_encode( array("data" => $data) );
    }

    public function getStudentsBySelection($departmentId, $courseId, $year, $section, $schoolYear)
    {
        return $this->db->select("SELECT * FROM student LEFT JOIN student_academic_details ON student_academic_details.studentid = student.studentid LEFT JOIN course ON course.courseid = student_academic_details.courseid WHERE student_academic_details.courseid = $courseId AND student_academic_details.year = $year AND student_academic_details.section = '$section'AND student_academic_details.schoolyear = '".$schoolYear."' ");
    }

    public function getStudentsAttendanceBySelection($departmentId, $courseId, $year, $section, $schoolYear)
    {
        return $this->db->select("SELECT attendance.* FROM attendance LEFT JOIN student ON student.studentid = attendance.studentid LEFT JOIN student_academic_details ON student_academic_details.studentid = attendance.studentid WHERE student_academic_details.courseid = $courseId AND student_academic_details.year = $year AND student_academic_details.section = '$section' AND attendance.semester = ".$this->currentSemester()." AND attendance.schoolyear = '".$schoolYear."'");
    }

    public function getStudentsAttendanceBySelectionWithEvent($departmentId, $courseId, $year, $section, $eventId, $schoolYear)
    {
        return $this->db->select("SELECT attendance.* FROM attendance LEFT JOIN student ON student.studentid = attendance.studentid LEFT JOIN student_academic_details ON student_academic_details.studentid = attendance.studentid WHERE student_academic_details.courseid = $courseId AND student_academic_details.year = $year AND student_academic_details.section = '$section' AND attendance.eventid = $eventId AND attendance.semester = ".$this->currentSemester()." AND attendance.schoolyear = '".$schoolYear."'");
    }

    public function getEvents()
    {
        return $this->db->select("SELECT * FROM event WHERE DATE(event_start_date) <= '" . date('Y-m-d') . "' AND semester = ".$this->currentSemester()." AND schoolyear = '".$this->currentSchoolYear()."'");
    }

    public function getEventsBySchoolYear($schoolYear)
    {
        return $this->db->select("SELECT * FROM event WHERE DATE(event_start_date) <= '" . date('Y-m-d') . "' AND semester = ".$this->currentSemester()." AND schoolyear = '".$schoolYear."'");
    }

    public function getEventInfo($eventId)
    {
        return $this->db->selectSingleData("SELECT * FROM event WHERE eventid = $eventId");
    }

    public function getPieGraphInfo($schoolYear=null)
    {
        $schoolYear = ($schoolYear != null) ? $schoolYear : $this->currentSchoolYear();

        $courses = $this->db->select("SELECT *, (SELECT COUNT(*) FROM attendance LEFT JOIN student ON student.studentid = attendance.studentid LEFT JOIN student_academic_details ON student_academic_details.studentid = attendance.studentid WHERE student_academic_details.courseid = course.courseid AND attendance.semester = ".$this->currentSemester()." AND attendance.schoolyear = '".$schoolYear."') AS studentCount FROM course");
        $events = $this->getEventsBySchoolYear($schoolYear);
        $attendances = $this->getAttendanceLists($schoolYear);

        $dataArr = array(
            "presentData" => array(),
            "absentData" => array()
        );

        $students = $this->getStudents();
        $totalStudents = count($students);
        $totalEvents = 0;

        $colors = array();

        foreach($courses as $course)
        {
            $presentCount = 0;
            $absentCount = 0;

            foreach($students as $student)
            {
                if($student['courseid'] == $course['courseid'])
                {
                    foreach($events as $event)
                    {
                        $countDays = 1;
                        $startDate = strtotime($event['event_start_date'] . " 00:00:00");
                        $endDate = strtotime($event['event_end_date']. " 00:00:00");

                        if($startDate != $endDate)
                        {
                            $countDays = $endDate - $startDate;
                            $countDays = ($countDays / (60 * 60 * 24)) + 1;
                        }

                        $totalEventAttendanceCount = ($event['status'] == "wholeday") ? ($countDays * 4): ($countDays * 2);

                        $studentAttendanceCount = 0;

                        foreach($attendances as $attendance)
                        {
                            if($event['eventid'] == $attendance['eventid'] && $student['studentid'] == $attendance['studentid'])
                            {
                                $studentAttendanceCount++;
                            }
                        }

                        $presentCount += $studentAttendanceCount;
                        $absentCount += $totalEventAttendanceCount - $studentAttendanceCount;
                        $totalEvents += $countDays;
                    }
                }
            }

            $color = $this->getHexColor($colors);

            $colors[] = $color;

            $dataArr["presentData"][] = array(
                "value" => $presentCount,
                "label" => $course['course_name'],
                "color" => $color,
                "highlight" => $color
            );

            $dataArr["absentData"][] = array(
                "value" => $absentCount,
                "label" => $course['course_name'],
                "color" => $color,
                "highlight" => $color
            );
        }

        return $dataArr;
    }

    private function getHexColor($colors)
    {
        $color = $this->generateHexColor();

        if(in_array($color, $colors))
        {
            $this->getHexColor();
        }

        return $color;
    }

    private function generateHexColor()
    {
        return "#" . $this->colorPart() . $this->colorPart() . $this->colorPart();
    }

    private function colorPart()
    {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    public function getAttendanceLists($schoolYear)
    {
        return $this->db->select("SELECT * FROM attendance LEFT JOIN student ON student.studentid = attendance.studentid LEFT JOIN student_academic_details ON student_academic_details.studentid = attendance.studentid WHERE attendance.semester = ".$this->currentSemester()." AND attendance.schoolyear = '".$schoolYear."'");
    }

    public function getBarGraphInfo($schoolYear)
    {
        $colors = array();

        $firstYearColor = $this->getHexColor($colors);
        $colors[] = $firstYearColor;

        $secondYearColor = $this->getHexColor($colors);
        $colors[] = $secondYearColor;

        $thirdYearColor = $this->getHexColor($colors);
        $colors[] = $thirdYearColor;

        $fourthYearColor = $this->getHexColor($colors);
        $colors[] = $fourthYearColor;

        $fifthYearColor = $this->getHexColor($colors);
        $colors[] = $fifthYearColor;

        $events = $this->getEventsBySchoolYear($schoolYear);
        $attendances = $this->getAttendanceLists($schoolYear);
        $dataArr = array(
            "labels" => array(),
            "datasets" => array(
                array(
                    "label" => "1st Year",
                    "fillColor" => $firstYearColor,
                    "strokeColor" => $firstYearColor,
                    "pointColor" => $firstYearColor,
                    "pointStrokeColor" => $firstYearColor,
                    "pointHighlightFill" => "#fff",
                    "pointHighlightStroke" => $firstYearColor,
                    "data" => array()
                ),
                array(
                    "label" => "2nd Year",
                    "fillColor" => $secondYearColor,
                    "strokeColor" => $secondYearColor,
                    "pointColor" => $secondYearColor,
                    "pointStrokeColor" => $secondYearColor,
                    "pointHighlightFill" => "#fff",
                    "pointHighlightStroke" => $secondYearColor,
                    "data" => array()
                ),
                array(
                    "label" => "Third Year",
                    "fillColor" => $thirdYearColor,
                    "strokeColor" => $thirdYearColor,
                    "pointColor" => $thirdYearColor,
                    "pointStrokeColor" => $thirdYearColor,
                    "pointHighlightFill" => "#fff",
                    "pointHighlightStroke" => $thirdYearColor,
                    "data" => array()
                ),
                array(
                    "label" => "4th Year",
                    "fillColor" => $fourthYearColor,
                    "strokeColor" => $fourthYearColor,
                    "pointColor" => $fourthYearColor,
                    "pointStrokeColor" => $fourthYearColor,
                    "pointHighlightFill" => "#fff",
                    "pointHighlightStroke" => $fourthYearColor,
                    "data" => array()
                ),
                array(
                    "label" => "5th Year",
                    "fillColor" => $fifthYearColor,
                    "strokeColor" => $fifthYearColor,
                    "pointColor" => $fifthYearColor,
                    "pointStrokeColor" => $fifthYearColor,
                    "pointHighlightFill" => "#fff",
                    "pointHighlightStroke" => $fifthYearColor,
                    "data" => array()
                )
            )
        );

        foreach($events as $event)
        {
            $yearsArray = array(0,0,0,0,0);

            foreach($attendances as $attendance)
            {
                if($event['eventid'] == $attendance['eventid'])
                {
                    if($attendance['year'] == 1)
                    {
                        $yearsArray[0]++;
                    }

                    if($attendance['year'] == 2)
                    {
                        $yearsArray[1]++;
                    }

                    if($attendance['year'] == 3)
                    {
                        $yearsArray[2]++;
                    }

                    if($attendance['year'] == 4)
                    {
                        $yearsArray[3]++;
                    }

                    if($attendance['year'] == 5)
                    {
                        $yearsArray[4]++;
                    }
                }
            }

            $dataArr["labels"][] = $event['event_name'];

            for($i = 0; $i < 5; $i++)
            {
                $dataArr["datasets"][$i]['data'][] = $yearsArray[$i];
            }
        }

        return $dataArr;
    }
}