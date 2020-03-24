<?php

class Livro{

    protected $idLivro;
    protected $nomeLivro;
    protected $nomeAutor;
    protected $nomeEditora;
    protected $qtdExemplar;
    
    function setNomeLivro($nomeLivro)
    {
        $this->nomeLivro = $nomeLivro;
    }

    function setNomeAutor($nomeAutor)
    {
        $this->nomeAutor = $nomeAutor;
    }

    function setNomeEditora($nomeEditora)
    {
        $this->nomeEditora = $nomeEditora;
    }

    function setQtdExemplar($qtdExemplar)
    {
        $this->qtdExemplar = $qtdExemplar;
    }

    function getNomeLivro()
    {
        return $this->nomeLivro;
    }

    function getNomeAutor()
    {
        return $this->nomeAutor;
    }

    function getNomeEditora()
    {
        return $this->nomeEditora;
    }

    function getQtdExemplar()
    {
        return $this->qtdExemplar;
    }

}

?>