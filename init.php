<?php
require_once 'classes/ConexaoPDO.php';
$host = "localhost";
$dbname = "crimesp";
$user = "root";
$password = "root";
$conexao = new ConexaoPDO($host, "$dbname;charset=utf8", $user, $password);