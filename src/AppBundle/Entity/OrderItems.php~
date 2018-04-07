<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderItems
 *
 * @ORM\Table(name="order_items")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderItemsRepository")
 */
class OrderItems
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
     * @var \DateTime
     *
     * @ORM\Column(name="Created", type="datetime")
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="Job", type="string", length=255)
     */
    private $job;

    /**
     * @var string
     *
     * @ORM\Column(name="Item", type="string", length=255)
     */
    private $item;

    /**
     * @var string
     *
     * @ORM\Column(name="Supplier", type="string", length=255)
     */
    private $supplier;

    /**
     * @var string
     *
     * @ORM\Column(name="Quantity", type="string", length=255)
     */
    private $quantity;


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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return OrderItems
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set job
     *
     * @param string $job
     *
     * @return OrderItems
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set item
     *
     * @param string $item
     *
     * @return OrderItems
     */
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return string
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set supplier
     *
     * @param string $supplier
     *
     * @return OrderItems
     */
    public function setSupplier($supplier)
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * Get supplier
     *
     * @return string
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

    /**
     * Set quantity
     *
     * @param string $quantity
     *
     * @return OrderItems
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}
