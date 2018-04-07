<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SurfaceName
 *
 * @ORM\Table(name="surface_name")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SurfaceNameRepository")
 */
class SurfaceName
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
     * @ORM\OneToMany(targetEntity="Surface", mappedBy="surfaceName")
     */
    private $surface;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="Rate", type="string", length=255, nullable=true)
     */
    private $rate;


    public function __toString()
    {
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
     * Set name
     *
     * @param string $name
     *
     * @return SurfaceName
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
     * Set rate
     *
     * @param string $rate
     *
     * @return SurfaceName
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
     * Constructor
     */
    public function __construct()
    {
        $this->surface = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add surface
     *
     * @param \AppBundle\Entity\Surface $surface
     *
     * @return SurfaceName
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

    /**
     * Set type
     *
     * @param string $type
     *
     * @return SurfaceName
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
}
