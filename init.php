<?php
require_once 'classes/ConexaoPDO.php';
$host = "localhost";
$dbname = "crimesp";
$user = "root";
$password = "";
$conn = new ConexaoPDO($host, "$dbname;charset=utf8", $user, $password);