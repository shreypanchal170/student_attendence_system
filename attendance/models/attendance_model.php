<?php

class Attendance_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getStudentByBarcode($barcode)
    {
    	return $this->db->selectSingleData("SELECT * FROM student LEFT JOIN student_academic_details ON student_academic_details.studentid = student.studentid LEFT JOIN course ON course.courseid = student_academic_details.courseid LEFT JOIN student_barcode ON student_barcode.studentid = student.studentid WHERE student_barcode.barcode = '{$barcode}' AND student_academic_details.schoolyear = '".$this->currentSchoolYear()."'");
    }

    public function getEvents()
    {
    	$currentHour = date("H");
    	$currentDate = date('Y-m-d');
    	$currentTime = date('H:i');

    	$filter = "";

        $eventDaysArr = array();

    	if(Session::get("role") == "officer")
    	{
    		$eventAssigned = $this->db->select("SELECT * FROM event_officer WHERE userid = " . Session::get("userid"));

    		$eventIds = array();

    		foreach($eventAssigned as $event)
    		{
                if($event['status'] == "wholeday")
                {
        			$eventIds[] = $event['eventid'];
                }

                if($event['status'] == "morning" && $currentHour <= 12)
                {
                    $eventIds[] = $event['eventid'];
                }

                if($event['status'] == "afternoon" && $currentHour > 12)
                {
                    $eventIds[] = $event['eventid'];
                }

                $eventDaysArr[] = array(
                    "eventId" => $event['eventid'],
                    "daysArr" => explode("||",$event['days'])
                );
    		}

    		$filter = (count($eventIds) > 0) ? " AND eventid IN (".implode(',', $eventIds).")" : " AND eventid = -1";
    	}

    	if($currentHour <= 12)
    	{
    		$events = $this->db->select("SELECT * FROM `event` WHERE semester = ".$this->currentSemester()." AND schoolyear = '".$this->currentSchoolYear()."' AND ('{$currentDate}' BETWEEN event_start_date AND event_end_date) AND ('{$currentTime}:00' BETWEEN event_starttime_am AND event_endtime_am){$filter}");
    	}
    	else
    	{
    		$events = $this->db->select("SELECT * FROM `event` WHERE semester = ".$this->currentSemester()." AND schoolyear = '".$this->currentSchoolYear()."' AND ('{$currentDate}' BETWEEN event_start_date AND event_end_date) AND ('{$currentTime}:00' BETWEEN event_starttime_pm AND event_endtime_pm){$filter}");
    	}

        $lists = array();

        if(!empty($events))
        {
            $currentDateAndTime = strtotime($currentDate . " 00:00:00");

            foreach($events as $event)
            {
                $daysArrInfo = array();

                foreach($eventDaysArr as $eventDayArr)
                {
                    if($eventDayArr['eventId'] == $event['eventid'])
                    {
                        $daysArrInfo = $eventDayArr['daysArr'];
                        break;
                    }
                }

                $startDate = strtotime($event['event_start_date'] . " 00:00:00");
                $endDate = strtotime($event['event_end_date'] . " 00:00:00");
                
                $countDays = 1;

                if($startDate != $endDate):
                    $countDays = $endDate - $startDate;
                    $countDays = ($countDays / (60 * 60 * 24)) + 1;
                endif;

                for($iter = 1; $iter <= $countDays; $iter++)
                {
                    if(in_array($iter, $daysArrInfo))
                    {
                        $eventStartDate = $startDate;

                        if($iter > 1)
                        {
                            $eventStartDate = strtotime(" +" . ($iter - 1) . " day", $eventStartDate);
                        }

                        if($currentDateAndTime == $eventStartDate)
                        {
                            $lists[] = $event;
                        }
                    }
                }
            }
        }

    	return $lists;
    }

    public function processAttendance($studentId, $eventId)
    {
    	$currentHour = date('H');
    	$timeStat = "morning";

    	if($currentHour > 12)
    	{
    		$timeStat = "afternoon";
    	}

        $currentDate = date('Y-m-d');

        $event = $this->db->selectSingleData("SELECT * FROM event WHERE eventid = $eventId AND semester = ".$this->currentSemester()." AND schoolyear = '".$this->currentSchoolYear()."'");

        $currentTime = time();

        if($timeStat == "morning" && ($event['status'] == "wholeday" || $event['status'] == "morning"))
        {
            $morningStartTimeIn = strtotime(date('Y-m-d') . " " . $event['event_starttime_am_in']);
            $morningEndTimeIn = strtotime(date('Y-m-d') . " " . $event['event_endtime_am_in']);

            if($currentTime >= $morningStartTimeIn && $currentTime <= $morningEndTimeIn)
            {
                $check = $this->db->select("SELECT * FROM attendance WHERE studentid = $studentId AND eventid = $eventId AND status = 'in' AND time_status = '{$timeStat}' AND DATE(dateadded) = '{$currentDate}'");

                if(count($check) == 0)
                {
                    $this->db->insert("attendance", array("studentid" => $studentId, "eventid" => $eventId, "status" => "in", "time_status" => $timeStat, "semester" =>$this->currentSemester(), "schoolyear" => $this->currentSchoolYear()));
                    return 1;
                }

                return 0;
            }

            $morningStartTimeOut = strtotime(date('Y-m-d') . " " . $event['event_starttime_am_out']);
            $morningEndTimeOut = strtotime(date('Y-m-d') . " " . $event['event_endtime_am_out']);

            if($currentTime >= $morningStartTimeOut && $currentTime <= $morningEndTimeOut)
            {
                $check = $this->db->select("SELECT * FROM attendance WHERE studentid = $studentId AND eventid = $eventId AND status = 'out' AND time_status = '{$timeStat}' AND DATE(dateadded) = '{$currentDate}'");

                if(count($check) == 0)
                {
                    $this->db->insert("attendance", array("studentid" => $studentId, "eventid" => $eventId, "status" => "out", "time_status" => $timeStat, "semester" =>$this->currentSemester(), "schoolyear" => $this->currentSchoolYear()));
                    return 1;
                }

                return 0;
            }
            else
            {
                return -2;
            }
        }

        if($timeStat == "afternoon" && ($event['status'] == "wholeday" || $event['status'] == "afternoon"))
        {
            $afternoonStartTimeIn = strtotime(date('Y-m-d') . " " . $event['event_starttime_pm_in']);
            $afternoonEndTimeIn = strtotime(date('Y-m-d') . " " . $event['event_endtime_pm_in']);

            if($currentTime >= $afternoonStartTimeIn && $currentTime <= $afternoonEndTimeIn)
            {
                $check = $this->db->select("SELECT * FROM attendance WHERE studentid = $studentId AND eventid = $eventId AND status = 'in' AND time_status = '{$timeStat}' AND DATE(dateadded) = '{$currentDate}'");

                if(count($check) == 0)
                {
                    $this->db->insert("attendance", array("studentid" => $studentId, "eventid" => $eventId, "status" => "in", "time_status" => $timeStat, "semester" =>$this->currentSemester(), "schoolyear" => $this->currentSchoolYear()));
                    return 1;
                }

                return 0;
            }

            $afternoonStartTimeOut = strtotime(date('Y-m-d') . " " . $event['event_starttime_pm_out']);
            $afternoonEndTimeOut = strtotime(date('Y-m-d') . " " . $event['event_endtime_pm_out']);

            if($currentTime >= $afternoonStartTimeOut && $currentTime <= $afternoonEndTimeOut)
            {
                $check = $this->db->select("SELECT * FROM attendance WHERE studentid = $studentId AND eventid = $eventId AND status = 'out' AND time_status = '{$timeStat}' AND DATE(dateadded) = '{$currentDate}'");

                if(count($check) == 0)
                {
                    $this->db->insert("attendance", array("studentid" => $studentId, "eventid" => $eventId, "status" => "out", "time_status" => $timeStat, "semester" =>$this->currentSemester(), "schoolyear" => $this->currentSchoolYear()));
                    return 1;
                }

                return 0;
            }
            else
            {
                return -2;
            }
        }

        return -1;
    }

    public function eventAttendance($eventId, $studentIdExclude)
    {
        return $this->db->select("SELECT * FROM attendance LEFT JOIN student ON student.studentid = attendance.studentid WHERE attendance.eventid = $eventId AND attendance.semester = ".$this->currentSemester()." AND attendance.schoolyear = '".$this->currentSchoolYear()."' ORDER BY attendance.dateadded DESC");
    }

    public function getRecentLoggedInStudent($studentId, $eventId)
    {
        return $this->db->selectSingleData("SELECT * FROM attendance LEFT JOIN student ON student.studentid = attendance.studentid LEFT JOIN course ON course.courseid = student.courseid WHERE attendance.studentid != $studentId AND attendance.eventid = $eventId AND attendance.semester = ".$this->currentSemester()." AND attendance.schoolyear = '".$this->currentSchoolYear()."' ORDER BY attendance.dateadded DESC");
    }
}