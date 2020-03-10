<?php

namespace App\Models\Entidades;


class Caminhoes{

	private $id;
	private $titulo;
	private $adicionado;
	

	public function getId()
	{
		$this->id = (float) $this->id;
		return $this->id;
	}

	public function setId($param)
	{
		$this->id = (int) $param;
	}


	public function getTitulo()
	{
		return $this->titulo;
	}

	public function setTitulo($param)
	{
		$this->titulo = $param;
	}

	public function getAdicionado()
	{
		$this->adicionado = str_replace(" ", "T",$this->adicionado)."Z";

		return $this->adicionado;
	}

	public function setAdicionado($param)
	{
		 $this->adicionado = $param;
	}





}