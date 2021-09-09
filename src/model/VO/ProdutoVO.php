<?php 

class produto_VO{

    private $idProduto;
    private $nome;
    private $descricao;
    private $codigoBarras;
    private $fabricante;
    private $validade;
    private $fkFornecedor;
    

    /**
     * Get the value of idProduto
     */ 
    public function getIdProduto()
    {
        return $this->idProduto;
    }

    /**
     * Set the value of idProduto
     *
     * @return  self
     */ 
    public function setIdProduto($idProduto)
    {
        $this->idProduto = $idProduto;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of descricao
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of codigoBarras
     */ 
    public function getCodigoBarras()
    {
        return $this->codigoBarras;
    }

    /**
     * Set the value of codigoBarras
     *
     * @return  self
     */ 
    public function setCodigoBarras($codigoBarras)
    {
        $this->codigoBarras = $codigoBarras;

        return $this;
    }

    /**
     * Get the value of fabricante
     */ 
    public function getFabricante()
    {
        return $this->fabricante;
    }

    /**
     * Set the value of fabricante
     *
     * @return  self
     */ 
    public function setFabricante($fabricante)
    {
        $this->fabricante = $fabricante;

        return $this;
    }

    /**
     * Get the value of validade
     */ 
    public function getValidade()
    {
        return $this->validade;
    }

    /**
     * Set the value of validade
     *
     * @return  self
     */ 
    public function setValidade($validade)
    {
        $this->validade = $validade;

        return $this;
    }

    /**
     * Get the value of fkFornecedor
     */ 
    public function getFkFornecedor()
    {
        return $this->fkFornecedor;
    }

    /**
     * Set the value of fkFornecedor
     *
     * @return  self
     */ 
    public function setFkFornecedor($fkFornecedor)
    {
        $this->fkFornecedor = $fkFornecedor;

        return $this;
    }
}

?>