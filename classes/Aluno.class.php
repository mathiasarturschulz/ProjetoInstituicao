<?php

class Aluno {

    private $id;
	private $codigo;
	private $nome;
	private $score;
	private $posicao;
	private $desde;
	private $resolvidos;
	private $tentados;
    private $submissoes;
    private $Instituicao;

    /**
     * Get the value of idAluno
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of idAluno
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

	/**
	 * Get the value of codigo
	 */ 
	public function getCodigo()
	{
		return $this->codigo;
	}

	/**
	 * Set the value of codigo
	 *
	 * @return  self
	 */ 
	public function setCodigo($codigo)
	{
		$this->codigo = $codigo;

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
	 * Get the value of score
	 */ 
	public function getScore()
	{
		return $this->score;
	}

	/**
	 * Set the value of score
	 *
	 * @return  self
	 */ 
	public function setScore($score)
	{
		$this->score = $score;

		return $this;
	}

	/**
	 * Get the value of posicao
	 */ 
	public function getPosicao()
	{
		return $this->posicao;
	}

	/**
	 * Set the value of posicao
	 *
	 * @return  self
	 */ 
	public function setPosicao($posicao)
	{
		$this->posicao = $posicao;

		return $this;
	}

	/**
	 * Get the value of desde
	 */ 
	public function getDesde()
	{
		return $this->desde;
	}

	/**
	 * Set the value of desde
	 *
	 * @return  self
	 */ 
	public function setDesde($desde)
	{
		$this->desde = $desde;

		return $this;
	}

	/**
	 * Get the value of resolvidos
	 */ 
	public function getResolvidos()
	{
		return $this->resolvidos;
	}

	/**
	 * Set the value of resolvidos
	 *
	 * @return  self
	 */ 
	public function setResolvidos($resolvidos)
	{
		$this->resolvidos = $resolvidos;

		return $this;
	}

	/**
	 * Get the value of tentados
	 */ 
	public function getTentados()
	{
		return $this->tentados;
	}

	/**
	 * Set the value of tentados
	 *
	 * @return  self
	 */ 
	public function setTentados($tentados)
	{
		$this->tentados = $tentados;

		return $this;
	}

	/**
	 * Get the value of submissoes
	 */ 
	public function getSubmissoes()
	{
		return $this->submissoes;
	}

	/**
	 * Set the value of submissoes
	 *
	 * @return  self
	 */ 
	public function setSubmissoes($submissoes)
	{
		$this->submissoes = $submissoes;

		return $this;
	}

    /**
     * Get the value of Instituicao
     */ 
    public function getInstituicao()
    {
        return $this->Instituicao;
    }

    /**
     * Set the value of Instituicao
     *
     * @return  self
     */ 
    public function setInstituicao($Instituicao)
    {
        $this->Instituicao = $Instituicao;

        return $this;
    }

    public function __toString()
    {
        return " { Aluno:"
            . " | ID = " . $this->getId()
            . " | Codigo = " . $this->getCodigo()
            . " | Nome = " . $this->getNome()
            . " | Score = " . $this->getScore()
            . " | Posicao = " . $this->getPosicao()
            . " | Desde = " . $this->getDesde()->format('d-m-Y')
            . " | Resolvidos = " . $this->getResolvidos()
            . " | Tentados = " . $this->getTentados()
            . " | Submissoes = " . $this->getSubmissoes()
            . " | Instituicao = " . $this->getInstituicao() . " } ";
    }
}