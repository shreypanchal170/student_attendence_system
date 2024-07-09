<?php

class Events_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getEvents()
    {
    	return $this->db->select("SELECT *, (SELECT COUNT(*) FROM event_officer WHERE event_officer.eventid = event.eventid) AS officerCount FROM event WHERE semester = ".$this->currentSemester()." AND schoolyear = '".$this->currentSchoolYear()."'");
    }

    public function getOfficers()
    {
        return $this->db->select("SELECT * FROM user WHERE position = 'officer'");
    }

    public function getEventOfficers($eventId)
    {
        return $this->db->select("SELECT * FROM event_officer WHERE eventid = $eventId");
    }

    public function getEventInfo($eventId)
    {
        return $this->db->selectSingleData("SELECT * FROM event WHERE eventid = $eventId");
    }

    public function getOfficerAssignedEvents()
    {
        return $this->db->select("SELECT *, event_officer.status AS assignedStatus FROM event LEFT JOIN event_officer ON event_officer.eventid = event.eventid WHERE event_officer.userid = " . Session::get('userid') . " AND semester = ".$this->currentSemester()." AND schoolyear = '".$this->currentSchoolYear()."'");
    }

    public function getEventsLists()
    {
        $lists = $this->getEvents();

        $data = array();

        foreach($lists as $item)
        {
            $date = date("M d, Y", strtotime($item['event_start_date'])) . " - " . date("M d, Y", strtotime($item['event_end_date']));
            $time = "";

            if($item['status'] == "wholeday")
            {
                $time = date("h:i A", strtotime($item['event_starttime_am'])) . " - " . date("h:i A", strtotime($item['event_endtime_pm']));
            }

            if($item['status'] == "morning")
            {
                $time = date("h:i A", strtotime($item['event_starttime_am'])) . " - " . date("h:i A", strtotime($item['event_endtime_am']));
            }

            if($item['status'] == "afternoon")
            {
                $time = date("h:i A", strtotime($item['event_starttime_pm'])) . " - " . date("h:i A", strtotime($item['event_endtime_pm']));
            }

            $data[] = array($date, $item['event_name'], $item['event_place'], ucwords($item['status']), $date, $time, $item['officerCount'], '<a class="btn btn-xs btn-success modalMode" href="'.URL.'events/edit/'.$item['eventid'].'"><i class="fa fa-edit"></i></a> <a class="btn btn-xs btn-success modalMode" href="'.URL.'events/editOfficers/'.$item['eventid'].'"><i class="fa fa-users"></i></a>');
        }   

        return json_encode( array("data" => $data) );
    }

    public function getOfficerEventsLists()
    {
    	$lists = $this->getOfficerAssignedEvents();

    	$data = array();

    	foreach($lists as $item)
    	{
    		$date = date("M d, Y", strtotime($item['event_start_date'])) . " - " . date("M d, Y", strtotime($item['event_end_date']));
            $time = "";

    		if($item['assignedStatus'] == "wholeday")
    		{
    			$time = date("h:i A", strtotime($item['event_starttime_am'])) . " - " . date("h:i A", strtotime($item['event_endtime_pm']));
    		}

    		if($item['assignedStatus'] == "morning")
    		{
    			$time = date("h:i A", strtotime($item['event_starttime_am'])) . " - " . date("h:i A", strtotime($item['event_endtime_am']));
    		}

    		if($item['assignedStatus'] == "afternoon")
    		{
    			$time = date("h:i A", strtotime($item['event_starttime_pm'])) . " - " . date("h:i A", strtotime($item['event_endtime_pm']));
    		}

    		$data[] = array($item['event_name'], $item['event_place'], ucwords($item['assignedStatus']), $date, $time);
    	}	

    	return json_encode( array("data" => $data) );
    }

    public function add($POST)
    {
    	if(trim($POST['event_name']) == "")
    	{
    		return array("result" => -1, "reason" => "Event Name must not be empty");
    	}

    	if(trim($POST['event_place']) == "")
    	{
    		return array("result" => -1, "reason" => "Event Place must not be empty");
    	}

    	if($POST['event_date'] == "")
    	{
    		return array("result" => -1, "reason" => "Event Date must not be empty");
    	}

        if($POST['status'] != "afternoon")
        {
        	if($POST['event_starttime_am'] == "")
        	{
        		return array("result" => -1, "reason" => "Morning Start Time AM must not be empty");
        	}

            if($POST['event_endtime_am'] == "")
            {
                return array("result" => -1, "reason" => "Morning End Time AM must not be empty");
            }
        }

        if($POST['status'] != "morning")
        {
        	if($POST['event_starttime_pm'] == "")
            {
                return array("result" => -1, "reason" => "Afternoon Start Time PM must not be empty");
            }

            if($POST['event_endtime_pm'] == "")
            {
                return array("result" => -1, "reason" => "Afternoon End Time PM must not be empty");
            }
        }

        if($POST['status'] != "afternoon")
        {
            if($POST['event_starttime_am_in'] == "")
            {
                return array("result" => -1, "reason" => "Morning Start Time In must not be empty");
            }

            if($POST['event_endtime_am_in'] == "")
            {
                return array("result" => -1, "reason" => "Morning End Time In must not be empty");
            }

            if($POST['event_starttime_am_out'] == "")
            {
                return array("result" => -1, "reason" => "Morning Start Time Out must not be empty");
            }

            if($POST['event_endtime_am_out'] == "")
            {
                return array("result" => -1, "reason" => "Morning End Time Out must not be empty");
            }
        }

        if($POST['status'] != "morning")
        {
            if($POST['event_starttime_pm_in'] == "")
            {
                return array("result" => -1, "reason" => "Afternoon Start Time In must not be empty");
            }

            if($POST['event_endtime_pm_in'] == "")
            {
                return array("result" => -1, "reason" => "Afternoon End Time In must not be empty");
            }

            if($POST['event_starttime_pm_out'] == "")
            {
                return array("result" => -1, "reason" => "Afternoon Start Time Out must not be empty");
            }

            if($POST['event_endtime_pm_out'] == "")
            {
                return array("result" => -1, "reason" => "Afternoon End Time Out must not be empty");
            }
        }

        $startTimeAM = strtotime($POST['event_starttime_am']);
        $endTimeAM = strtotime($POST['event_endtime_am']);

        if($POST['status'] != "afternoon")
        {
            $startTimeHour = date('H', $startTimeAM);
            $endTimeHour = date('H', $endTimeAM);

            if($startTimeHour > 12)
            {
                return array("result" => -1, "reason" => "Start Time AM must not exceed 12 pm");
            }

            if($endTimeHour > 12)
            {
                return array("result" => -1, "reason" => "End Time AM must not exceed 12 pm");
            }

            if($startTimeAM >= $endTimeAM)
            {
                return array("result" => -1, "reason" => "Start Time AM must not be greater or equal to End Time AM");
            }

            $startTimeAMIn = strtotime($POST['event_starttime_am_in']);        
            $endTimeAMIn = strtotime($POST['event_endtime_am_in']);

            $startTimeAMOut = strtotime($POST['event_starttime_am_out']);
            $endTimeAMOut = strtotime($POST['event_endtime_am_out']);

            if($startTimeAMIn < $startTimeAM || $startTimeAMIn > $endTimeAM)
            {
                return array("result" => -1, "reason" => "Start Time AM In must be within the start time and end time");
            }

            if($endTimeAMIn < $startTimeAM || $endTimeAMIn > $endTimeAM)
            {
                return array("result" => -1, "reason" => "End Time AM In must be within the start time and end time");
            }

            if($startTimeAMOut < $startTimeAM || $startTimeAMOut > $endTimeAM)
            {
                return array("result" => -1, "reason" => "Start Time AM Out must be within the start time and end time");
            }

            if($endTimeAMOut < $startTimeAM || $endTimeAMOut > $endTimeAM)
            {
                return array("result" => -1, "reason" => "End Time AM Out must be within the start time and end time");
            }
        }

        $startTimePM = strtotime($POST['event_starttime_pm']);
        $endTimePM = strtotime($POST['event_endtime_pm']);

        if($POST['status'] != "morning")
        {
            $startTimeHour = date('H', $startTimePM);
            $endTimeHour = date('H', $endTimePM);

            if($startTimeHour < 13)
            {
                return array("result" => -1, "reason" => "Start Time PM must not less than 1 pm");
            }

            if($endTimeHour < 13)
            {
                return array("result" => -1, "reason" => "End Time PM must not less than 1 pm");
            }

            if($startTimePM >= $endTimePM)
            {
                return array("result" => -1, "reason" => "Start Time PM must not be greater or equal to End Time PM");
            }

            $startTimePMIn = strtotime($POST['event_starttime_pm_in']);        
            $endTimePMIn = strtotime($POST['event_endtime_pm_in']);

            $startTimePMOut = strtotime($POST['event_starttime_pm_out']);
            $endTimePMOut = strtotime($POST['event_endtime_pm_out']);

            if($startTimePMIn < $startTimePM || $startTimePMIn > $endTimePM)
            {
                return array("result" => -1, "reason" => "Start Time PM In must be within the start time and end time");
            }

            if($endTimePMIn < $startTimePM || $endTimePMIn > $endTimePM)
            {
                return array("result" => -1, "reason" => "End Time PM In must be within the start time and end time");
            }

            if($startTimePMOut < $startTimePM || $startTimePMOut > $endTimePM)
            {
                return array("result" => -1, "reason" => "Start Time PM Out must be within the start time and end time");
            }

            if($endTimePMOut < $startTimePM || $endTimePMOut > $endTimePM)
            {
                return array("result" => -1, "reason" => "End Time PM Out must be within the start time and end time");
            }
        }

        $morningStartInTime = strtotime($POST['event_starttime_am_in']);
        $morningEndInTime = strtotime($POST['event_endtime_am_in']);
        $morningStartOutTime = strtotime($POST['event_starttime_am_out']);
        $morningEndOutTime = strtotime($POST['event_endtime_am_out']);

        if($POST['status'] != "afternoon")
        {
            $morningInAdvance = $morningStartInTime + 3600;
            $morningOutAdvance = $morningStartOutTime + 3600;

            if($morningInAdvance != $morningEndInTime)
            {
                return array("result" => -1, "reason" => "Morning time in must be one hour interval");
            }

            if($morningOutAdvance != $morningEndOutTime)
            {
                return array("result" => -1, "reason" => "Morning time out must be one hour interval");
            }
        }

        $afternoonStartInTime = strtotime($POST['event_starttime_pm_in']);
        $afternoonEndInTime = strtotime($POST['event_endtime_pm_in']);
        $afternoonStartOutTime = strtotime($POST['event_starttime_pm_out']);
        $afternoonEndOutTime = strtotime($POST['event_endtime_pm_out']);

        if($POST['status'] != "morning")
        {
            $afternoonInAdvance = $afternoonStartInTime + 3600;
            $afternoonOutAdvance = $afternoonStartOutTime + 3600;

            if($afternoonInAdvance != $afternoonEndInTime)
            {
                return array("result" => -1, "reason" => "Afternoon time in must be one hour interval");
            }

            if($afternoonOutAdvance != $afternoonEndOutTime)
            {
                return array("result" => -1, "reason" => "Afternoon time out must be one hour interval");
            }
        }

        $eventDate = explode(" - ", $POST['event_date']);

        $dataArr = array(
            "event_start_date" => $eventDate[0],
            "event_end_date" => $eventDate[1],
            "semester" => $this->currentSemester(),
            "schoolyear" => $this->currentSchoolYear()
        );

        $POST["event_starttime_am"] = date("H:i:s", $startTimeAM);
        $POST["event_endtime_am"] = date("H:i:s", $endTimeAM);
        $POST["event_starttime_am_in"] = date("H:i:s", $morningStartInTime);
        $POST["event_endtime_am_in"] = date("H:i:s", $morningEndInTime);
        $POST["event_starttime_am_out"] = date("H:i:s", $morningStartOutTime);
        $POST["event_endtime_am_out"] = date("H:i:s", $morningEndOutTime);

        $POST["event_starttime_pm"] = date("H:i:s", $startTimePM);
        $POST["event_endtime_pm"] = date("H:i:s", $endTimePM);
        $POST["event_starttime_pm_in"] = date("H:i:s", $afternoonStartInTime);
        $POST["event_endtime_pm_in"] = date("H:i:s", $afternoonEndInTime);
        $POST["event_starttime_pm_out"] = date("H:i:s", $afternoonStartOutTime);
        $POST["event_endtime_pm_out"] = date("H:i:s", $afternoonEndOutTime);

        if($POST['status'] == "morning")
        {
            $POST['event_starttime_pm'] = "00:00:00";
            $POST['event_endtime_pm'] = "00:00:00";
            $POST['event_starttime_pm_in'] = "00:00:00";
            $POST['event_endtime_pm_in'] = "00:00:00";
            $POST['event_starttime_pm_out'] = "00:00:00";
            $POST['event_endtime_pm_out'] = "00:00:00";
        }

        if($POST['status'] == "afternoon")
        {
            $POST['event_starttime_am'] = "00:00:00";
            $POST['event_endtime_am'] = "00:00:00";
            $POST['event_starttime_am_in'] = "00:00:00";
            $POST['event_endtime_am_in'] = "00:00:00";
            $POST['event_starttime_am_out'] = "00:00:00";
            $POST['event_endtime_am_out'] = "00:00:00";
        }

        unset($POST['event_date']);

        $dataArr = array_merge($dataArr, $POST);

    	$this->db->insert("event", $dataArr);

        $eventId = $this->db->lastInsertId();

    	return array("result" => 1, "reason" => "Event successfully created.", "eventId" => $eventId);
    }

    public function update($eventId, $POST)
    {
        if(trim($POST['event_name']) == "")
        {
            return array("result" => -1, "reason" => "Event Name must not be empty");
        }

        if(trim($POST['event_place']) == "")
        {
            return array("result" => -1, "reason" => "Event Place must not be empty");
        }

        if($POST['event_date'] == "")
        {
            return array("result" => -1, "reason" => "Event Date must not be empty");
        }

        if($POST['status'] != "afternoon")
        {
            if($POST['event_starttime_am'] == "")
            {
                return array("result" => -1, "reason" => "Morning Start Time AM must not be empty");
            }

            if($POST['event_endtime_am'] == "")
            {
                return array("result" => -1, "reason" => "Morning End Time AM must not be empty");
            }
        }

        if($POST['status'] != "morning")
        {
            if($POST['event_starttime_pm'] == "")
            {
                return array("result" => -1, "reason" => "Afternoon Start Time PM must not be empty");
            }

            if($POST['event_endtime_pm'] == "")
            {
                return array("result" => -1, "reason" => "Afternoon End Time PM must not be empty");
            }
        }

        if($POST['status'] != "afternoon")
        {
            if($POST['event_starttime_am_in'] == "")
            {
                return array("result" => -1, "reason" => "Morning Start Time In must not be empty");
            }

            if($POST['event_endtime_am_in'] == "")
            {
                return array("result" => -1, "reason" => "Morning End Time In must not be empty");
            }

            if($POST['event_starttime_am_out'] == "")
            {
                return array("result" => -1, "reason" => "Morning Start Time Out must not be empty");
            }

            if($POST['event_endtime_am_out'] == "")
            {
                return array("result" => -1, "reason" => "Morning End Time Out must not be empty");
            }
        }

        if($POST['status'] != "morning")
        {
            if($POST['event_starttime_pm_in'] == "")
            {
                return array("result" => -1, "reason" => "Afternoon Start Time In must not be empty");
            }

            if($POST['event_endtime_pm_in'] == "")
            {
                return array("result" => -1, "reason" => "Afternoon End Time In must not be empty");
            }

            if($POST['event_starttime_pm_out'] == "")
            {
                return array("result" => -1, "reason" => "Afternoon Start Time Out must not be empty");
            }

            if($POST['event_endtime_pm_out'] == "")
            {
                return array("result" => -1, "reason" => "Afternoon End Time Out must not be empty");
            }
        }

        $startTimeAM = strtotime($POST['event_starttime_am']);
        $endTimeAM = strtotime($POST['event_endtime_am']);

        $startTimeAMIn = strtotime($POST['event_starttime_am_in']);        
        $endTimeAMIn = strtotime($POST['event_endtime_am_in']);
        $startTimeAMOut = strtotime($POST['event_starttime_am_out']);
        $endTimeAMOut = strtotime($POST['event_endtime_am_out']);

        if($POST['status'] != "afternoon")
        {
            $startTimeHour = date('H', $startTimeAM);
            $endTimeHour = date('H', $endTimeAM);

            if($startTimeHour > 12)
            {
                return array("result" => -1, "reason" => "Start Time AM must not exceed 12 pm");
            }

            if($endTimeHour > 12)
            {
                return array("result" => -1, "reason" => "End Time AM must not exceed 12 pm");
            }
            
            if($startTimeAM >= $endTimeAM)
            {
                return array("result" => -1, "reason" => "Start Time AM must not be greater or equal to End Time AM");
            }

            if($startTimeAMIn < $startTimeAM || $startTimeAMIn > $endTimeAM)
            {
                return array("result" => -1, "reason" => "Start Time AM In must be within the start time and end time");
            }

            if($endTimeAMIn < $startTimeAM || $endTimeAMIn > $endTimeAM)
            {
                return array("result" => -1, "reason" => "End Time AM In must be within the start time and end time");
            }

            if($startTimeAMOut < $startTimeAM || $startTimeAMOut > $endTimeAM)
            {
                return array("result" => -1, "reason" => "Start Time AM Out must be within the start time and end time");
            }

            if($endTimeAMOut < $startTimeAM || $endTimeAMOut > $endTimeAM)
            {
                return array("result" => -1, "reason" => "End Time AM Out must be within the start time and end time");
            }
        }

        $startTimePM = strtotime($POST['event_starttime_pm']);
        $endTimePM = strtotime($POST['event_endtime_pm']);

        $startTimePMIn = strtotime($POST['event_starttime_pm_in']);        
        $endTimePMIn = strtotime($POST['event_endtime_pm_in']);
        $startTimePMOut = strtotime($POST['event_starttime_pm_out']);
        $endTimePMOut = strtotime($POST['event_endtime_pm_out']);

        if($POST['status'] != "morning")
        {
            $startTimeHour = date('H', $startTimePM);
            $endTimeHour = date('H', $endTimePM);

            if($startTimeHour < 13)
            {
                return array("result" => -1, "reason" => "Start Time PM must not less than 1 pm");
            }

            if($endTimeHour < 13)
            {
                return array("result" => -1, "reason" => "End Time PM must not less than 1 pm");
            }

            if($startTimePM >= $endTimePM)
            {
                return array("result" => -1, "reason" => "Start Time PM must not be greater or equal to End Time PM");
            }

            if($startTimePMIn < $startTimePM || $startTimePMIn > $endTimePM)
            {
                return array("result" => -1, "reason" => "Start Time PM In must be within the start time and end time");
            }

            if($endTimePMIn < $startTimePM || $endTimePMIn > $endTimePM)
            {
                return array("result" => -1, "reason" => "End Time PM In must be within the start time and end time");
            }

            if($startTimePMOut < $startTimePM || $startTimePMOut > $endTimePM)
            {
                return array("result" => -1, "reason" => "Start Time PM Out must be within the start time and end time");
            }

            if($endTimePMOut < $startTimePM || $endTimePMOut > $endTimePM)
            {
                return array("result" => -1, "reason" => "End Time PM Out must be within the start time and end time");
            }
        }

        $morningStartInTime = strtotime($POST['event_starttime_am_in']);
        $morningEndInTime = strtotime($POST['event_endtime_am_in']);
        $morningStartOutTime = strtotime($POST['event_starttime_am_out']);
        $morningEndOutTime = strtotime($POST['event_endtime_am_out']);

        if($POST['status'] != "afternoon")
        {
            $morningInAdvance = $morningStartInTime + 3600;
            $morningOutAdvance = $morningStartOutTime + 3600;

            if($morningInAdvance != $morningEndInTime)
            {
                return array("result" => -1, "reason" => "Morning time in must be one hour interval");
            }

            if($morningOutAdvance != $morningEndOutTime)
            {
                return array("result" => -1, "reason" => "Morning time out must be one hour interval");
            }
        }

        $afternoonStartInTime = strtotime($POST['event_starttime_pm_in']);
        $afternoonEndInTime = strtotime($POST['event_endtime_pm_in']);
        $afternoonStartOutTime = strtotime($POST['event_starttime_pm_out']);
        $afternoonEndOutTime = strtotime($POST['event_endtime_pm_out']);

        if($POST['status'] != "morning")
        {
            $afternoonInAdvance = $afternoonStartInTime + 3600;
            $afternoonOutAdvance = $afternoonStartOutTime + 3600;

            if($afternoonInAdvance != $afternoonEndInTime)
            {
                return array("result" => -1, "reason" => "Afternoon time in must be one hour interval");
            }

            if($afternoonOutAdvance != $afternoonEndOutTime)
            {
                return array("result" => -1, "reason" => "Afternoon time out must be one hour interval");
            }
        }

        $eventDate = explode(" - ", $POST['event_date']);

        $dataArr = array(
            "event_start_date" => $eventDate[0],
            "event_end_date" => $eventDate[1],
            "semester" => $this->currentSemester(),
            "schoolyear" => $this->currentSchoolYear()
        );

        $POST["event_starttime_am"] = date("H:i:s", $startTimeAM);
        $POST["event_endtime_am"] = date("H:i:s", $endTimeAM);
        $POST["event_starttime_am_in"] = date("H:i:s", $morningStartInTime);
        $POST["event_endtime_am_in"] = date("H:i:s", $morningEndInTime);
        $POST["event_starttime_am_out"] = date("H:i:s", $morningStartOutTime);
        $POST["event_endtime_am_out"] = date("H:i:s", $morningEndOutTime);

        if($POST['status'] == "morning")
        {
            $POST['event_starttime_pm'] = "00:00:00";
            $POST['event_endtime_pm'] = "00:00:00";
            $POST['event_starttime_pm_in'] = "00:00:00";
            $POST['event_endtime_pm_in'] = "00:00:00";
            $POST['event_starttime_pm_out'] = "00:00:00";
            $POST['event_endtime_pm_out'] = "00:00:00";
        }

        $POST["event_starttime_pm"] = date("H:i:s", $startTimePM);
        $POST["event_endtime_pm"] = date("H:i:s", $endTimePM);
        $POST["event_starttime_pm_in"] = date("H:i:s", $afternoonStartInTime);
        $POST["event_endtime_pm_in"] = date("H:i:s", $afternoonEndInTime);
        $POST["event_starttime_pm_out"] = date("H:i:s", $afternoonStartOutTime);
        $POST["event_endtime_pm_out"] = date("H:i:s", $afternoonEndOutTime);

        if($POST['status'] == "afternoon")
        {
            $POST['event_starttime_am'] = "00:00:00";
            $POST['event_endtime_am'] = "00:00:00";
            $POST['event_starttime_am_in'] = "00:00:00";
            $POST['event_endtime_am_in'] = "00:00:00";
            $POST['event_starttime_am_out'] = "00:00:00";
            $POST['event_endtime_am_out'] = "00:00:00";
        }

        unset($POST['event_date']);

        $dataArr = array_merge($dataArr, $POST);

        $this->db->update("event", $dataArr, "eventid = $eventId");

        return array("result" => 1, "reason" => "Event successfully updated.");
    }

    public function assignOfficer($eventId, $POST)
    {
        foreach($POST['userid'] as $key => $userId)
        {
            $status = $POST['status'][$key];

            $checkOfficer = $this->db->selectSingleData("SELECT * FROM event_officer WHERE eventid = $eventId AND userid = $userId");

            if($checkOfficer != null)
            {
                if($status != "unassigned")
                {
                    $officerDays = implode("||",$_POST['officerDay'.$userId]);

                    $this->db->update("event_officer", array("status" => $status, "days" => $officerDays), "eventid = $eventId AND userid = $userId");
                }
                else
                {
                    $this->db->delete("event_officer", "eventid = $eventId AND userid = $userId");
                }
            }
            else
            {
                if($status != "unassigned")
                {
                    $officerDays = implode("||",$_POST['officerDay'.$userId]);
                    
                    $this->db->insert("event_officer", array("status" => $status, "eventid" => $eventId, "userid" => $userId, "days" => $officerDays));
                }
            }
        }

        return array("result" => 1, "reason" => "Event Officers Status Updated");
    }
}