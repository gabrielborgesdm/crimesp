<?php 
session_start();
include 'header.php';
include 'classes/Criminoso.php';
include 'classes/Vitima.php';
include 'classes/Delito.php';
    
if(isset($_GET["op"]) and isset($_GET["id"])){
  
    $operacao = $_GET["op"];
    $id = $_GET["id"];
    
    include_once 'classes/Crime.php';
    $crim = new Crime();
    $_SESSION['idCrime'] = $id;
    
    if($operacao == 2){
        $condition = Array("col" => 'id', "value" => $id);
        $crim->apagarCrime($condition);
        if($crim->getConexao()->getErro()){
            header('Location: formSucesso.php');
            die();
        }else{
            header('Location: formSucesso.php');
            die();
        }
    }else if($operacao == 1){
        $_SESSION['updateCrime'] = 1;
        $where = array();
        $where[0]['col'] = 'id';
        $where[0]['value'] = $id;
       
        $query = $crim->listarCrime(null, $where);
        
        if($crim->getConexao()->getErro()){
            header('Location: formErro.php');
            die();
        }else{
            $linha = $query->fetch(PDO::FETCH_ASSOC);
        } 
        
    }
}

$crim = new Criminoso();
$vitm = new Vitima();
$deli = new Delito();
$campos = Array("id", "nome");
$queryCrim = $crim->listarCriminoso($campos);
$queryVitm = $vitm->listarVitima($campos);
$queryDeli = $deli->listarDelito($campos);

if($crim->getConexao()->getErro() or $vitm->getConexao()->getErro() or $deli->getConexao()->getErro()){
    header("Location:index.php");
    die();
}


$resultCrim = $queryCrim -> fetchAll(PDO::FETCH_ASSOC);
$resultVitm = $queryVitm -> fetchAll(PDO::FETCH_ASSOC);
$resultDeli = $queryDeli -> fetchAll(PDO::FETCH_ASSOC);

$countCrim = count($resultCrim);
$countVitm = count($resultVitm);
$countDeli = count($resultDeli);
$html = '';

if($countCrim > 0 and $countVitm > 0 and $countDeli > 0){
    $html.='
        <section class="container-fluid mt-4 mb-5">
            <div class="row">
                <div class="col-11 col-md-10 col-lg-8 mx-auto bg-light border border-2 border-dark rounded divForm text-secondary">
                    <h1 class="text-center mt-4 ">Cadastro de crimes</h1>
                    <div class="col-12 mx-auto">
                        <form method="post" id="formCrimes" action="processaCrimes.php">
                            <div class="form-group py-3">
                                <label for="descricao">Descrição do crime*</label>
                                <textarea name="descricao" id="descricao" required="required" class="form-control" rows="3" style="resize: none;">';
                                if(isset($linha['crimeDescricao'])){
                                    $html.= $linha['crimeDescricao'];
                                }
    $html.=                   '</textarea>
                            </div>
                            <div class="form-group py-3">
                                <label for="local">Local de ocorrência*</label>
                                <input type="text" class="form-control" name="local" id="local" required';
                                if(isset($linha['crimeLocal'])){
                                    $html.=' value = "' . $linha['crimeLocal'] . '"';
                                }
    $html.=                   '/>
                            </div>
                            <div class="form-group py-3">
                                <label for="dataCrime">Data de ocorrência*</label>
                                <input type="date" class="form-control" name="dataCrime" id="dataCrime" required';
                                if(isset($linha['crimeData'])){
                                    $html.=' value = "' . $linha['crimeData'] . '"';
                                }
    $html.=                   '/>
                            </div>
                            <div class="form-group py-3">
                                <label>Criminoso*</label>
                                <select class="form-control" name="criminoso">';
                                
                                for($i = 0; $i < $countCrim ; $i++){
                                    $linha = $resultCrim[$i];
                                    $id = $linha["id"];
                                    $nome = $linha["nome"];
                                    $html.= '<option value="'.$id.'">'.$nome.'</option>';   
                                }
                                    
    $html.='                    </select>   
                            </div>
							
							<div class="form-group py-3">
                                <label>Vítima*</label>
                                <select class="form-control" name="vitima">';
											
  
								for($i = 0; $i < $countVitm ; $i++){
									$linha = $resultVitm[$i];
									$id = $linha["id"];
									$nome = $linha["nome"];
									$html.= '<option value="'.$id.'">'.$nome.'</option>';   
								}
 
    $html.='                    </select> 
							</div>

                            <div class="form-group py-3">
                                <label>Delito praticado*</label>
                                <select class="form-control" name="delito">';
                                            
  
                                for($i = 0; $i < $countDeli ; $i++){
                                    $linha = $resultDeli[$i];
                                    $id = $linha["id"];
                                    $nome = $linha["nome"];
                                    $html.= '<option value="'.$id.'">'.$nome.'</option>';   
                                }
 
$html.='                        </select> 
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
}else{
    $html.='
        <section class="container-fluid mt-4 mb-5">
            <div class="row">
                <div class="col-11 col-md-10 col-lg-8 mx-auto bg-light border border-2 border-dark rounded divForm text-secondary">
                    <h1 class="text-center mt-4 ">Cadastro de crimes</h1>
                    <div class="col-12 mx-auto text-center my-2">
                        <p class="text-danger">É necessário ter dados sobre criminosos,vítimas e delitos antes de continuar.</p>
                        <a class="btn btn-lg btn-outline-secondary" href="index.php">Início</a>
                    </div>
                </div>
            </div>
        </section>
    ';
}
echo $html;

include 'footer.php';
?>

