<?php
require_once'classes\ConnectDB.php';
class Vitima{
	//Atributos
	private $nome, $id, $endereco, $dataNasc, $sexo, $cpf;
	private $fields, $conexao;

    //Métodos Especiais
    public function __construct(){
        $conexao = new ConnectDB();
        $this->setConexao($conexao);
    }
    
    public function getNome(){
		return $this->nome;	
	}
    public function getId(){
		return $this->id;	
	}
	public function getEndereco(){
		return $this->endereco;	
	}
	public function getDataNasc(){
		return $this->dataNasc;	
	}
    public function getSexo(){
		return $this->sexo;	
	}
	public function getCpf(){
		return $this->cpf;	
	}
    public function getFields(){
    	return $this->fields;
    }
    public function getConexao(){
        return $this->conexao;
    }
    public function setNome($nome){
		$this->nome = $nome;
	}
    public function setId($id){
		$this->id = $id;
	}
	public function setEndereco($endereco){
		$this->endereco = $endereco;
	}
	public function setDataNasc($dataNasc){
		$this->dataNasc = $dataNasc;
	}
    public function setSexo($sexo){
        $this->sexo = $sexo;
    }
	public function setCpf($cpf){
		$this->setCpf = $cpf;
	}
    public function setFields($resultado){
        $fields = Array();
        
        $this->setNome($resultado["nome"]);
        $fields['nome'] = $resultado['nome'];
        
        $this->setDataNasc($resultado["dataNasc"]);
        $fields['data_nasc'] = $resultado['dataNasc'];
        
        $this->setSexo($resultado["sexo"]);
        $fields['sexo'] = $resultado['sexo'];
        
        if(!empty($resultado["endereco"])){
            $this->setEndereco($resultado["endereco"]);
            $fields['endereco'] = $resultado['endereco'];
        }

        if(!empty($resultado["cpf"])){
            $this->setCpf($resultado["cpf"]);
            $fields['cpf'] = $resultado['cpf'];
        }
        $this->fields = $fields;
    }
    public function setConexao($conexao){
        $this->conexao = $conexao;
    }
    //Métodos
    public function cadastrarVitima(){
        $conexao = $this->getConexao();
    	$conexao->setInsertBuilder("vitima", $this->getFields());
    	if(!$conexao->getError()){
            return $conexao->getQuery();
        }
    }
    public function listarVitima($campos = null, $where = null){
        $conexao = $this->getConexao();
        $tabela = "vitima"; 
        if(is_null($campos)){
            $campos = null;
        }
        if(is_null($where)){
            $where = null; 
        }
        $conexao->setSelectBuilder($tabela, $campos, $where);      
        if(!$conexao->getError()){
            return $conexao->getQuery();
        }
    }
    public function apagarVitima($condition){
        $conexao = $this->getConexao();
        $conexao->setDeleteBuilder("vitima", $condition);
    }
    
    public function alterarVitima($condition){
        $conexao = $this->getConexao();
        $fields = $this->getFields();
        $conexao->setUpdateBuilder("vitima", $fields , $condition);
    }
}