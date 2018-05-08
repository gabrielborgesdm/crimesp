<?php
require_once 'ConexaoPDO.php';
class Criminoso{
	//Atributos
	public $nome;
	public $endereco;
	public $dataNasc;
	public $sentenca;
	public $tempoCadeia;
    public $dataExec;
	public $cpf;

    //Métodos Especiais
	public function __construct($retorno){
		$this->setNome($retorno["nome"]);
		$this->setEndereco($retorno["endereco"]);
		$this->setDataNasc($retorno["dataNasc"]);
		$this->setSentenca($retorno["sentenca"]);
		$this->setCpf($retorno["cpf"]);
		if(isset($retorno["anosPrisao"])){
			$this->setTempoCadeia($retorno["anosPrisao"], $retorno["mesesPrisao"], $retorno["diasPrisao"]);
		}else if(isset($retorno["dataExec"])){
            $this->setDataExec($retorno["dataExec"]);
        }	
	}

	public function getNome(){
		return $this->nome;	
	}
	public function getEndereco(){
		return $this->endereco;	
	}
	public function getDataNasc(){
		return $this->dataNasc;	
	}
	public function getSentenca(){
		return $this->sentenca;	
	}
	public function getTempoCadeia(){
		return $this->tempoCadeia;	
	}
	public function getCpf(){
		return $this->cpf;	
	}
    public function getDataExec(){
        return $this->dataExec;
    }

    public function setNome($nome){
		$this->nome = $nome;
	}
	public function setEndereco($endereco){
		$this->endereco = $endereco;
	}
	public function setDataNasc($dataNasc){
		$this->dataNasc = $dataNasc;
	}
	public function setSentenca($sentenca){
		$this->sentenca = $sentenca;
	}
	public function setTempoCadeia($dias, $meses, $anos){
		$tempo = $dias / 31;
		$tempo += $meses;
		$tempo += $anos * 12;
		$this->tempoCadeia = $tempo;
	}
	public function setCpf($cpf){
		$this->setCpf = $cpf;
	}
    public function setDataExec($dataExec){
        $this->dataExec = $dataExec;
    }
    
    //Métodos
    public function cadastrarCriminoso($conn){
        
        /*
        $sql = 'INSERT INTO criminoso(:p1, :p2, :p3, :p4, :p5, p6)'.
                ' VALUES(":r1", ":r2", ":r3", ":r4", ":r5", ":r6")';
        */
        $sql = 'SELECT :p1, :r2 FROM criminoso';

        $query = prepararSql($sql);
       
        $parametros = Array();
        /*$parametros[":p1"] = "nome";
        $parametros[":p2"] = "endereco";
        $parametros[":p3"] = "dataNasc";
        $parametros[":p4"] = "sentenca";
        $parametros[":p5"] = "dataExec";
        $parametros[":p6"] = "tempoCadeia";
        $parametros[":r1"] = $this->getNome();
        $parametros[":r2"] = $this->getEndereco();
        $parametros[":r3"] = $this->getDataNasc();
        $parametros[":r4"] = $this->getSentenca();
        #$parametros[":r5"] = $this->getDataExec();
        #$parametros[":r6"] = $this->getTempoCadeia();*/
        $parametros[":p1"] = "nome";
        $parametros[":r2"] = "endereco";
        
        $query = bindarSql($query, $parametros);
     	$linha = executar($query);
       
        if($linha){
            print_r($linha);
        }else{
            echo"Algo de errado aconteceu";
        }
        
    }
}