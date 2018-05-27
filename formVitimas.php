<?php include 'header.php';
session_start();
if(isset($_GET["op"]) and isset($_GET["id"])){
    $operacao = $_GET["op"];
    $id = $_GET["id"];
    include_once 'classes/Vitima.php';
    $vitm = new Vitima();
    $_SESSION['idVitima'] = $id;
    
    if($operacao == 2){
        $condition = Array("col" => 'id', "value" => $id);
        $vitm->apagarVitima($condition);
        if($vitm->getConexao()->getErro()){
            header('Location: formErro.php');
            die();
        }else{
            header('Location: formSucesso.php');
            die();
        }
    }else if($operacao == 1){
        $_SESSION['updateVitima'] = 1;
        $where = array();
        $where[0]['col'] = 'id';
        $where[0]['value'] = $id;
       
        $query = $vitm->listarVitima(null, $where);
        
        if($vitm->getConexao()->getErro()){
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
            <h1 class="text-center mt-4 ">Cadastro de vítimas</h1>
            <div class="col-12 mx-auto">
                <form method="post" id="formVitimas" action="processaVitimas.php">
                    <div class="form-group py-3">
                        <label for="nome">Nome completo*</label>
                        <input type="text" class="form-control" name="nome" id="nome" required';
                        if(isset($linha['nome'])){
                            $html.=' value = "' . $linha['nome'] . '" ';
                        } 
$html.='                />
                    </div> 
                    <div class="form-group py-3">
                        <label for="dataNasc">Data de nascimento*</label>
                        <input type="date" class="form-control" name="dataNasc" id="dataNasc" required';
                        if(isset($linha['dataNasc'])){
                            $html.=' value = "' . $linha['dataNasc'] . '" ';
                        } 
$html.='                />
                    </div>
                   <div class="form-group py-3">
                        <label class="d-block">Sexo*</label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="M" name="sexo" id="masc" required="required"';
                            if(isset($linha['sexo'])){
                                if($linha['sexo'] == 'M'){
                                    $html.='checked = "checked"';
                                }
                            }
$html.='                />
                            <label for="masc" class="form-check-label">Masculino</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="F" name="sexo" id="fem"';
                            if(isset($linha['sexo'])){
                                if($linha['sexo'] == 'F'){
                                    $html.='checked = "checked"';
                                }
                            }
$html.='                />
                        <label for="fem" class="form-check-label">Feminino</label>
                        </div>    
                    </div>
                     <div class="form-group py-3">
                        <label for="endereco">Endereço</label>
                        <input type="text" class="form-control" name="endereco" id="endereco" ';
                        if(isset($linha['endereco'])){
                            $html.=' value = "' . $linha['endereco'] . '" ';
                        } 
$html.='                />
                    </div>
                    <div class="form-group py-3">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" name="cpf" maxlength="11" id="cpf" ';
                        if(isset($linha['cpf'])){
                            $html.=' value = "' . $linha['cpf'] . '" ';
                        } 
$html.='                />
                    </div>
                    <div class="form-group row py-3">
                        <input type="submit" name="submit" id="submit" class="btn btn-lg col-8 col-md-6 mx-auto btn-outline-secondary">
                    </div>    
                </form>
            </div>
        </div>
    </div>
</section>
';
echo $html;
include 'footer.php';
?>

