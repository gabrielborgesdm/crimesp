 <?php
require_once 'ConexaoPDO.php';
class Criminoso{
	//Atributos
	private $nome;
	private $endereco;
	private $dataNasc;
	private $sentenca;
	private $tempoCadeia;
    private $dataExec;
	private $cpf;
	private $resultadoPost;

    //Métodos Especiais
    public function __construct($resultado) {
  		$this->setResultadoPost($resultado);
        $this->setNome($resultado["nome"]);
        $this->setDataNasc($resultado["dataNasc"]);
        $this->setSentenca($resultado["sentenca"]);
        
        if(!empty($resultado["dataExec"])){
        	$this->setDataExec($resultado["dataExec"]);
        }

        if(!empty($resultado["tempoCadeia"])){
        	$this->setTempoCadeia($resultado["tempoCadeia"]);     	
        }

        if(!empty($resultado["endereco"])){
        	$this->setEndereco($resultado["endereco"]);
    	}

        if(!empty($resultado["cpf"])){
        	$this->setCpf($resultado["cpf"]);
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
    public function getResultadoPost(){
    	return $this->resultadoPost;
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
	public function setTempoCadeia($tempoCadeia){
	
        $this->tempoCadeia = json_encode($tempoCadeia);   
	}
	public function setCpf($cpf){
		$this->setCpf = $cpf;
	}
    public function setDataExec($dataExec){
        $this->dataExec = $dataExec;
    }
    public function setResultadoPost($resultadoPost){
    	$this->resultadoPost = $resultadoPost;
    }
    //Métodos
    public function cadastrarCriminoso($conexao){
    	$conexao->setInsertBuilder("criminoso", $this->getResultadoPost());
    	echo "<pre>";
    	#print_r($conexao->getInsertBuilder());
    	#die();
    	$conexao->execInsert();
    	if($conexao->getErro()){
    		
    		echo $conexao->getErro();
    	}
    	else{
    		echo "foi";
    	}
    }
}