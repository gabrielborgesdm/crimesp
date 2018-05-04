<?php
class Criminosos{
	//Atributos
	private $nome;
	private $endereco;
	private $dataNasc;
	private $tipoPena;
	private $tempoPena;
	private $cpf;

	//Métodos
	
	//Métodos Especiais
	public __construct($retorno){
		$this->setNome($retorno["nome"]);
		$this->setEndereco($retorno["endereco"]);
		$this->setDataNasc($retorno["dataNasc"]);
		$this->setTipoPena($retorno["tipoPena"]);
		$this->setCpf($retorno["cpf"]);
		if(isset($retorno["anosPrisao"]){
			$this->setTempoPena($retorno["anosPrisao"],
					$retorno["mesesPrisao"], $retorno["diasPrisao"]);
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
	public function getTipoPena(){
		return $this->tipoPena;	
	}
	public function getTempoPena(){
		return $this->tempoPena;	
	}
	public function getCpf(){
		return $this->cpf;	
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
	public function setTipoPena($tipoPena){
		$this->tipoPena = $tipoPena;
	}
	public function setTempoPena($dias, $meses, $anos){
		$tempo = $dias / 31;
		$tempo += $meses;
		$tempo += $anos * 12;
		$this->tempoPena = $tempo;
	}
	public function setCpf($cpf){
		$this->setCpf = $cpf;
	}


}