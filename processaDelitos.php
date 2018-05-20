<?php
require_once'classes/Delito.php';

$retorno = Array();
//Recuperar Posts e armazena-los em um Array
$resultado = Array();
$loc = "Location: formDelitos.php";
(empty($_POST["nomeDelito"])) ? header($loc) : $resultado["nome"] = $_POST["nomeDelito"];
(empty($_POST["descricaoDelito"])) ? header($loc) : $resultado["descricao"] = $_POST["descricaoDelito"];

$delitos = new Delito();
$delitos->recebeDados($resultado);
$delitos->cadastrarDelitos();
