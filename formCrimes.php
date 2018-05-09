<?php include 'header.php'?>
<section class="container-fluid mt-4 mb-5">
    <div class="row">
        <div class="col-11 col-md-8 mx-auto bg-light border border-2 border-dark rounded divForm text-secondary">
            <h1 class="text-center mt-4 ">Cadastro de crimes</h1>
            <div class="col-12 mx-auto">
                <form method="post" id="formCrimes" action="processaCrimes.php">
                    <div class="form-group py-3">
                        <label for="nome">Nome completo*</label>
                        <input type="text" class="form-control" name="nome" id="nome" required />
                    </div> 
                    <div class="form-group py-3">
                        <label for="dataNasc">Data de nascimento*</label>
                        <input type="date" class="form-control" name="dataNasc" id="dataNasc" required />
                    </div>
                    <div class="form-group py-3">
                        <label class="d-block">Sexo*</label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="M" name="sexo" id="masc" required="required"/>
                            <label for="masc" class="form-check-label">Masculino</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="F" name="sexo" id="fem"/>
                            <label for="fem" class="form-check-label">Feminino</label>
                        </div>    
                    </div>
                     <div class="form-group py-3">
                        <label for="endereco">Endereço</label>
                        <input type="text" class="form-control" name="endereco" id="endereco" />
                    </div>
                    <div class="form-group py-3">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" name="cpf" maxlength="11" id="cpf" />
                    </div>
                    <div class="form-group py-3">
                        <label for="sentenca">Sentença*</label>
                        <select name="sentenca" id="sentenca" class="custom-select">
                            <option value="1" selected>Incerta</option>
                            <option value="2">Prisão</option>
                            <option value="3">Sentença de morte</option>
                        </select>
                    </div>
                    <div class="form-group py-3" id="groupDataExec">
                        <label for="dataExec">Data para execução</label>
                        <input type="date" class="form-control" name="dataExec" id="dataExec"  />
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

