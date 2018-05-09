<?php
require_once'classes/Criminoso.php';

$retorno = Array();
//Recuperar Posts e armazena-los em um Array
$resultado = Array();
$loc = "Location: formCriminosos.php";
(empty($_POST["nome"])) ? header($loc) : $resultado["nome"] = $_POST["nome"];
(empty($_POST["dataNasc"])) ? header($loc) : $resultado["dataNasc"] = $_POST["dataNasc"];
(empty($_POST["endereco"])) ?: $resultado["endereco"] = $_POST["endereco"];
(empty($_POST["cpf"])) ?: $resultado["cpf"] = intval($_POST["cpf"]);
(empty($_POST["sexo"])) ?: $resultado["sexo"] = $_POST["sexo"];

if (!empty($_POST["sentenca"])) {
    $resultado["sentenca"] = $_POST["sentenca"];
    if ($resultado["sentenca"] == 2) {
        if (empty($_POST["anosPrisao"]) and empty($_POST["mesesPrisao"]) and empty($_POST["diasPrisao"])) {
            $retorno["acao"] = 0;
            $retorno["mensagem"] = 2;
            die();
        }
        else {
            (empty($_POST["anosPrisao"]))?: $resultado["tempoCadeia"]["anos"] = $_POST["anosPrisao"];
            (empty($_POST["mesesPrisao"]))?: $resultado["tempoCadeia"]["meses"] = $_POST["anosPrisao"];
            (empty($_POST["diasPrisao"]))?: $resultado["tempoCadeia"]["dias"] = $_POST["anosPrisao"];
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
else{   
    $retorno["acao"] = 0;
    $retorno["mensagem"] = 4;
    die("alo");
}
$criminoso = new Criminoso($resultado);
$criminoso->cadastrarCriminoso();