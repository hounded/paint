<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Surface", mappedBy="user")
     */
    private $surface;

    /**
     * @ORM\OneToMany(targetEntity="AdditionalItems", mappedBy="user")
     */
    private $additionalItems;
//
    public function __construct() {
        parent::__construct();

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
     * Add area
     *
     * @param \AppBundle\Entity\Area $area
     *
     * @return User
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
     * Add additionalItem
     *
     * @param \AppBundle\Entity\AdditionalItems $additionalItem
     *
     * @return User
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
     * Add surface
     *
     * @param \AppBundle\Entity\Surface $surface
     *
     * @return User
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
