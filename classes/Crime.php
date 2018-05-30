<?php
require_once'classes\ConnectDB.php';
class Crime{
	//Atributos
	private $descricao, $id, $local, $dataCrime, $criminoso, $vitima, $delito; 
	private $fields, $conexao;

    //Métodos Especiais
    public function __construct(){
        $conexao = new ConnectDB();
        $this->setConexao($conexao);
    }
    public function getDescricao(){
		return $this->descricao;	
	}
    public function getId(){
		return $this->id;	
	}
	public function getLocal(){
		return $this->local;	
	}
	public function getDataCrime(){
		return $this->dataCrime;	
	}
    public function getCriminoso(){
		return $this->criminoso;	
	}
	public function getVitima(){
        return $this->vitima;   
    }
    public function getDelito(){
		return $this->delito;	
	}
    public function getConexao(){
        return $this->conexao;
    }
    public function getFields(){
       return $this->fields; 
    }
    public function setDescricao($descricao){
		$this->descricao = $descricao;
	}
    public function setId($id){
		$this->id = $id;
	}
	public function setLocal($local){
		$this->local = $local;
	}
	public function setDataCrime($dataCrime){
		$this->dataCrime = $dataCrime;
	}
    public function setCriminoso($criminoso){
        $this->criminoso = $criminoso;
    }
	public function setVitima($vitima){
        $this->vitima = $vitima;
    }
    public function setDelito($delito){
		$this->delito = $delito;
	}
    public function setFields($resultado) {
        $fields = Array();
        $this->setDescricao($resultado["descricao"]);
        $fields['descricao'] = $resultado['descricao'];
        
        $this->setLocal($resultado["local"]);
        $fields['local'] = $resultado['local'];
        
        $this->setDataCrime($resultado["dataCrime"]);
        $fields['data_crime'] = $resultado['dataCrime'];
        
		$this->setCriminoso($resultado["criminoso"]);
        $fields['id_criminoso'] = $resultado['criminoso'];
        
        $this->setVitima($resultado['vitima']);
        $fields['id_vitima'] = $resultado['vitima'];
        
        $this->setDelito($resultado['delito']);
        $fields['id_delito'] = $resultado['delito'];
        
        $this->fields = $fields;
    }
    public function setConexao($conexao){
        $this->conexao = $conexao;
    }

    //Métodos
    public function cadastrarCrime(){
        $conexao = $this->getConexao();
    	$conexao->setInsertBuilder("crime", $this->getFields());
    	if(!$conexao->getError()){
            return $conexao->getQuery();
        }
    }
    public function listarCrime($campos = null, $where = null){
        $conexao = $this->getConexao();
        $tabela = "view_crime"; 
        $conexao->setSelectBuilder($tabela, $campos, $where);      
        if(!$conexao->getError()){
            return $conexao->getQuery();
        }
    }
    
    public function apagarCrime($condition){
        $conexao = $this->getConexao();
        $conexao->setDeleteBuilder("crime", $condition);
    }
    
    public function alterarCrime($condition){
        $conexao = $this->getConexao();
        $fields = $this->getFields();
        $conexao->setUpdateBuilder("crime", $fields , $condition);
    }
    
    public function filtrarCrime($field, $value, $orderBy = null, $ordenacao = null){
        if(!is_array($field)){
            if($field == '*'){
                $field = Array('descricao', 'local', 'data_crime', 'nome_criminoso', 'nome_vitima', 'nome_delito');
            }
        }    
        
        if ($orderBy != null){
            switch ($orderBy){
                case 1:
                    $orderBy = "descricao";
                    break;
                case 2:
                    $orderBy = "local";
                    break;
                case 3:
                    $orderBy = "data_crime";
                    break;
                case 4:
                    $orderBy = "nome_criminoso";
                    break;
                case 5:
                    $orderBy = "nome_vitima";
                    break;
                case 6:
                    $orderBy = "nome_delito";
                    break;
                default:
                    $orderBy = null;
                    break;
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
        $table = "view_crime"; 
        $conexao->setSearchBuilder(2, $table, $field, $value, $orderBy, $ordenacao);  
    	if(!$conexao->getError()){
            return $conexao->getQuery();
        }
    }
    
}