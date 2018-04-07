<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Area
 *
 * @ORM\Table(name="area")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AreaRepository")
 */
class Area
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
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Surface", mappedBy="area")
     */
    private $surface;

    /**
     * @ORM\ManyToOne(targetEntity="Job", inversedBy="area")
     * @ORM\JoinColumn(name="Job", referencedColumnName="id",nullable=true)
     */
    private $job;

    /**
     * @var float
     *
     * @ORM\Column(name="Cost", type="float",nullable=true)
     */
    private $cost;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->area = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString(){
        return $this->getName();
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
     * Set cost
     *
     * @param string $cost
     *
     * @return Area
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return string
     */
    public function getCost()
    {
        return $this->cost;
    }


    /**
     * Add area
     *
     * @param \AppBundle\Entity\Area $area
     *
     * @return Area
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

    /**
     * Set job
     *
     * @param \AppBundle\Entity\Job $job
     *
     * @return Area
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
     * Set name
     *
     * @param string $name
     *
     * @return Area
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
     * Add surface
     *
     * @param \AppBundle\Entity\Surface $surface
     *
     * @return Area
     */
    public function addSurface(\AppBundle\Entity\Surface $surface)
    {
        $this->surface[] = $surface;

        return $this;
    }

    /**
     * Remove surface
     *
     * @param \AppBundle\Entity\Surface $surface
     */
    public function removeSurface(\AppBundle\Entity\Surface $surface)
    {
        $this->surface->removeElement($surface);
    }

    /**
     * Get surface
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSurface()
    {
        return $this->surface;
    }
}
