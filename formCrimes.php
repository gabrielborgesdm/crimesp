<?php 
include 'header.php';
include 'classes/ConexaoPDO.php';
$crim = new ConexaoPDO();
$vitm = new ConexaoPDO();

$crim->setSelectBuilder("criminoso", "*", 0);
$vitm->setSelectBuilder("vitima", "*", 0);

$crim->execSelect();
$vitm->execSelect();

if($crim->getErro() or $vitm->getErro()){
    header("Location:index.php");
}else{
   
    $resultCrim = $crim->getQuery()->fetchAll(PDO::FETCH_ASSOC);
    $resultVitm = $vitm->getQuery()->fetchAll(PDO::FETCH_ASSOC);
    $countCrim = count($resultCrim);
    $countVitm = count($resultVitm);

}

if($countCrim > 0 and $countVitm > 0){
    echo'
        <section class="container-fluid mt-4 mb-5">
            <div class="row">
                <div class="col-11 col-md-8 mx-auto bg-light border border-2 border-dark rounded divForm text-secondary">
                    <h1 class="text-center mt-4 ">Cadastro de crimes</h1>
                    <div class="col-12 mx-auto">
                        <form method="post" id="formCrimes" action="processaCrimes.php">
                            <div class="form-group py-3">
                                <label for="descricao">Descrição do crime*</label>
                                <textarea name="descricao" id="descricao" required="required" class="form-control" rows="3" style="resize: none;"></textarea>
                            </div>
                            <div class="form-group py-3">
                                <label for="local">Local de ocorrência</label>
                                <input type="text" class="form-control" name="local" id="local" required />
                            </div>
                            <div class="form-group py-3">
                                <label for="dataCrime">Data de ocorrência</label>
                                <input type="date" class="form-control" name="dataCrime" id="dataCrime" required />
                            </div>
                            <div class="form-group py-3">
                                <label>Criminoso</label>
                                <select class="form-control" name="criminoso">';
											
  
								for($i = 0; $i < $countCrim ; $i++){
									$linha = $resultCrim[$i];
									$id = $linha["id"];
									$nome = $linha["nome"];
									echo '<option value="'.$id.'">'.$nome.'</option>';   
								}
 
    echo'                   	</select>   
                            </div>
							
							<div class="form-group py-3">
                                <label>Vítima</label>
                                <select class="form-control" name="vitima">';
											
  
								for($i = 0; $i < $countVitm ; $i++){
									$linha = $resultVitm[$i];
									$id = $linha["id"];
									$nome = $linha["nome"];
									echo '<option value="'.$id.'">'.$nome.'</option>';   
								}
 
    echo'                   	</select> 
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
    echo'
        <section class="container-fluid mt-4 mb-5">
            <div class="row">
                <div class="col-11 col-md-8 mx-auto bg-light border border-2 border-dark rounded divForm text-secondary">
                    <h1 class="text-center mt-4 ">Cadastro de crimes</h1>
                    <div class="col-12 mx-auto text-center my-2">
                        <p class="text-danger">Cadastre vítimas e/ou criminosos antes de continuar...</p>
                        <a class="btn btn-lg btn-outline-secondary" href="index.php">Voltar</a>
                    </div>
                </div>
            </div>
        </section>
    ';
}
?>

<?php include 'footer.php'?>

