<?php

class Turma {

    private $id;
    private $nome;
    private $listaAlunos;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

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
     * Get the value of listaAlunos
     */ 
    public function getListaAlunos()
    {
        return $this->listaAlunos;
    }

    /**
     * Set the value of listaAlunos
     *
     * @return  self
     */ 
    public function setListaAlunos($listaAlunos)
    {
        $this->listaAlunos = $listaAlunos;

        return $this;
    }

    public function __toString()
    {
        return " { Instituicao:"
            . " | ID = " . $this->getId()
            . " | Nome = " . $this->getNome()
            . " # ListaAlunos = " . implode("", $this->getListaAlunos()) . " } ";
    }
}