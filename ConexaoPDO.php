<?php

function conexaoPDO($host, $dbname, $user, $password) {
    try{
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }catch(PDOException $e){
        $erro = 1;
    }

    if($erro){
        return 0;
    }else{
        return $conn;
    }
}
function prepararSql($conn, $sql) {
    $query = $conn->prepare($sql);
    return $query;
}
function bindarSql($query, $parametros){
    foreach ($parametros as $p=>$b){
        $query->bindParam("$p", $b);
    }
    return $query;
}
function executar($query){  
    $linha = $query->execute();
    if ($linha){
        $linha = $query->fetchAll(PDO::FETCH_ASSOC);
        return $linha;
    }
    else{
        return 0;
    }
}

