<?php
require_once 'ConexaoPDO.php';
$host = "localhost";
$dbname = "crimesp";
$user = "root";
$password = "";
$conn = ConexaoPDO($host, "$dbname;charset=utf8", $user, $password);