<?php


namespace Qulix\RecyclingBundle\Entity;

class Population
{
	protected $id;

	protected $sort;

	protected $crude;

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
	public function getSort()
	{
		return $this->sort;
	}

	/**
	 * @param mixed $sort
	 */
	public function setSort($sort)
	{
		$this->sort = $sort;
	}

	/**
	 * @return mixed
	 */
	public function getCrude()
	{
		return $this->crude;
	}

	/**
	 * @param mixed $crude
	 */
	public function setCrude($crude)
	{
		$this->crude = $crude;
	}

	public function __construct()
	{

		$this->crude = new \Doctrine\Common\Collections\ArrayCollection();
	}
}
