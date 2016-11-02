<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity
 */

class Task{
	
	/**
	* @var integer
	*
	* @ORM\Column(name="id", type="integer")
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;
	
	/**
	* @var string
	*
	* @ORM\Column(name="tasktype", type="string", length=255, nullable=true)
	*/
	protected $taskType;
	
	/**
	 * @ORM\Column(type="string",nullable=true)
	 *
	 */
	protected $startDate;
	
	/**
	 * @ORM\Column(type="date",nullable=true)
	 * @Assert\GreaterThanOrEqual("today")
     *                 
	 *
	 */
	protected $endDate;
	
	/**
	 * @ORM\Column(type="integer",nullable=true)
     *              
	 */
	protected $priceFull;
	
	/**
	 * @ORM\Column(type="integer",nullable=true)
     *          
	 */
	protected $quantity;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(name="taskStatus", type="string", length=255)
	 */
	protected $taskStatus;
	
	/**
	 * @ORM\Column(type="integer",nullable=true)
	 */
	protected $accountPrice;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(name="statusPay", type="string", length=255)
	 */
	protected $statusPay;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(name="comment", type="string", length=255,nullable=true)
	 */
	protected $comment;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Client", inversedBy="tasks")
	 * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false)
	 */
	protected $client;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Product", inversedBy="tasksPro")
	 * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
	 */
	protected $product;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Falla", inversedBy="tasksF")
	 * @ORM\JoinColumn(name="falla_id", referencedColumnName="id", nullable=false)
	 */
	protected $falla;
	
	/**
	 * @ORM\Column(type="string", length=100, nullable=true)
	 * 
	 */
	protected $name;
	
	/**
	 *
	 * @ORM\Column(type="string",nullable=true)
	 */
	protected $sizeName;

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
     * Set taskType
     *
     * @param string $taskType
     * @return Task
     */
    public function setTaskType($taskType)
    {
        $this->taskType = $taskType;

        return $this;
    }

    /**
     * Get taskType
     *
     * @return string 
     */
    public function getTaskType()
    {
        return $this->taskType;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Task
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Task
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set priceFull
     *
     * @param integer $priceFull
     * @return Task
     */
    public function setPriceFull($priceFull)
    {
        $this->priceFull = $priceFull;

        return $this;
    }

    /**
     * Get priceFull
     *
     * @return integer 
     */
    public function getPriceFull()
    {
        return $this->priceFull;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return Task
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set taskStatus
     *
     * @param string $taskStatus
     * @return Task
     */
    public function setTaskStatus($taskStatus)
    {
        $this->taskStatus = $taskStatus;

        return $this;
    }

    /**
     * Get taskStatus
     *
     * @return string 
     */
    public function getTaskStatus()
    {
        return $this->taskStatus;
    }

    /**
     * Set accountPrice
     *
     * @param integer $accountPrice
     * @return Task
     */
    public function setAccountPrice($accountPrice)
    {
        $this->accountPrice = $accountPrice;

        return $this;
    }

    /**
     * Get accountPrice
     *
     * @return integer 
     */
    public function getAccountPrice()
    {
        return $this->accountPrice;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Task
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     * @return Task
     */
    public function setClient(\AppBundle\Entity\Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     * @return Task
     */
    public function setProduct(\AppBundle\Entity\Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set falla
     *
     * @param \AppBundle\Entity\Falla $falla
     * @return Task
     */
    public function setFalla(\AppBundle\Entity\Falla $falla)
    {
        $this->falla = $falla;

        return $this;
    }

    /**
     * Get falla
     *
     * @return \AppBundle\Entity\Falla 
     */
    public function getFalla()
    {
        return $this->falla;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Task
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
     * Set sizeName
     *
     * @param integer $sizeName
     * @return Task
     */
    public function setSizeName($sizeName)
    {
        $this->sizeName = $sizeName;

        return $this;
    }

    /**
     * Get sizeName
     *
     * @return integer 
     */
    public function getSizeName()
    {
        return $this->sizeName;
    }

    /**
     * Set statusPay
     *
     * @param string $statusPay
     * @return Task
     */
    public function setStatusPay($statusPay)
    {
        $this->statusPay = $statusPay;

        return $this;
    }

    /**
     * Get statusPay
     *
     * @return string 
     */
    public function getStatusPay()
    {
        return $this->statusPay;
    }

}
