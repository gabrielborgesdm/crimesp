<?php 
include 'header.php';
require_once 'classes/Crime.php';

$crim = new Crime();

if(empty($_POST)){    
    $query = $crim->listarCrime();
}else{
    (!empty($_POST["search"]))?$search = $_POST["search"]:$search = null;
    (!empty($_POST["ordernarPor"]))?$ordenarPor = $_POST["ordernarPor"]:$ordenarPor = null;
    (!empty($_POST["ordenacao"]))?$ordenacao = $_POST["ordenacao"]:$ordenacao = null;
    $query = $crim->filtrarCrime('*', $search, $ordenarPor, $ordenacao);
}
if($crim->getConexao()->getError()){
    header("Location:formErro.php");
}else{
    $countCrim = $query->rowCount();
}

if($countCrim > 0){
    echo'
        <section class="container-fluid mt-4 mb-5">
            <div class="row">
                <div class="col-11 col-md-10 col-lg-8 col-lg-8 mx-auto bg-light border border-2 border-dark rounded divForm text-secondary">
                    <h1 class="text-center mt-4 ">Listagem de crimes ocorridos</h1>
                    <section class="row">
                        <form class="col-12 mt-5" method="post" action="#">
                            <select class="form-control text-secondary" name="ordernarPor">
                                <option value="0">Ordenar por</option>
                                <option value="1">Descrição</option>
                                <option value="2">Local de ocorrência</option>
                                <option value="3">Data de ocorrência</option>
                                <option value="4">Criminoso</option>
                                <option value="5">Vítima</option>
                                <option value="6">Delito</option>
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

