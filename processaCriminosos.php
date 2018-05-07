<?php
require_once 'init.php';
$retorno = Array();
//Recuperar Posts e armazena-los em um Array
$resultado = Array();
$loc = "Location: formCriminosos.php";
(empty($_POST["nome"])) ? die("0") : $resultado["nome"] = $_POST["nome"];
(empty($_POST["dataNasc"])) ? header($loc) : $resultado["dataNasc"] = $_POST["dataNasc"];
(empty($_POST["endereco"])) ? header($loc) : $resultado["endereco"] = $_POST["endereco"];
(empty($_POST["cpf"])) ? header($loc) : $resultado["cpf"] = $_POST["cpf"];
if (!empty($_POST["sentenca"])) {
    $resultado["sentenca"] = $_POST["sentenca"];
    if ($resultado["sentenca"] == "2") {
        if (empty($_POST["anosPrisao"]) or empty($_POST["mesesPrisao"]) or empty($_POST["diasPrisao"])) {
            $retorno["acao"] = 0;
            $retorno["mensagem"] = 2;
            die();
        }
        else {
            $resultado["anosPrisao"] = $_POST["anosPrisao"];
            $resultado["mesesPrisao"] = $_POST["mesesPrisao"];
            $resultado["diasPrisao"] = $_POST["diasPrisao"];
        }
    }
    else if ($resultado["sentenca"] == "3") {
        if (!empty($_POST["dataExec"])) {
            $resultado["dataExec"] = $_POST["dataExec"];
        }
        else {
            $retorno["acao"] = 0;
            $retorno["mensagem"] = 3;
            die();
        }
    }
    else if ($resultado["sentenca"] != "1") {
        $retorno["acao"] = 0;
        $retorno["mensagem"] = 4;
        die();
    }
}

require_once'classes/Criminoso.php';
require_once 'classes/ConexaoPDO.php';
$criminoso = new Criminoso($resultado);
$criminoso->cadastrarCriminoso($conn);

/*
$retorno["acao"] = 1;
$retorno["mensagem"] = 1;
return $retorno;
*/