<?php
require_once'classes/Delito.php';

$retorno = Array();
//Recuperar Posts e armazena-los em um Array
$resultado = Array();
$loc = "Location: formDelitos.php";
(empty($_POST["nomeDelito"])) ? header($loc) : $resultado["nome"] = $_POST["nomeDelito"];
(empty($_POST["descricaoDelito"])) ? header($loc) : $resultado["descricao"] = $_POST["descricaoDelito"];

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
    else if ($resultado["sentenca"] != 1 and $resultado["sentenca"] != 3) {
        $retorno["acao"] = 0;
        $retorno["mensagem"] = 4;
        die("alo");
    }
}
else{
    
    $retorno["acao"] = 0;
    $retorno["mensagem"] = 4;
    die("alo");
}

$delitos = new Delito($resultado);
$delitos->cadastrarDelitos();
