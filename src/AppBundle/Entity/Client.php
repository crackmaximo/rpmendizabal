<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */

class Client{
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;
	
	/**
	 * @ORM\Column(type="string", length=100)
	 * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="nameerror")
	 */
	protected $name;
	/**
	 *
	 * @ORM\Column(type="integer")
	 * @Assert\Regex("/^\d{9,12}/",
	 * 			message = "client.phone.invalid")
	 */
	protected $phone;
	
	/**
	 * @ORM\OneToMany(targetEntity="Task", mappedBy="client", cascade={"persist", "remove"})
	 */
	protected $tasks;
	
	public function __construct()
	{
		$this->tasks = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Client
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     * @return Client
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Add tasks
     *
     * @param \AppBundle\Entity\Task $tasks
     * @return Client
     */
    public function addTask(\AppBundle\Entity\Task $tasks)
    {
        $this->tasks[] = $tasks;

        return $this;
    }
    /**
     * Remove tasks
     *
     * @param \AppBundle\Entity\Task $tasks
     */
    public function removeTask(\AppBundle\Entity\Task $tasks)
    {
        $this->tasks->removeElement($tasks);
    }

    /**
     * Get tasks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTasks()
    {
        return $this->tasks;
    }
    public function __toString(){
    	return sprintf("%s",$this->getName());
    }
    public function getLongName(){
    	return sprintf("%s Telefono %d",$this->getName(),$this->getPhone());
    }
}
