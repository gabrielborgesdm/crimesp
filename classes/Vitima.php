<?php
require_once'classes\ConexaoPDO.php';
class Vitima{
	//Atributos
	private $nome, $id, $endereco, $dataNasc, $sexo, $cpf;
	private $resultadoPost, $conexao;

    //Métodos Especiais
    public function __construct(){
        $conexao = new ConexaoPDO();
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
    public function getResultadoPost(){
    	return $this->resultadoPost;
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
    public function setResultadoPost($resultadoPost){
    	$this->resultadoPost = $resultadoPost;
    }
    public function setConexao($conexao){
        $this->conexao = $conexao;
    }
    //Métodos
    public function recebeDados($resultado) {
        $conexao = new ConexaoPDO();
        $this->setConexao($conexao);
        $this->setResultadoPost($resultado);
        $this->setNome($resultado["nome"]);
        $this->setDataNasc($resultado["dataNasc"]);
        $this->setSexo($resultado["sexo"]);
        
        if(!empty($resultado["endereco"])){
            $this->setEndereco($resultado["endereco"]);
        }

        if(!empty($resultado["cpf"])){
            $this->setCpf($resultado["cpf"]);
        }                   
    }
    public function cadastrarVitima(){
        $conexao = $this->getConexao();
    	$conexao->setInsertBuilder("vitima", $this->getResultadoPost());
    	if($conexao->getErro()){
    		echo $conexao->getErro();
    	}
    	else{
    		include('formSucesso.php');
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
        if(!$conexao->getErro()){
            return $conexao->getQuery();
        }
    }
    public function apagarVitima($condition){
        $conexao = $this->getConexao();
        $conexao->setDeleteBuilder("vitima", $condition);
    }
    
    public function alterarVitima($condition){
        $conexao = $this->getConexao();
        $tupla = $this->getResultadoPost();
        $conexao->setUpdateBuilder("vitima", $tupla , $condition);
    }
}