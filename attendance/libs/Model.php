<?php
class Model
{

    function __construct()
	{
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }
    
    function saveLog($description)
    {
    	$this->db->insert("user_log", array("userid" => $_SESSION['userid'], "description" => $description, "datelog" => date('Y-m-d H:i:s')));
    }
	
	function humanTiming($time)
	{
		$time = time() - $time;
		$time = ($time<1)? 1 : $time;
		$tokens = array (
			31536000 => 'year',
			2592000 => 'month',
			604800 => 'week',
			86400 => 'day',
			3600 => 'hour',
			60 => 'minute',
			1 => 'second'
		);

		foreach ($tokens as $unit => $text) {
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
		}
	}

	function getStringBetween($string, $start, $end){
		$string = ' ' . $string;
		$ini = strpos($string, $start);
		if ($ini == 0) return '';
		$ini += strlen($start);
		$len = strpos($string, $end, $ini) - $ini;
		return substr($string, $ini, $len);
	}

	function base64ToImageFile($base64String, $ext, $uploadDirectory)
	{
	    $filenamePath = md5(time().uniqid()).".".$ext;
	    $decoded = base64_decode($base64String);
	    file_put_contents($uploadDirectory."/".$filenamePath,$decoded);

	    return $filenamePath;
	}

	function currentSchoolYear()
	{
		$currentYear = date('Y');
		return (in_array(date('n'),array(6,7,8,9,10,11,12))) ? $currentYear . "-" . ($currentYear + 1) : ($currentYear - 1) . "-" . $currentYear;
	}

	function currentSchoolFirstYear()
	{
		$currentYear = date('Y');
		return (in_array(date('n'),array(6,7,8,9,10,11,12))) ? $currentYear : ($currentYear - 1);
	}

	function currentSemester()
	{
		return (in_array(date('n'),array(6,7,8,9,10))) ? 1 : 2;
	}

	function checkIfYearLevelIsUpdatedForCurrentSchoolYear()
	{
		$checkInfo = $this->db->selectSingleData("SELECT * FROM student_yearlevel_update WHERE schoolyear = '".$this->currentSchoolYear()."'");

		return ($checkInfo != null) ? true : false;
	}

	function getSchoolYears()
	{
		return $this->db->select("SELECT schoolyear FROM student_academic_details WHERE schoolyear != '".$this->currentSchoolYear()."' GROUP BY schoolyear");
	}
}