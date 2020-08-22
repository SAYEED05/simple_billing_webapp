


<?php
//WEBHOST
 $dbhost = 'remotemysql.com:3306';
$dbname = 'CaYoVorcor';
$dbusername = 'CaYoVorcor';
$dbpass = 'JDvCfww7Qd';

$mysqli = mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);
ob_start(); 
/* ================================================================= */
error_reporting(E_ERROR | E_WARNING | E_PARSE);

//LOCALHOST
/*
$dbhost = 'localhost';
$dbname = 'billing';
$dbusername = 'root';
$dbpass = '';

$mysqli = mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);
ob_start();
*/