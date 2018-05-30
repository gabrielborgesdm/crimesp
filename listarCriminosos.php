<?php 
include 'header.php';
require_once 'classes/Criminoso.php';

$crim = new Criminoso();

if(empty($_POST)){    
    $query = $crim->listarCriminoso();
}else{
    (!empty($_POST["search"]))?$search = $_POST["search"]:$search = null;
    (!empty($_POST["ordernarPor"]))?$ordenarPor = $_POST["ordernarPor"]:$ordenarPor = null;
    (!empty($_POST["ordenacao"]))?$ordenacao = $_POST["ordenacao"]:$ordenacao = null;
    $query = $crim->filtrarCriminoso('*', $search, $ordenarPor, $ordenacao);
}

if($crim->getConexao()->getError()){
    header("Location: formErro.php");
    die();
}else{
    $countCrim = $query->rowCount();
}

if($countCrim > 0){
    echo'
        <section class="container-fluid mt-4 mb-5">
            <div class="row">
                <div class="col-11 col-md-10 col-lg-8 mx-auto bg-light border border-2 border-dark rounded divForm text-secondary">
                    <h1 class="text-center mt-4 ">Listagem de criminosos</h1>
                    <section class="row">
                        <form class="col-12 mt-5" method="post" action="#">
                            <select class="form-control text-secondary" name="ordernarPor">
                                <option value="0">Ordenar por</option>
                                <option value="1">Nome</option>
                                <option value="2">Data de Nascimento</option>
                                <option value="3">Endereço</option>
                                <option value="4">Sexo</option>
                                <option value="5">CPF</option>
                                <option value="6">Sentenca</option>
                                <option value="7">Data para Execução</option>
                            </select>

                            <div class="form-check form-check-inline">
                                <input type="radio" name="ordenacao" id="cresc" value="1" class="form-check-input" checked="checked"/>
                                <label class="form-check-label" for="cresc">Crescente(A-Z)</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" name="ordenacao" id="decresc" value="2" class="form-check-input">
                                <label class="form-check-label" for="decresc">Decrescente(Z-A)</label>
                            </div> 
                            
                            <input class="form-control my-2 col-12" type="search" name="search" placeholder="Procurar por" aria-label="Search"/>
                            <button class="btn btn-outline-success col-2" type="submit">Pesquisar</button>
                        </form>
                    </section>  
                    <div class="col-12 my-4 mx-auto table-responsive">    
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Data de Nascimento</th>
                                        <th>Endereço</th>
                                        <th>Sexo</th>
                                        <th>CPF</th>
                                        <th>Sentenca</th>
                                        <th>Tempo Preso</th>
                                        <th>Data para Execução</th>
                                        <th colspan="2">Operações</th>
                                    </tr>
                                </thead>
                                <tbody>';
    $html = "";
    
    while($linha = $query->fetch(PDO::FETCH_ASSOC)){
        (isset($linha['endereco'])) ?: $linha['endereco'] = "Nulo";
        (isset($linha['cpf'])) ?: $linha['cpf'] = "Nulo";
        (isset($linha['data_exec'])) ?: $linha['data_exec'] = "Nulo";
        
        if(isset($linha['tempo_cadeia'])){
            $cadeia = json_decode($linha['tempo_cadeia']);
            $anos = 0;
            if(isset($cadeia->anos)){
                $anos += $cadeia->anos;
            }
            if(isset($cadeia->meses)){
                $anos += $cadeia->meses / 12;
            }
            if(isset($cadeia->dias)){
                $anos += ($cadeia->dias / 31) / 12;
            }
            $linha['tempo_cadeia'] = round($anos, 2) . " ano";
            if($linha['tempo_cadeia'] > 1 ){
                $linha['tempo_cadeia'].='s';
            }
        }else{
            $linha['tempo_cadeia'] = "Nulo";
        }
        
        $html.='<tr>';
        $html.='<td>' . $linha['nome'] . '</td>';
        $html.='<td>' . $linha['data_nasc'] . '</td>';
        $html.='<td>' . $linha['endereco'] . '</td>';
        $html.='<td>' . $linha['sexo'] . '</td>';
        $html.='<td>' . $linha['cpf'] . '</td>';
        $html.='<td>' . $linha['sentenca'] . '</td>';
        $html.='<td>' . $linha['tempo_cadeia'] . '</td>';
        $html.='<td>' . $linha['data_exec'] . '</td>';
        $html.='<td><a href="formCriminosos.php?op=1&id='.$linha['id'].'">Alterar</a> <a href="formCriminosos.php?op=2&id='.$linha['id'].'">Remover</a></td>';
        $html.='</tr>';
        
       
    }
    echo $html;
    echo'                   </tbody>
                        </table>
                        <p class="small">Os meses foram considerados como contendo 31 dias</p>
                    </div>
                    <div class="col-12 mx-auto text-center my-4">
                        <p class="text-secondary">Deseja cadastrar mais criminosos?</p>
                        <a class="btn btn-lg btn-outline-secondary" href="formCriminosos.php">Cadastrar</a>
                    </div> 
                </div>
            </div>
        </section>
        
    ';
}else{
    echo'
        <section class="container-fluid mt-4 mb-5">
            <div class="row">
                <div class="col-11 col-md-10 col-lg-8 mx-auto bg-light border border-2 border-dark rounded divForm text-secondary">
                    <h1 class="text-center mt-4 ">Listagem de criminosos</h1>
                    <div class="col-12 mx-auto text-center my-2">
                        <p class="text-danger">Não há criminosos cadastrados</p>
                        <a class="btn btn-lg btn-outline-secondary" href="formCriminosos.php">Cadastrar</a>
                    </div>
                </div>
            </div>
        </section>';
}
?>

<?php include 'footer.php'?>

