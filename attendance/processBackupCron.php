<?php
function createZip($sourceData, $destination)
{
    $source_arr = $sourceData; // convert it to array

    if (!extension_loaded('zip')) {
        return false;
    }

    $zip = new ZipArchive();

    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    foreach ($source_arr as $source)
    {
        if (!file_exists($source)) continue;
		$source = str_replace('\\', '/', realpath($source));

		$flag = basename($source) . '/';

		if (is_dir($source) === true)
		{
		    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

		    foreach ($files as $file)
		    {
		        $file = str_replace('\\', '/', realpath($file));

		        if (is_dir($file) === true)
		        {
		            $zip->addEmptyDir(str_replace($source . '/', '', $flag.$file . '/'));
		        }
		        else if (is_file($file) === true)
		        {
		            $zip->addFromString(str_replace($source . '/', '', $flag.$file), file_get_contents($file));
		        }
		    }
		}
		else if (is_file($source) === true)
		{
		    $zip->addFromString(basename($source), file_get_contents($source));
		}
	}

    return $zip->close();
}

function deleteUnnecessaryFileFromZip($sourceData)
{
    $zip = new ZipArchive;

    if ($zip->open($sourceData) === TRUE)
    {
    	$folder_to_delete = "uploads/C:/";

    	for($i=0;$i<$zip->numFiles;$i++)
    	{
	        $entry_info = $zip->statIndex($i);

	        if(substr($entry_info["name"],0,strlen($folder_to_delete))==$folder_to_delete)
	        {
	            $zip->deleteIndex($i);
	        }
	    }

        $zip->close();
    }
}

function processBackup()
{
	$model = new Model();

	$filename = 'backup-'.time().'.sql';
	$file = BACKUP_DIR . $filename;

	if(file_exists(MYSQL_DUMP_EXE)):
		exec(MYSQL_DUMP_EXE . ' --user=root --password=  dbattendance attendance backup course department event event_officer sanction student student_academic_details student_barcode student_yearlevel_update user user_log > ' . $file);
	else:
		exec(MYSQL_DUMP_EXE_CUSTOM . ' --user=root --password=  dbattendance attendance backup course department event event_officer sanction student student_academic_details student_barcode student_yearlevel_update user user_log > '. $file);
	endif;	

	$files = array(
		'backups/'.$filename,
		'public/uploads/'
	);

	$zipFilename = 'backup-'.time().'.zip';
	createZip($files, "backups/".$zipFilename);
	deleteUnnecessaryFileFromZip("backups/".$zipFilename);
	unlink($file);

	if(file_exists(BACKUP_DIR.$zipFilename)):
		$model->db->insert("backup", array("filename" => $zipFilename, "schoolyear" => $model->currentSchoolYear(), "backup_date" => date("Y-m-d H:i:s")));
	endif;
}

$model = new Model();
$checkBackup = $model->db->selectSingleData("SELECT * FROM backup WHERE DATE(backup_date) = '".date('Y-m-d')."'");
if($checkBackup == null):
	processBackup();
endif;
?>