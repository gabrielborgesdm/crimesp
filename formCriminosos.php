<?php
include 'header.php';
session_start();

if(isset($_GET["op"]) and isset($_GET["id"])){
    $operacao = $_GET["op"];
    $id = $_GET["id"];
    include_once 'classes/Criminoso.php';
    $crim = new Criminoso();
    $_SESSION['idCriminoso'] = $id;
    
    if($operacao == 2){
        $condition = Array("col" => 'id', "value" => $id);
        $crim->apagarCriminoso($condition);
        if($crim->getConexao()->getError()){
            header('Location: formErro.php');
            die();
        }else{
            header('Location: formSucesso.php');
            die();
        }
    }else if($operacao == 1){
        $_SESSION['updateCriminoso'] = 1;
        $where = array();
        $where[0]['col'] = 'id';
        $where[0]['value'] = $id;
       
        $query = $crim->listarCriminoso(null, $where);
        
        if($crim->getConexao()->getError() != null){
            include 'formErro.php';
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
            <h1 class="text-center mt-4 ">Cadastro de criminosos</h1>
            <div class="col-12 mx-auto">
                <form method="post" id="formCriminosos" action="processaCriminosos.php">
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
                        if(isset($linha['data_nasc'])){
                            $html.=' value = "' . $linha['data_nasc'] . '" ';
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
                        <input type="text" class="form-control" name="endereco" id="endereco"';
                        if(isset($linha['endereco'])){
                            $html.=' value = "' . $linha['endereco'] . '" ';
                        }
$html.='                />
                    </div>
                    <div class="form-group py-3">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" name="cpf" maxlength="11" id="cpf"';
                        if(isset($linha['cpf'])){
                            $html.=' value = "' . $linha['cpf'] . '" ';
                        }
$html.='                />
                    </div>
                    <div class="form-group py-3">
                        <label for="sentenca">Sentença*</label>
                        <select name="sentenca" id="sentenca" class="custom-select">
                            <option value="1"';
                            if(isset($linha['sentenca'])){
                                if($linha['sentenca'] == "Incerta"){
                                    $html.= "selected";
                                }
                            }
$html.='                            
                            >Incerta</option>
                            <option value="2"';
                            if(isset($linha['sentenca'])){
                                if($linha['sentenca'] == "Prisão"){
                                    $html.= "selected";
                                }
                            }
$html.='     
                            >Prisão</option>
                            <option value="3"';
                            if(isset($linha['sentenca'])){
                                if($linha['sentenca'] == "Execução"){
                                    $html.= "selected";
                                }
                            }
$html.='
                            >Sentença de morte</option>
                        </select>
                    </div>
                    <div class="form-group py-3" id="groupDataExec">';
                  
$html.='

                        <label for="dataExec">Data para execução</label>
                        <input type="date" class="form-control" name="dataExec" id="dataExec"';
                        if(isset($linha['data_exec'])){
                            $html.=' value = "' . $linha['data_exec'] . '" ';
                        }
$html.='                />
                    </div>
                    <div class="form-group py-3" id="groupTempoCadeia">';
               
$html.='
                        <label for="tempoPrisao" class="d-block">Tempo de cadeia</label>
                        <div class="d-flex justify-content-between">
                            <input type="number" class="form-control d-inline-block col mt-2" placeholder="Anos" name="anosPrisao" id="anosPrisao"';
                        if(isset($linha['tempo_cadeia'])){
                            $linha['tempo_cadeia'] = json_decode($linha['tempo_cadeia']);
                            if(isset($linha['tempo_cadeia']->anos)){
                                $html.=' value = "' . $linha['tempo_cadeia']->anos . '" ';
                            }    
                        }
$html.='                />
                            <input type="number" class="form-control d-inline-block col mx-2 mt-2" placeholder="Meses" name="mesesPrisao" id="mesesPrisao"';
                        if(isset($linha['tempo_cadeia'])){
                            if(isset($linha['tempo_cadeia']->meses)){
                                $html.=' value = "' . $linha['tempo_cadeia']->meses . '" ';
                            }    
                        }
$html.='                />
                            <input type="number" class="form-control d-inline-block col mt-2" placeholder="Dias" name="diasPrisao" id="DiasPrisao"';
                        if(isset($linha['tempo_cadeia'])){
                            if(isset($linha['tempo_cadeia']->dias)){
                                $html.=' value = "' . $linha['tempo_cadeia']->dias . '" ';
                            }
                        }
$html.='                />
                        </div>
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

