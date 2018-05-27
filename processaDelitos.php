<?php
require_once'classes/Delito.php';
session_start();

$resultado = Array();
$loc = "Location: formDelitos.php";
(empty($_POST["nomeDelito"])) ? header($loc) : $resultado["nome"] = $_POST["nomeDelito"];
(empty($_POST["descricaoDelito"])) ? header($loc) : $resultado["descricao"] = $_POST["descricaoDelito"];

$delito = new Delito();
$delito->setFields($resultado);

if(isset($_SESSION["updateDelito"])){
    $delito->alterarDelito(Array("id"=>$_SESSION['idDelito']));
    session_destroy();    
}else{
    $delito->cadastrarDelitos();
}    
if($delito->getConexao()->getErro()){
    header("Location: formErro.php");
}else{
   header("Location: formSucesso.php"); 
}