 <?php
 $retorno = Array();
//Recuperar Posts e armazena-los em um Array
 $resultado = Array();

 $loc = "Location: formCriminosos.php";
 (empty($_POST["nome"]))?die("0"):$resultado["nome"] = $_POST["nome"];
 (empty($_POST["dataNasc"]))?header($loc):$resultado["dataNasc"] = $_POST["dataNasc"];
 (empty($_POST["endereco"]))?header($loc):$resultado["endereco"] = $_POST["endereco"];
 (empty($_POST["cpf"]))?header($loc):$resultado["cpf"] = $_POST["cpf"];
 

  (empty())?header($loc):$resultado["sentenca"] = $_POST["sentenca"];

 switch($_POST["sentenca"]){
 	case 1:
 		//parei aqui
 		break;	
 	if(!empty($_POST["anosPrisao"]) and !empty("mesesPrisao") and !empty("diasPrisao")){
	 	$resultado["anosPrisao"] = $_POST["anosPrisao"];
	 	$resultado["mesesPrisao"] = $_POST["mesesPrisao"];
	 	$resultado["diasPrisao"] = $_POST["diasPrisao"];
 	}elseif ($resultado["sentenca"] == "") {
 		# code...
 	}
 }
 
 print_r($resultado);
 die();
 require_once'classes/Criminosos.php';
 new Criminosos($resultado);
 print_r(Criminosos);
 
 $retorno["acao"] = 1;
 $retorno["mensagem"] = 1;
 return $retorno;