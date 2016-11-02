<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */

class Product{
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;
	/**
	 * @ORM\Column(type="string", length=100)
	 */
	protected $wearType;
	/**
	 * @ORM\Column(type="string")
	 */
	protected $size;
	/**
	 * @ORM\Column(type="string", length=200)
	 */
	protected $colour;
	/**
	 * @ORM\Column(type="string", length=200)
	 */
	protected $sex;
	/**
	 * @ORM\Column(type="integer")
	 */
	protected $price;
	
	/**
	 * @ORM\OneToMany(targetEntity="Task", mappedBy="product", cascade={"persist", "remove"})
	 */
	protected $tasksPro;
	
	public function __construct()
	{
		$this->tasksPro = new ArrayCollection();
	}
	
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set wearType
     *
     * @param string $wearType
     * @return Product
     */
    public function setWearType($wearType)
    {
        $this->wearType = $wearType;

        return $this;
    }

    /**
     * Get wearType
     *
     * @return string 
     */
    public function getWearType()
    {
        return $this->wearType;
    }

    /**
     * Set size
     *
     * @param string $size
     * @return Product
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string 
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set colour
     *
     * @param string $colour
     * @return Product
     */
    public function setColour($colour)
    {
        $this->colour = $colour;

        return $this;
    }

    /**
     * Get colour
     *
     * @return string 
     */
    public function getColour()
    {
        return $this->colour;
    }

    /**
     * Set sex
     *
     * @param string $sex
     * @return Product
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Add tasksPro
     *
     * @param \AppBundle\Entity\Task $tasksPro
     * @return Product
     */
    public function addTasksPro(\AppBundle\Entity\Task $tasksPro)
    {
        $this->tasksPro[] = $tasksPro;

        return $this;
    }

    /**
     * Remove tasksPro
     *
     * @param \AppBundle\Entity\Task $tasksPro
     */
    public function removeTasksPro(\AppBundle\Entity\Task $tasksPro)
    {
        $this->tasksPro->removeElement($tasksPro);
    }

    /**
     * Get tasksPro
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTasksPro()
    {
        return $this->tasksPro;
    }
    public function __toString(){
    	return sprintf(" %s %s %s %s",$this->getWearType(),$this->getSize(),$this->getColour(),$this->getSex());
    }
}
