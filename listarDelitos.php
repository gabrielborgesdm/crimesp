<?php 
include 'header.php';
require_once 'classes/Delito.php';

$vitm = new Delito();
$query = $vitm->listarDelito();

if($vitm->getConexao()->getErro()){
    header("Location:index.php");
}else{
    $countVitm = $query->rowCount();
}

if($countVitm > 0){
    echo'
        <section class="container-fluid mt-4 mb-5">
            <div class="row">
                <div class="col-11 col-md-10 col-lg-8 mx-auto bg-light border border-2 border-dark rounded divForm text-secondary">
                    <h1 class="text-center mt-4 ">Listagem de delitos</h1>
                    <div class="col-12 my-4 mx-auto table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                </tr>
                            </thead>
                            <tbody>';
    $html = "";
  
    while($linha = $query->fetch(PDO::FETCH_ASSOC)){
        $html.='<tr>';
        $html.='<td>' . $linha['nome'] . '</td>';
        $html.='<td>' . $linha['descricao'] . '</td>';
        $html.='</tr>';
    }
    echo $html;
    echo'                   </tbody>
                        </table>
                    </div>
                    <div class="col-12 mx-auto text-center my-4">
                        <p class="text-secondary">Deseja cadastrar mais vítimas?</p>
                        <a class="btn btn-lg btn-outline-secondary" href="formVitimas.php">Cadastrar</a>
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
                    <h1 class="text-center mt-4 ">Listagem de vítimas</h1>
                    <div class="col-12 mx-auto text-center my-2">
                        <p class="text-danger">Não há vítimas cadastradas</p>
                        <a class="btn btn-lg btn-outline-secondary" href="index.php">Voltar ao início</a>
                    </div>
                </div>
            </div>
        </section>';
}
?>

<?php include 'footer.php'?>

