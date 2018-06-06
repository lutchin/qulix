<?php


namespace Qulix\RecyclingBundle\Entity;

class Crude
{
	protected $id;

	protected $name;

	protected $population;

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getPopulation()
	{
		return $this->population;
	}

	/**
	 * @param mixed $population
	 */
	public function setPopulation($population)
	{
		$this->population = $population;
	}

	public function __construct()
	{

		$this->population = array();
	}


}
