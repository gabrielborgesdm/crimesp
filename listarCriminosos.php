<?php 
include 'header.php';
require_once 'classes/Criminoso.php';

$crim = new Criminoso();
$query = $crim->listarCriminoso();

if($crim->getConexao()->getErro()){
    header("Location: index.php");
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
        (isset($linha['dataExec'])) ?: $linha['dataExec'] = "Nulo";
        
        if(isset($linha['tempoCadeia'])){
            $cadeia = json_decode($linha['tempoCadeia']);
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
            $linha['tempoCadeia'] = round($anos, 2) . " ano";
            if($linha['tempoCadeia'] > 1 ){
                $linha['tempoCadeia'].='s';
            }
        }else{
            $linha['tempoCadeia'] = "Nulo";
        }
        
        $html.='<tr>';
        $html.='<td>' . $linha['nome'] . '</td>';
        $html.='<td>' . $linha['dataNasc'] . '</td>';
        $html.='<td>' . $linha['endereco'] . '</td>';
        $html.='<td>' . $linha['sexo'] . '</td>';
        $html.='<td>' . $linha['cpf'] . '</td>';
        $html.='<td>' . $linha['sentenca'] . '</td>';
        $html.='<td>' . $linha['tempoCadeia'] . '</td>';
        $html.='<td>' . $linha['dataExec'] . '</td>';
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

