<?php
use App\Config\DB;
include $_SERVER['DOCUMENT_ROOT'].'/app/config/ConfigHelper.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/config/db.php';
$DB = new DB();
global $DB;

