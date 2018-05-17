<?php 
include 'header.php';
require_once 'classes/Criminoso.php';

$crim = new Criminoso();
$query = $crim->listarCriminoso();
print_r($query);
die();
if($crim->getConexao()->getErro()){
    header("Location:index.php");
}else{
    $countCrim = $query->rowCount();
}

if($countCrim > 0){
    echo'
        <section class="container-fluid mt-4 mb-5">
            <div class="row">
                <div class="col-11 col-md-8 mx-auto bg-light border border-2 border-dark rounded divForm text-secondary">
                    <h1 class="text-center mt-4 ">Listagem de criminosos</h1>
                    <div class="col-12 my-4 mx-auto table-responsive">
                        <table class="table table-bordered table-hover">
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
                                </tr>
                            </thead>
                            <tbody>';
    $html = "";
    
    while($linha = $query->fetch(PDO::FETCH_ASSOC)){
        (isset($linha['endereco'])) ?: $linha['endereco'] = "Nulo";
        (isset($linha['cpf'])) ?: $linha['cpf'] = "Nulo";
        (isset($linha['dataExec'])) ?: $linha['dataExec'] = "Nulo";
        
        if($linha['sentenca'] == '1'){
            $linha['sentenca'] = "Indefinido";
        }else if($linha['sentenca'] == '2'){
            $linha['sentenca'] = "Prisão";
        } else{
            $linha['sentenca'] = "Sentença de morte";
        }
        
        if(isset($linha['tempoCadeia'])){
            $cadeia = json_decode($linha['tempoCadeia']);
            

            $linha['tempoCadeia'] = $cadeia->anos . ' anos, ' .
                                    $cadeia->meses . ' meses e ' .
                                    $cadeia->dias . ' dias' ;
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
        $html.='</tr>';
    }
    echo $html;
    echo'                   </tbody>
                        </table>
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
                <div class="col-11 col-md-8 mx-auto bg-light border border-2 border-dark rounded divForm text-secondary">
                    <h1 class="text-center mt-4 ">Listagem de criminosos</h1>
                    <div class="col-12 mx-auto text-center my-2">
                        <p class="text-danger">Não há criminosos cadastrados</p>
                        <a class="btn btn-lg btn-outline-secondary" href="index.php">Voltar ao início</a>
                    </div>
                </div>
            </div>
        </section>';
}
?>

<?php include 'footer.php'?>

