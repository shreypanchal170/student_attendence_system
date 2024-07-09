<?php

class Index_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function loadEvents()
    {
    	return $this->db->select("SELECT * FROM event WHERE semester = ".$this->currentSemester()." AND schoolyear = '".$this->currentSchoolYear()."'");
    }

    public function loadEventsJSON()
    {
    	$events = $this->loadEvents();

    	$dataArr = array();

    	if($events != null && count($events) > 0)
    	{
    		foreach($events as $event)
    		{
                $startDate = $event['event_start_date'] . "T" . $event['event_starttime_am'] . "+" . $event['event_endtime_pm'];
                $endDate = $event['event_end_date'] . "T" . $event['event_starttime_am'] . "+" . $event['event_endtime_pm'];

                switch($event['status'])
                {
                    case "morning":

                        $startDate = $event['event_start_date'] . "T" . $event['event_starttime_am'];
                        $endDate = $event['event_end_date'] . "T" . $event['event_endtime_am'];

                        break;
                    case "afternoon":

                        $startDate = $event['event_start_date'] . "T" . $event['event_starttime_pm'];
                        $endDate = $event['event_end_date'] . "T" . $event['event_endtime_pm'];

                        break;
                }

    			$allDay = ($event['status'] == "wholeday") ? true : false;

    			$dataArr[] = array(
    				"id" => $event['eventid'],
    				"title" => $event['event_name'],
    				"start" => $startDate,
    				"end" => $endDate,
    				"allDay" => $allDay
    			);
    		}
    	}

    	return json_encode($dataArr);
    }
}