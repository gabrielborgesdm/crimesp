<?php
require_once'classes/Criminoso.php';
session_start();

$resultado = Array();
$loc = "Location: formCriminosos.php";
(empty($_POST["nome"])) ? header($loc) : $resultado["nome"] = $_POST["nome"];
(empty($_POST["dataNasc"])) ? header($loc) : $resultado["dataNasc"] = $_POST["dataNasc"];
(empty($_POST["endereco"])) ?: $resultado["endereco"] = $_POST["endereco"];
(empty($_POST["cpf"])) ?: $resultado["cpf"] = $_POST["cpf"];
(empty($_POST["sexo"])) ?: $resultado["sexo"] = $_POST["sexo"];

if (!empty($_POST["sentenca"])) {
    $resultado["sentenca"] = $_POST["sentenca"];
    if ($resultado["sentenca"] == 2) {
        if (empty($_POST["anosPrisao"]) and empty($_POST["mesesPrisao"]) and empty($_POST["diasPrisao"])) {
            header($loc);
            die();
        }
        else{
            (empty($_POST["anosPrisao"]))?: $resultado["tempoCadeia"]["anos"] = $_POST["anosPrisao"];
            (empty($_POST["mesesPrisao"]))?: $resultado["tempoCadeia"]["meses"] = $_POST["mesesPrisao"];
            (empty($_POST["diasPrisao"]))?: $resultado["tempoCadeia"]["dias"] = $_POST["diasPrisao"];
            
        }
    }
    else if ($resultado["sentenca"] == 3) {
        if (!empty($_POST["dataExec"])) {
            $resultado["dataExec"] = $_POST["dataExec"];
        }
        else {
            header($loc);
            die();
        }
    }
    else if ($resultado["sentenca"] != 1){
        header($loc);
        die();
    }
}
else{   
    header($loc);
    die();
}

$crim = new Criminoso();
$crim->setFields($resultado);

if(isset($_SESSION["updateCriminoso"])){
    $crim->alterarCriminoso(Array("id"=>$_SESSION['idCriminoso']));
    session_destroy();
}else{
    $crim->cadastrarCriminoso();
} 

if($crim->getConexao()->getError()){
    print_r($crim->getConexao()->getError());
    die();
    header("Location: formErro.php");
}else{
   header("Location: formSucesso.php"); 
}
   
