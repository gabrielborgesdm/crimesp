<?php
session_start();
require_once'classes/Crime.php';

$resultado = Array();
$loc = "Location: formCrimes.php";
(empty($_POST["descricao"])) ? header($loc) : $resultado["descricao"] = $_POST["descricao"];
(empty($_POST["local"])) ? header($loc): $resultado["local"] = $_POST["local"];
(empty($_POST["dataCrime"])) ? header($loc) : $resultado["dataCrime"] = $_POST["dataCrime"];
(empty($_POST["criminoso"])) ?: $resultado["criminoso"] = $_POST["criminoso"];
(empty($_POST["vitima"])) ? header($loc): $resultado["vitima"] = $_POST["vitima"];
(empty($_POST["delito"])) ? header($loc): $resultado["delito"] = $_POST["delito"];


$crime = new Crime();
$crime->setFields($resultado);

if(isset($_SESSION["updateCrime"])){
    $crime->alterarCrime(Array("id"=>$_SESSION['idCrime']));
    session_destroy();
}else{
    $crime->cadastrarCrime();
}   
if($crime->getConexao()->getError()){
        header("Location: formErro.php");
    }else{
        header("Location: formSucesso.php"); 
    }