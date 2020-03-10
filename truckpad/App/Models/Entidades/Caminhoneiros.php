<?php

namespace App\Models\Entidades;


class Caminhoneiros{

	private $id;
	private $nome;
	private $data_nascimento;
	private $sexo;
	private $possui_veiculo;
	private $tipo_cnh;
	private $lat_origem;
	private $long_origem;
	private $fk_tipo_caminhoes;
	private $adiciona;
	private $numero_cnh;
	private $adiciona_last_update;


	public function getId()
	{
		$this->id = (int) $this->id;
		return $this->id;
	}

	public function setId($param)
	{
		$this->id = (int) $param;
	}


	public function getNome()
	{
		return $this->nome;
	}

	public function setNome($param)
	{
		$this->nome = $param;
	}

	public function getDataNascimento()
	{
		return $this->data_nascimento;
	}

	public function setDataNascimento($param)
	{
		$this->data_nascimento = $param;
	}

	public function getSexo()
	{
		return $this->sexo;
	}

	public function setSexo($param)
	{
		$this->sexo = $param;
	}

	

	public function getPossuiVeiculo()
	{
		return $this->possui_veiculo;
	}

	public function setPossuiVeiculo($param)
	{
		$this->possui_veiculo = $param;
	}

	

	public function getTipoCnh()
	{
		return $this->tipo_cnh;
	}

	public function setTipoCnh($param)
	{
		$this->tipo_cnh = $param;
	}

	public function getLatOrigem()
	{
		$this->lat_origem = (float) $this->lat_origem;
		return $this->lat_origem;
	}

	public function setLatOrigem($param)
	{
		$this->lat_origem = (float) $param;
	}


	public function getLongOrigem()
	{
		$this->long_origem = (float) $this->long_origem;
		return $this->long_origem;
	}

	public function setLongOrigem($param)
	{
		$this->long_origem = (float) $param;
	}


	public function getCaminhoes()
	{
		$this->fk_tipo_caminhoes = (int) $this->fk_tipo_caminhoes;
		return $this->fk_tipo_caminhoes;
	}

	public function setCaminhoes($param)
	{
		$this->fk_tipo_caminhoes = (int) $param;
	}

	public function getAdicona()
	{
		$this->adiciona = str_replace(" ", "T",$this->adiciona)."Z";
		return $this->adiciona;
	}

	public function setAdiciona($param)
	{
		$this->adiciona = $param;
	}


	public function getNumeroCnh()
	{
		return $this->numero_cnh;
	}

	public function setNumeroCnh($param)
	{
		$this->numero_cnh =  $param;
	}

	public function getLastAdicionado()
	{

		if(!empty($this->adiciona_last_update))
		{
			$this->adiciona_last_update = str_replace(" ", "T",$this->adiciona_last_update)."Z";
		}
	
		return $this->adiciona_last_update;
	}

	public function setLastAdicionado($param)
	{
		$this->adiciona_last_update =  $param;
	}



}