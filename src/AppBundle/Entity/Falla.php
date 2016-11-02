<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Falla
 *
 * @ORM\Table()
 * @ORM\Entity
 */

class Falla{
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=255)
	 * @Assert\NotBlank()
	 * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="nameerror")
	 */
	private $name;
	
	/**
	 * @ORM\OneToMany(targetEntity="Task", mappedBy="falla", cascade={"persist", "remove"})
	 */
	protected $tasksF;
	
	public function __construct()
	{
		$this->tasksF = new ArrayCollection();
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
     * @return Falla
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
     * Add tasksF
     *
     * @param \AppBundle\Entity\Task $tasksF
     * @return Falla
     */
    public function addTasksF(\AppBundle\Entity\Task $tasksF)
    {
        $this->tasksF[] = $tasksF;

        return $this;
    }

    /**
     * Remove tasksF
     *
     * @param \AppBundle\Entity\Task $tasksF
     */
    public function removeTasksF(\AppBundle\Entity\Task $tasksF)
    {
        $this->tasksF->removeElement($tasksF);
    }

    /**
     * Get tasksF
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTasksF()
    {
        return $this->tasksF;
    }
    public function __toString(){
    	return sprintf("%s",$this->getName());
    }
}
