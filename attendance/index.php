<?php
date_default_timezone_set('Asia/Manila');

require 'config.php';
require 'util/Auth.php';
require 'util/Code128.php';
require 'util/PHPExport.php';

spl_autoload_register(function($class){
    require LIBS . $class .".php";
});

require 'processBackupCron.php';

$bootstrap = new Bootstrap();

$bootstrap->init();

