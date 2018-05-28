<?php 
include 'header.php';
require_once 'classes/Crime.php';

$crim = new Crime();
$query = $crim->listarCrime();

if($crim->getConexao()->getError()){
    header("Location:index.php");
}else{
    $countCrim = $query->rowCount();
}

if($countCrim > 0){
    echo'
        <section class="container-fluid mt-4 mb-5">
            <div class="row">
                <div class="col-11 col-md-10 col-lg-8 col-lg-8 mx-auto bg-light border border-2 border-dark rounded divForm text-secondary">
                    <h1 class="text-center mt-4 ">Listagem de crimes ocorridos</h1>
                    <div class="col-12 my-4 mx-auto table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Descrição</th>
                                    <th>Local de ocorrência</th>
                                    <th>Data de ocorrência</th>
                                    <th>Criminoso</th>
                                    <th>Vítima</th>
                                    <th>Delito</th>
                                    <th>Operações</th>
                                </tr>
                            </thead>
                            <tbody>';
    $html = "";
    
    while($linha = $query->fetch(PDO::FETCH_ASSOC)){
        $html.='<tr>';
        $html.='<td>' . $linha['descricao'] . '</td>';
        $html.='<td>' . $linha['local'] . '</td>';
        $html.='<td>' . $linha['data_crime'] . '</td>';
        $html.='<td>' . $linha['nome_criminoso'] . '</td>';
        $html.='<td>' . $linha['nome_vitima'] . '</td>';
        $html.='<td>' . $linha['nome_delito'] . '</td>';
        $html.='<td><a href="formCrimes.php?op=1&id='.$linha['id'].'">Alterar</a> <a href="formCrimes.php?op=2&id='.$linha['id'].'">Remover</a></td>';
        $html.='</tr>';
    }
    echo $html;
    echo'                   </tbody>
                        </table>
                    </div>
                    <div class="col-12 mx-auto text-center my-4">
                        <p class="text-secondary">Deseja cadastrar mais crimes?</p>
                        <a class="btn btn-lg btn-outline-secondary" href="formCrimes.php">Cadastrar</a>
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
                    <h1 class="text-center mt-4 ">Listagem de crimes ocorridos</h1>
                    <div class="col-12 mx-auto text-center my-2">
                        <p class="text-danger">Não há crimes registrados</p>
                        <a class="btn btn-lg btn-outline-secondary" href="formCrimes.php">Cadastrar</a>
                    </div>
                </div>
            </div>
        </section>';
}
?>

<?php include 'footer.php'?>

