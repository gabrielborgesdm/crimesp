<?php include 'header.php';
session_start();
if(isset($_GET["op"]) and isset($_GET["id"])){
    $operacao = $_GET["op"];
    $id = $_GET["id"];
    include_once 'classes/Delito.php';
    $delito = new Delito();
    $_SESSION['idDelito'] = $id;
    
    if($operacao == 2){
        $condition = Array("col" => 'id', "value" => $id);
        $delito->apagarDelito($condition);
        if($delito->getConexao()->getErro()){
            header('Location: formErro.php');
            die();
        }else{
            header('Location: formSucesso.php');
            die();
        }
    }else if($operacao == 1){
        $_SESSION['updateDelito'] = 1;
        $where = array();
        $where[0]['col'] = 'id';
        $where[0]['value'] = $id;
       
        $query = $delito->listarDelito(null, $where);
        
        if($delito->getConexao()->getErro()){
            include 'formErro.php';
            die();
        }else{
            $linha = $query->fetch(PDO::FETCH_ASSOC);
        }    
    }
}
$html = '';
$html.=
'<section class="container-fluid mt-4 mb-5">
    <div class="row">
        <div class="col-11 col-md-10 col-lg-8 mx-auto bg-light border border-2 border-dark rounded divForm text-secondary">
            <h1 class="text-center mt-4">Cadastro de Tipos de Delitos</h1>
            <div class="col-12">
                <form method="post" action="processaDelitos.php">
                    <div class="form-group py-3">
                        <label for="nomeDelito">Nome do delito</label>
                        <input type="text" class="form-control" name="nomeDelito" id="nomeDelito" required';
                        if(isset($linha['nome'])){
                            $html.=' value = "' . $linha['nome'] . '" ';
                        } 
$html.='                />
                    </div> 
                    <div class="form-group py-3">
                        <label for="descricaoDelito">Descrição do delito</label>
                        <textarea name="descricaoDelito" id="descricaoDelito" required="required" class="form-control" rows="3" style="resize: none;">';
                        if(isset($linha['descricao'])){
                            $html.= $linha['descricao'];
                        }
$html.=                '</textarea>
                    </div> 
                    <div class="form-group row py-3">
                        <input type="submit" name="submit" id="submit" class="btn btn-lg col-8 col-md-6 mx-auto btn-outline-secondary">
                    </div>    
                </form>
            </div>
        </div>
    </div>
</section>';
echo $html;
include 'footer.php';
?>

