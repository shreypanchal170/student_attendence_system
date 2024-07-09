<?php
define('URL', 'http://localhost/attendance/');
define('LIBS', 'libs/');
define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/attendance/public/uploads/');
define('PUBLIC_DIR', $_SERVER['DOCUMENT_ROOT'].'/attendance/public/');
define('BACKUP_DIR', $_SERVER['DOCUMENT_ROOT'].'/attendance/backups/');
define('ESTABLISHMENT', 'Attendance Monitoring System');
define('DESCRIPTION', 'AMWBS');
define('PRINT_ORIENTATION', 'P');
define('PRINT_PAPER_SIZE', 'LEGAL');
define('MYSQL_EXE', realpath('../../mysql/bin/mysql.exe'));
define('MYSQL_DUMP_EXE', realpath('../../mysql/bin/mysqldump.exe'));
define('MYSQL_EXE_CUSTOM', 'C:\xampp\mysql\bin\mysql.exe');
define('MYSQL_DUMP_EXE_CUSTOM', 'C:\xampp\mysql\bin\mysqldump.exe');

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'dbattendance');
define('DB_USER', 'root');
define('DB_PASS', '');

define('HASH_GENERAL_KEY', '|ATTENDANCE|');
define('HASH_PASSWORD_KEY', 'JesusChristisOurLord');