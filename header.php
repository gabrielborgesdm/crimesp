<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title>CrimeSP</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="css/mainStyle.css" />
    </head>
    <body class="bg-secondary">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
            <a class="navbar-brand" href="#">CRIMESP</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarList" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarList">
                <ul class="navbar-nav ml-auto px-2">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="index.php">Início</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="dropCriminosos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Criminosos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropCriminosos">
                            <a class="dropdown-item" href="formCriminosos.php">Cadastro</a>
                            <a class="dropdown-item" href="listarCriminosos.php">Visualização</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="dropVitimas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Vitimas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropVitimas">
                            <a class="dropdown-item" href="formVitimas.php">Cadastro</a>
                            <a class="dropdown-item" href="listarVitimas.php">Visualização</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="dropDelitos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Delitos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropDelitos">
                            <a class="dropdown-item" href="formDelitos.php">Cadastro</a>
                            <a class="dropdown-item" href="listarDelitos.php">Visualização</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="dropCrimes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Crimes
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropCrimes">
                            <a class="dropdown-item" href="formCrimes.php">Cadastro</a>
                            <a class="dropdown-item" href="listarCrimess.php">Visualização</a>
                        </div>
                    </li>
                </ul>          
            </div>
        </nav>  