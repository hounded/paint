<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Job
 *
 * @ORM\Table(name="job")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JobRepository")
 */
class Job
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Customer", type="string", length=255)
     */
    private $customer;

    /**
     * @var float
     *
     * @ORM\Column(name="Margin", type="float",nullable=true)
     */
    private $margin;

    /**
     * @var float
     *
     * @ORM\Column(name="Materials", type="float",nullable=true)
     */
    private $materials;

    /**
     * @var float
     *
     * @ORM\Column(name="Hours", type="float",nullable=true)
     */
    private $hours;

    /**
     * @var float
     *
     * @ORM\Column(name="CostAdditionalItems", type="float",nullable=true)
     */
    private $costAdditionalItems;

    /**
     * @var float
     *
     * @ORM\Column(name="Cost", type="float",nullable=true)
     */
    private $cost;

    /**
     * @var float
     *
     * @ORM\Column(name="CostArea", type="float",nullable =true)
     */
    private $costAreas;


    /**
     * @ORM\OneToMany(targetEntity="Area", mappedBy="job")
     */
    private $area;


    /**
     * @ORM\OneToMany(targetEntity="additionalItems", mappedBy="job")
     */
    private $additionalItems;

    public function __toString()
    {
        return $this->getId()." ".$this->getCustomer();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->additionalItems = new \Doctrine\Common\Collections\ArrayCollection();
        $this->area = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set customer
     *
     * @param string $customer
     *
     * @return Job
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return string
     */
    public function getCustomer()
    {
        return $this->customer;
    }


    /**
     * Set cost
     *
     * @param float $cost
     *
     * @return Job
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Add additionalItem
     *
     * @param \AppBundle\Entity\AdditionalItems $additionalItem
     *
     * @return Job
     */
    public function addAdditionalItem(\AppBundle\Entity\AdditionalItems $additionalItem)
    {
        $this->additionalItems[] = $additionalItem;

        return $this;
    }

    /**
     * Remove additionalItem
     *
     * @param \AppBundle\Entity\AdditionalItems $additionalItem
     */
    public function removeAdditionalItem(\AppBundle\Entity\AdditionalItems $additionalItem)
    {
        $this->additionalItems->removeElement($additionalItem);
    }

    /**
     * Get additionalItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdditionalItems()
    {
        return $this->additionalItems;
    }

    /**
     * Set costAdditionalItems
     *
     * @param float $costAdditionalItems
     *
     * @return Job
     */
    public function setCostAdditionalItems($costAdditionalItems)
    {
        $this->costAdditionalItems = $costAdditionalItems;

        return $this;
    }

    /**
     * Get costAdditionalItems
     *
     * @return float
     */
    public function getCostAdditionalItems()
    {
        return $this->costAdditionalItems;
    }

    /**
     * Set costAreas
     *
     * @param float $costAreas
     *
     * @return Job
     */
    public function setCostAreas($costAreas)
    {
        $this->costAreas = $costAreas;

        return $this;
    }

    /**
     * Get costAreas
     *
     * @return float
     */
    public function getCostAreas()
    {
        return $this->costAreas;
    }



    /**
     * Set materials
     *
     * @param float $materials
     *
     * @return Job
     */
    public function setMaterials()
    {
        $this->materials = ($this->cost - $this->margin)*0.2;

        return $this;
    }

    /**
     * Get materials
     *
     * @return float
     */
    public function getMaterials()
    {
        return $this->materials;
    }

    /**
     * Set hours
     *
     * @param float $hours
     *
     * @return Job
     */
    public function setHours()
    {
        $this->hours = ($this->cost - $this->margin -$this->materials)/30;

        return $this;
    }

    /**
     * Get hours
     *
     * @return float
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Set margin
     *
     * @param float $margin
     *
     * @return Job
     */
    public function setMargin()
    {
        $this->margin = $this->cost * 0.3;

        return $this;
    }

    /**
     * Get margin
     *
     * @return float
     */
    public function getMargin()
    {
        return $this->margin;
    }

    /**
     * Add area
     *
     * @param \AppBundle\Entity\Area $area
     *
     * @return Job
     */
    public function addArea(\AppBundle\Entity\Area $area)
    {
        $this->area[] = $area;

        return $this;
    }

    /**
     * Remove area
     *
     * @param \AppBundle\Entity\Area $area
     */
    public function removeArea(\AppBundle\Entity\Area $area)
    {
        $this->area->removeElement($area);
    }

    /**
     * Get area
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArea()
    {
        return $this->area;
    }
}
