<?php

class Students_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getStudents()
    {
    	/*$lists = $this->db->select("SELECT * FROM student_academic_details LEFT JOIN student ON student.studentid = student_academic_details.studentid LEFT JOIN student_barcode ON student_barcode.studentid = student.studentid LEFT JOIN course ON course.courseid = student_academic_details.courseid WHERE student_academic_details.schoolyear = '".$this->currentSchoolYear()."'");

        if($lists != null)
        {
            return $lists;
        }*/

        return $this->db->select("SELECT * FROM student LEFT JOIN student_academic_details ON student.studentid = student_academic_details.studentid LEFT JOIN student_barcode ON student_barcode.studentid = student.studentid LEFT JOIN course ON course.courseid = student_academic_details.courseid WHERE student_academic_details.schoolyear = (SELECT MAX(student_academic_details.schoolyear) FROM student_academic_details WHERE student_academic_details.studentid = student.studentid)");
    }

    public function getStudentInfo($studentId)
    {
        return $this->db->selectSingleData("SELECT * FROM student LEFT JOIN student_academic_details ON student_academic_details.studentid = student.studentid AND student_academic_details.schoolyear = '".$this->currentSchoolYear()."' LEFT JOIN course ON course.courseid = student_academic_details.courseid LEFT JOIN student_barcode ON student_barcode.studentid = student.studentid WHERE student.studentid = $studentId");
    }

    public function getCourses()
    {
        return $this->db->select("SELECT * FROM course ORDER BY course_name ASC");
    }

    public function getDepartments()
    {
        return $this->db->select("SELECT * FROM department ORDER BY department_name ASC");
    }

    public function getEventsLists()
    {
        return $this->db->select("SELECT * FROM event WHERE schoolyear = '".$this->currentSchoolYear()."'");
    }

    public function getCurrentEventsLists()
    {
        return $this->db->select("SELECT * FROM event WHERE '".date('Y-m-d')."' BETWEEN event_start_date AND event_end_date");
    }

    public function getStudentsLists()
    {
    	$lists = $this->getStudents();

    	$data = array();

    	foreach($lists as $item)
    	{
    		$name = $item['lastname'] . ", " . $item['firstname'] . ((trim($item['middlename']) != "") ? " " . $item['middlename'] : "");
    		$data[] = array($item['barcode'], ucwords($name), $item['course_name'] . " " . $item['year'].$item['section'], '<a class="btn btn-xs btn-success modalMode" href="'.URL.'students/view/'.$item['studentid'].'"><i class="fa fa-eye"></i></a> <a class="btn btn-xs btn-success" target="_blank" href="'.URL.'students/barcode/'.$item['studentid'].'"><i class="fa fa-barcode"></i></a> <a class="btn btn-xs btn-success" href="'.URL.'students/attendance/'.$item['studentid'].'"><i class="fa fa-list"></i></a> <a class="btn btn-xs btn-success" href="'.URL.'students/edit/'.$item['studentid'].'"><i class="fa fa-edit"></i></a>');
    	}	

    	return json_encode( array("data" => $data) );
    }

    public function add($POST)
    {
        if(trim($POST['idnumber']) == "")
        {
            return array("result" => -1, "reason" => "ID Number must not be empty");
        }

    	if(!is_numeric($POST['idnumber']))
    	{
    		return array("result" => -1, "reason" => "ID Number must be numeric");
    	}

    	if(strlen($POST['idnumber']) != 8)
    	{
    		return array("result" => -1, "reason" => "Invalid ID Number");
    	}

    	if(trim($POST['firstname']) == "")
    	{
    		return array("result" => -2, "reason" => "Firstname cannot be empty");
    	}

    	if(trim($POST['lastname']) == "")
    	{
    		return array("result" => -2, "reason" => "Lastname cannot be empty");
    	}

        if(trim($POST['departmentid']) == "")
        {
            return array("result" => -2, "reason" => "Department info cannot be empty");
        }

    	if(trim($POST['courseid']) == "")
    	{
    		return array("result" => -2, "reason" => "Course info cannot be empty");
    	}

    	if(trim($POST['year']) == "")
    	{
    		return array("result" => -2, "reason" => "Year info cannot be empty");
    	}

        if(trim($POST['section']) == "")
        {
            return array("result" => -2, "reason" => "Section info cannot be empty");
        }

    	if(trim($POST['mobile']) == "")
    	{
    		return array("result" => -2, "reason" => "Mobile Number cannot be empty");
    	}

    	if(!is_numeric($POST['mobile']) || strlen($POST['mobile']) != 10)
    	{
    		return array("result" => -3, "reason" => "Invalid Mobile Number");
    	}

    	if(trim($POST['image']) == "")
    	{
    		return array("result" => -3, "reason" => "Student must take a snapshot");
    	}

    	$checkStudent = $this->db->selectSingleData("SELECT * FROM student_barcode WHERE barcode = '{$POST['idnumber']}'");

    	if($checkStudent != null)
    	{
    		return array("result" => -4, "reason" => "ID Number already exist.");
    	}

    	$hasMiddlename = "";

    	if(trim($POST['middlename']) != "")
    	{
    		$hasMiddlename = " AND middlename = '{$POST['middlename']}'";
    	}

    	$checkName = $this->db->selectSingleData("SELECT * FROM student WHERE firstname = '{$POST['firstname']}' AND lastname = '{$POST['lastname']}'".$hasMiddlename);

    	if($checkName != null)
    	{
    		return array("result" => -5, "reason" => "Student already exist.");
    	}

        $ext = $this->getStringBetween($POST['image'], "data:image/", ";base64,");
    	$image = str_replace("data:image/".$ext.";base64,", "", $POST['image']);
    	$POST['image'] = $this->base64ToImageFile($image, $ext, UPLOAD_DIR . "student/");

        $barcode = $POST['idnumber'];

        unset($POST['idnumber']);
        unset($POST['departmentid']);

        $POST['section'] = strtoupper($POST['section']);

        $studentInfo = $POST;
        unset($studentInfo['courseid']);
        unset($studentInfo['year']);
        unset($studentInfo['section']);

        $this->db->insert("student", $studentInfo);
        $studentID = $this->db->lastInsertId();

        $studentAcademics = array(
            "courseid" => $POST['courseid'],
            "year" => $POST['year'],
            "section" => $POST['section'],
            "studentid" => $studentID,
            "schoolyear" => $this->currentSchoolYear()
        );

    	$this->db->insert("student_academic_details", $studentAcademics);

        $this->db->insert("student_barcode", array("studentid" => $studentID, "barcode" => $barcode));

    	return array("result" => 1, "reason" => "Student successfully added.");
    }

    public function update($studentId, $POST)
    {
        $info = $this->getStudentInfo($studentId);

        if(trim($POST['idnumber']) == "")
        {
            return array("result" => -1, "reason" => "ID Number must not be empty");
        }

        if(!is_numeric($POST['idnumber']))
        {
            return array("result" => -1, "reason" => "ID Number must be numeric");
        }

        if(strlen($POST['idnumber']) < 8 || strlen($POST['idnumber']) > 15)
        {
            return array("result" => -1, "reason" => "Invalid ID Number");
        }

        if(trim($POST['firstname']) == "")
        {
            return array("result" => -2, "reason" => "Firstname cannot be empty");
        }

        if(trim($POST['lastname']) == "")
        {
            return array("result" => -2, "reason" => "Lastname cannot be empty");
        }

        if(trim($POST['departmentid']) == "")
        {
            return array("result" => -2, "reason" => "Department info cannot be empty");
        }

        if(trim($POST['courseid']) == "")
        {
            return array("result" => -2, "reason" => "Course info cannot be empty");
        }

        if(trim($POST['year']) == "")
        {
            return array("result" => -2, "reason" => "Year info cannot be empty");
        }

        if(trim($POST['section']) == "")
        {
            return array("result" => -2, "reason" => "Section info cannot be empty");
        } 

        if(trim($POST['mobile']) == "")
        {
            return array("result" => -2, "reason" => "Mobile Number cannot be empty");
        }

        if(!is_numeric($POST['mobile']) || strlen($POST['mobile']) != 10)
        {
            return array("result" => -3, "reason" => "Invalid Mobile Number");
        }

        $checkStudent = $this->db->selectSingleData("SELECT * FROM student_barcode WHERE barcode = '{$POST['idnumber']}' AND studentid != $studentId");

        if($checkStudent != null)
        {
            return array("result" => -4, "reason" => "ID Number already exist.");
        }

        $hasMiddlename = "";

        if(trim($POST['middlename']) != "")
        {
            $hasMiddlename = " AND middlename = '{$POST['middlename']}'";
        }

        $checkName = $this->db->selectSingleData("SELECT * FROM student WHERE studentid != $studentId AND firstname = '{$POST['firstname']}' AND lastname = '{$POST['lastname']}'".$hasMiddlename);

        if($checkName != null)
        {
            return array("result" => -5, "reason" => "Student already exist.");
        }

        if(trim($POST['image']) != "")
        {
            $ext = $this->getStringBetween($POST['image'], "data:image/", ";base64,");
            $image = str_replace("data:image/".$ext.";base64,", "", $POST['image']);
            $POST['image'] = $this->base64ToImageFile($image, $ext, UPLOAD_DIR . "student/");

            if($info['image'] != "")
            {
                unlink(UPLOAD_DIR . "student/" . $info['image']);
            }
        }
        else
        {
            unset($POST['image']);
        }

        $barcode = $POST['idnumber'];

        unset($POST['idnumber']);
        unset($POST['departmentid']);

        $studentInfo = $POST;
        unset($studentInfo['courseid']);
        unset($studentInfo['year']);
        unset($studentInfo['section']);

        $this->db->update("student", $studentInfo, "studentid = $studentId");

        $studentAcademics = array(
            "courseid" => $POST['courseid'],
            "year" => $POST['year'],
            "section" => $POST['section']
        );

        $checkAcademic = $this->db->selectSingleData("SELECT * FROM student_academic_details WHERE studentid = $studentId");

        if($checkAcademic != null)
        {
            $this->db->update("student_academic_details", $studentAcademics, "studentid = $studentId AND schoolyear = '".$this->currentSchoolYear()."'");
        }
        else
        {
            $studentAcademics = array(
                "courseid" => $POST['courseid'],
                "year" => $POST['year'],
                "section" => $POST['section'],
                "studentid" => $studentId,
                "schoolyear" => $this->currentSchoolYear()
            );

            $this->db->insert("student_academic_details", $studentAcademics);
        }

        $checkBarcode = $this->db->selectSingleData("SELECT * FROM student_barcode WHERE studentid = $studentId");

        if($checkBarcode != null)
        {
            $this->db->update("student_barcode", array("barcode" => $barcode), "studentid = $studentId");
        }
        else
        {
            $this->db->insert("student_barcode", array("studentid" => $studentId, "barcode" => $barcode));
        }        

        return array("result" => 1, "reason" => "Student successfully updated.");
    }

    public function getEvents()
    {
        return $this->db->select("SELECT * FROM event WHERE semester = ".$this->currentSemester()." AND schoolyear = '".$this->currentSchoolYear()."' AND event.event_start_date <= '".date('Y-m-d')."' AND event.event_end_date <= '".date('Y-m-d')."'");
    }

    public function getAttendances($studentId)
    {
        return $this->db->select("SELECT * FROM attendance WHERE studentid = $studentId AND semester = ".$this->currentSemester()." AND schoolyear = '".$this->currentSchoolYear()."'");
    }

    public function getSanctions()
    {
        return $this->db->select("SELECT * FROM sanction");
    }

    public function processStudentImport()
    {
        if($_FILES['csv']['error'] == 0):
            $name = $_FILES['csv']['name'];
            $explodedName = explode('.', strtolower($name));
            $ext = end($explodedName);
            $tmpName = $_FILES['csv']['tmp_name'];
            if($ext === 'csv'):
                if(($handle = fopen($tmpName, 'r')) !== false):
                    $header = fgetcsv($handle);
                    $errorsCount = 0;
                    $totalCount = 0;
                    while(($data = fgetcsv($handle)) !== false):                                
                        
                        $error = 0;

                        if(trim($data[0]) == "")
                        {
                            $error++;
                        }

                        if(!is_numeric($data[0]))
                        {
                            $error++;
                        }

                        if(strlen($data[0]) != 8)
                        {
                           $error++;
                        }

                        if(trim($data[1]) == "")
                        {
                            $error++;
                        }

                        if(trim($data[3]) == "")
                        {
                            $error++;
                        }

                        if(trim($data[4]) == "")
                        {
                            $error++;
                        }

                        if(trim($data[5]) == "")
                        {
                            $error++;
                        }

                        if(trim($data[6]) == "")
                        {
                            $error++;
                        }

                        if(trim($data[7]) == "")
                        {
                            $error++;
                        }

                        if(!is_numeric($data[7]) || strlen($data[7]) != 10)
                        {
                            $error++;
                        }

                        $checkStudent = $this->db->selectSingleData("SELECT * FROM student_barcode WHERE barcode = '{$data[0]}'");

                        if($checkStudent != null)
                        {
                            $error++;
                        }

                        $hasMiddlename = "";

                        if(trim($data[2]) != "")
                        {
                            $hasMiddlename = " AND middlename = '{$data[2]}'";
                        } 

                        $checkName = $this->db->selectSingleData("SELECT * FROM student WHERE firstname = '{$data[1]}' AND lastname = '{$data[3]}'".$hasMiddlename);

                        if($checkName != null)
                        {
                            $error++;
                        }

                        $checkCourseValidity = $this->db->selectSingleData("SELECT * FROM course WHERE LOWER(course_name) = '".strtolower($data[4])."'");

                        $courseId = 0;

                        if($checkCourseValidity != null)
                        {
                            $courseId = $checkCourseValidity['courseid'];
                        }

                        if($error == 0)
                        {
                            $barcode = $data[0];

                            $postArr = array(
                                "firstname" => $data[1],
                                "middlename" => $data[2],
                                "lastname" => $data[3],
                                "mobile" => $data[7]
                            );

                            $this->db->insert("student", $postArr);

                            $studentID = $this->db->lastInsertId();

                            $detailsArr = array(
                                "courseid" => $courseId,
                                "year" => (int)$data[5],
                                "section" => $data[6],
                                "studentid" => $studentID,
                                "schoolyear" => $this->currentSchoolYear()
                            );

                            $this->db->insert("student_academic_details", $detailsArr);

                            $this->db->insert("student_barcode", array("studentid" => $studentID, "barcode" => $barcode));
                        }
                        else
                        {
                            $errorsCount++;
                        }

                        $totalCount++;

                        unset($data);
                    endwhile;
                    echo json_encode(array("result" => 1, "errors" => $errorsCount, "total" => $totalCount));
                    fclose($handle);
                endif;
            else:
                echo json_encode(array("result" => 0));
            endif;
        else:
            echo json_encode(array("result" => -1));
        endif;
    }

    public function updateYearLevel()
    {
        $students = $this->getStudents();

        foreach($students as $student)
        {
            $year = $student['year'];

            if($student['course_name'] == "BSCE")
            {
                if($year < 5)
                {
                    $dataArr = array(
                        "studentid" => $student['studentid'],                
                        "courseid" => $student['courseid'],                
                        "section" => $student['section'],                
                        "year" =>  ($year + 1),
                        "schoolyear" => $this->currentSchoolYear()               
                    );

                    $this->db->insert("student_academic_details", $dataArr);
                }
            }
            else
            {
                if($year < 4)
                {
                    $dataArr = array(
                        "studentid" => $student['studentid'],                
                        "courseid" => $student['courseid'],                
                        "section" => $student['section'],                
                        "year" =>  ($year + 1),
                        "schoolyear" => $this->currentSchoolYear()               
                    );

                    $this->db->insert("student_academic_details", $dataArr);
                }
            }
        }

        $this->db->insert("student_yearlevel_update", array("schoolyear" => $this->currentSchoolYear()));
    }
}