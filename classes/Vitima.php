<?php
require_once 'ConexaoPDO.php';
class Vitima{
	//Atributos
	public $nome;
	public $endereco;
	public $dataNasc;
	public $cpf;

    //Métodos Especiais
	public function __construct($retorno){
		$this->setNome($retorno["nome"]);
		$this->setEndereco($retorno["endereco"]);
		$this->setDataNasc($retorno["dataNasc"]);
		$this->setCpf($retorno["cpf"]);
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
	public function setCpf($cpf){
		$this->setCpf = $cpf;
	}

    //Métodos
    public function cadastrarVitima($conn){
     //
    }
}