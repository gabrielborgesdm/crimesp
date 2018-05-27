<?php
require_once'classes/Vitima.php';
session_start();
$resultado = Array();
$loc = "Location: formVitimas.php";
(empty($_POST["nome"])) ? header($loc) : $resultado["nome"] = $_POST["nome"];
(empty($_POST["dataNasc"])) ? header($loc) : $resultado["dataNasc"] = $_POST["dataNasc"];
(empty($_POST["endereco"])) ?: $resultado["endereco"] = $_POST["endereco"];
(empty($_POST["cpf"])) ?: $resultado["cpf"] = $_POST["cpf"];
(empty($_POST["sexo"])) ?: $resultado["sexo"] = $_POST["sexo"];


$vitima = new Vitima();
$vitima->setFields($resultado);
if(isset($_SESSION["updateVitima"])){
    $vitima->alterarVitima(Array("id"=>$_SESSION['idVitima']));
    session_destroy();
}else{
    $vitima->cadastrarVitima();
}

if($vitima->getConexao()->getErro()){
        header("Location: formErro.php");
    }else{
       header("Location: formSucesso.php"); 
    }