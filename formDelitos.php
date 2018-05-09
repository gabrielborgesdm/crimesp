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
                        <label for="sentenca">Sentença*</label>
                        <select name="sentenca" id="sentenca" class="custom-select">
                            <option value="1" selected>Incerta</option>
                            <option value="2">Prisão</option>
                            <option value="3">Sentença de morte</option>
                        </select>
                    </div>                   
                    <div class="form-group py-3" id="groupTempoCadeia">
                        <label for="tempoPrisao" class="d-block">Tempo de cadeia</label>
                        <div class="d-flex justify-content-between">
                            <input type="number" class="form-control d-inline-block col mt-2" placeholder="Anos" name="anosPrisao" id="anosPrisao"  />
                            <input type="number" class="form-control d-inline-block col mx-2 mt-2" placeholder="Meses" name="mesesPrisao" id="mesesPrisao"  />
                            <input type="number" class="form-control d-inline-block col mt-2" placeholder="Dias" name="diasPrisao" id="DiasPrisao"  />
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
<?php include 'footer.php'?>

