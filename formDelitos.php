<?php include 'header.php'?>
<section class="container-fluid mt-4 mb-5">
    <div class="row">
        <div class="col-11 col-md-8 mx-auto bg-light border border-2 border-dark rounded divForm text-secondary">
            <h1 class="text-center mt-4">Cadastro de Tipos de Delitos</h1>
            <div class="col-12">
                <form method="post" action="processaDelitos.php">
                    <div class="form-group py-3">
                        <label for="nomeDelito">Nome do delito</label>
                        <input type="text" class="form-control" name="nomeDelito" id="nomeDelito" required />
                    </div> 
                    <div class="form-group py-3">
                        <label for="descricaoDelito">Descrição do delito</label>
                        <textarea name="descricaoDelito" id="descricaoDelito" required="required" class="form-control" rows="3" style="resize: none;"></textarea>
                    </div> 
                    <div class="form-group py-3">
                        <label for="sentencaDelito">Sentença</label>
                        <select name="sentencaDelito" id="sentencaDelito" class="custom-select">
                            <option value="0">Prisão</option>
                            <option value="1">Sentença de morte</option>
                        </select>
                    </div>
                    <div class="form-group py-3">
                        <label for="tempoPena">Tempo de execução da pena</label>
                        <input type="number" name="tempoPena" id="tempoPena" required="required" class="form-control"/>
                        <span class="small text-secondary">Tempo de prisão caso essa escolha seja feita, do contrário, tempo para execução.
                    </div>
                    <div class="form-group row py-3">
                        <input type="submit" name="submit" id="submit" class="btn btn-lg col-8 col-md-6 mx-auto btn-outline-secondary">
                    </div>    
                </form>
            </div>
        </div>
    </div>
</section>
<?php include 'footer.php'?>

