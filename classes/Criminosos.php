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
	/*public __construct(){

	}*/
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
	public function setTempoPena($tempoPena){
		$this->tempoPena = $tempoPena;
	}
	public function setCpf($cpf){
		$this->setCpf = $cpf;
	}


}