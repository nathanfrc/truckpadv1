<?php

namespace App\Models\Entidades;


class Destinos{

	private  $id;
	private $lat_destino;
	private $long_destino;
	private $carregado;
	private $fk_caminhoneiros;
	private $adicionado;
	

	public function getId()
	{
		$this->id = (int) $this->id;
		return $this->id;
	}

	public function setId($param)
	{
		$this->id = (int) $param;
	}


	public function getLatDestino()
	{
		$this->lat_destino = (float) $this->lat_destino;
		return $this->lat_destino;
	}

	public function setLatDestino($param)
	{
		$this->lat_destino =  (float) $param;
	}

	public function getLongDestino()
	{
		$this->long_destino = (float) $this->long_destino;
		return $this->long_destino;
	}

	public function setLongDestino($param)
	{
		$this->long_destino = (float) $param;
	}

	public function getCarregado()
	{
		return $this->carregado;
	}

	public function setCarregado($param)
	{
		$this->carregado = $param;
	}


	public function getCaminhoneiro()
	{
		$this->fk_caminhoneiros = (float) $this->fk_caminhoneiros;
		return $this->fk_caminhoneiros;
	}

	public function setCaminhoneiro($param)
	{
		$this->fk_caminhoneiros = (int) $param;
	}


	public function getAdiciona()
	{
		$this->adicionado = str_replace(" ", "T",$this->adicionado)."Z";
		return $this->adicionado;
	}

	public function setAdiciona($param)
	{
		$this->adicionado = $param;
	}





}