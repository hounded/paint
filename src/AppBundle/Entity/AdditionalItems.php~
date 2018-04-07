<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdditionalItems
 *
 * @ORM\Table(name="additional_items")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdditionalItemsRepository")
 */
class AdditionalItems
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
     * @ORM\Column(name="Description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="Rate", type="string", length=255)
     */
    private $rate;

    /**
     * @var float
     *
     * @ORM\Column(name="Multi", type="float",nullable=true)
     */
    private $multi;

    /**
     * @var float
     *
     * @ORM\Column(name="Total", type="float")
     */
    private $total;

    /**
     * @ORM\ManyToOne(targetEntity="Job", inversedBy="additionalItems")
     * @ORM\JoinColumn(name="Job", referencedColumnName="id",nullable=true)
     */
    private $job;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="additionalItems")
     * @ORM\JoinColumn(name="User", referencedColumnName="id",nullable=true)
     */
    private $user;

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
     * Set description
     *
     * @param string $description
     *
     * @return AdditionalItems
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return AdditionalItems
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set rate
     *
     * @param string $rate
     *
     * @return AdditionalItems
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return string
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set multi
     *
     * @param float $multi
     *
     * @return AdditionalItems
     */
    public function setMulti($multi)
    {
        $this->multi = $multi;

        return $this;
    }

    /**
     * Get multi
     *
     * @return float
     */
    public function getMulti()
    {
        return $this->multi;
    }

    /**
     * Set total
     *
     * @param float $total
     *
     * @return AdditionalItems
     */
    public function setTotal()
    {
        $this->total = $this->getRate() * $this->getMulti();

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set job
     *
     * @param \AppBundle\Entity\Job $job
     *
     * @return AdditionalItems
     */
    public function setJob(\AppBundle\Entity\Job $job = null)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return \AppBundle\Entity\Job
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return AdditionalItems
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
