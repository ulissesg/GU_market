<?php 

class CarrinhoVO{
    
    private $idCarrinho;
    private $usuario;
    private $produto;
    

    /**
     * Get the value of idCarrinho
     */ 
    public function getIdCarrinho()
    {
        return $this->idCarrinho;
    }

    /**
     * Set the value of idCarrinho
     *
     * @return  self
     */ 
    public function setIdCarrinho($idCarrinho)
    {
        $this->idCarrinho = $idCarrinho;

        return $this;
    }

    /**
     * Get the value of usuario
     */ 
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */ 
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get the value of produto
     */ 
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * Set the value of produto
     *
     * @return  self
     */ 
    public function setProduto($produto)
    {
        $this->produto = $produto;

        return $this;
    }
}

?>