<?php
require_once'classes\ConnectDB.php';
class Delito{
	//Atributos
	private $nome, $id, $descricao;
	private $fields, $conexao;

    //Métodos Especiais
    public function __construct(){
        $conexao = new ConnectDB();
        $this->setConexao($conexao);
    }
    public function getId(){
		return $this->id;	
	}
    public function getNome(){
		return $this->nome;	
	}
    public function getDescricao() {
        return $this->descricao;
    }
    public function getFields(){
    	return $this->fields;
    }
    public function getConexao(){
        return $this->conexao;
    }
    public function setId($id){
		$this->id = $id;
	}
    public function setNome($nome){
		$this->nome = $nome;
	}
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    public function setFields($resultado){
        $fields = array();
        
        $this->setNome($resultado["nome"]);
        $fields['nome'] = $resultado['nome'];
        
        $this->setDescricao($resultado["descricao"]);
        $fields['descricao'] = $resultado['descricao'];
        
    	$this->fields = $fields;
    }
    public function setConexao($conexao){
        $this->conexao = $conexao;
    }
    //Métodos
    public function cadastrarDelitos(){
        $conexao = $this->getConexao();
    	$conexao->setInsertBuilder("delito", $this->getFields());
    	if(!$conexao->getError()){
            return $conexao->getQuery();
        }
    }
    public function listarDelito($campos = null, $where = null){
        $conexao = $this->getConexao();
        $tabela = "delito"; 
        $conexao->setSelectBuilder($tabela, $campos, $where);      
        if(!$conexao->getError()){
            return $conexao->getQuery();
        }
    }
    public function apagarDelito($condition){
        $conexao = $this->getConexao();
        $conexao->setDeleteBuilder("delito", $condition);
    }
    
    public function alterarDelito($condition){
        $conexao = $this->getConexao();
        $fields = $this->getFields();
        $conexao->setUpdateBuilder("delito", $fields , $condition);
    }
    
    public function filtrarDelito($field, $value, $orderBy = null, $ordenacao = null){
        if(!is_array($field)){
            if($field == '*'){
                $field = Array('nome', 'descricao');
            }
        }    
        if ($orderBy != null){
            switch ($orderBy){
                case 1:
                    $orderBy = "nome";
                    break;
                case 2:
                    $orderBy = "descricao";
                    break;
                default:
                    $orderBy = null;
            }
        
            if(empty($ordenacao)){
                $ordenacao = 'ASC';
            }else{
                switch($ordenacao){
                    case 2:
                        $ordenacao = 'DESC';
                        break;
                    default:
                        $ordenacao = 'ASC';
                        break;
                }
            }
        }
        $conexao = $this->getConexao();
        $table = "delito"; 
        $conexao->setSearchBuilder(2, $table, $field, $value, $orderBy, $ordenacao);  
    	if(!$conexao->getError()){
            return $conexao->getQuery();
        }
    }    
}