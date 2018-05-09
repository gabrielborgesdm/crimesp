<?php

require_once 'init.php';
require_once'classes/Criminoso.php';

$retorno = Array();
//Recuperar Posts e armazena-los em um Array
$resultado = Array();
$loc = "Location: formCriminosos.php";
(empty($_POST["nome"]))? header($loc) : $resultado["nome"] = $_POST["nome"];
(empty($_POST["dataNasc"])) ? header($loc) : $resultado["dataNasc"] = $_POST["dataNasc"];
(empty($_POST["endereco"]))? : $resultado["endereco"] = $_POST["endereco"];
(empty($_POST["cpf"])) ? : $resultado["cpf"] = intval($_POST["cpf"]);

if (!empty($_POST["sentenca"])) {
    $resultado["sentenca"] = $_POST["sentenca"];
    if ($resultado["sentenca"] == 2) {
        if (empty($_POST["anosPrisao"]) or empty($_POST["mesesPrisao"]) or empty($_POST["diasPrisao"])) {
            $retorno["acao"] = 0;
            $retorno["mensagem"] = 2;
            die();
        }
        else {
            $resultado["tempoCadeia"]["anos"] = $_POST["anosPrisao"];
            $resultado["tempoCadeia"]["meses"] = $_POST["mesesPrisao"];
            $resultado["tempoCadeia"]["dias"] = $_POST["diasPrisao"];
        }
    }
    else if ($resultado["sentenca"] == 3) {
        if (!empty($_POST["dataExec"])) {
            $resultado["dataExec"] = $_POST["dataExec"];
        }
        else {
            $retorno["acao"] = 0;
            $retorno["mensagem"] = 3;
            die();
        }
    }
    else if ($resultado["sentenca"] != 1) {
        $retorno["acao"] = 0;
        $retorno["mensagem"] = 4;
        die();
    }
}

$criminoso = new Criminoso($resultado);
$criminoso->cadastrarCriminoso($conexao);
