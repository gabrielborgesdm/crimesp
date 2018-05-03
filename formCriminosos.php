<?php include 'header.php'?>
<section class="container-fluid mt-4 mb-5">
    <div class="row">
        <div class="col-11 col-md-8 mx-auto bg-light border border-2 border-dark rounded divForm text-secondary">
            <h1 class="text-center mt-4 ">Cadastro de criminosos</h1>
            <div class="col-12 mx-auto">
                <form method="post" action="processaCriminosos.php">
                    <div class="form-group py-3">
                        <label for="nomeCriminoso">Nome completo</label>
                        <input type="text" class="form-control" name="nomeCriminoso" id="nomeCriminoso" required />
                    </div> 
                    <div class="form-group py-3">
                        <label for="dataNasc">Data de nascimento</label>
                        <input type="date" class="form-control" name="dataNasc" id="dataNasc" required />
                    </div> 
                    <div class="form-group py-3">
                        <label for="sentenca">Sentença</label>
                        <select name="sentenca" id="sentenca" class="custom-select">
                            <option value="0" selected>Incerta</option>
                            <option value="1">Prisão</option>
                            <option value="2">Sentença de morte</option>
                        </select>
                    </div>
                    <div class="form-group py-3">
                        <label for="endereco">Endereço</label>
                        <input type="text" class="form-control" name="endereco" id="endereco" required />
                    </div>
                    <div class="form-group py-3">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" name="cpf" id="cpf" required />
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

