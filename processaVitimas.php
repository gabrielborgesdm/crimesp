<?php
require_once'classes/Vitima.php';

$retorno = Array();
//Recuperar Posts e armazena-los em um Array
$resultado = Array();
$loc = "Location: formVitimas.php";
(empty($_POST["nome"])) ? header($loc) : $resultado["nome"] = $_POST["nome"];
(empty($_POST["dataNasc"])) ? header($loc) : $resultado["dataNasc"] = $_POST["dataNasc"];
(empty($_POST["endereco"])) ?: $resultado["endereco"] = $_POST["endereco"];
(empty($_POST["cpf"])) ?: $resultado["cpf"] = intval($_POST["cpf"]);
(empty($_POST["sexo"])) ?: $resultado["sexo"] = $_POST["sexo"];

$vitima = new Vitima();
$vitimas->recebeDados($resultado);
$vitima->cadastrarVitima();