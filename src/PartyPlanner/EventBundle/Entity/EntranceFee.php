<?php

namespace PartyPlanner\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntranceFee
 *
 * @ORM\Table(name="entrance_fee")
 * @ORM\Entity(repositoryClass="PartyPlanner\EventBundle\Repository\EntranceFeeRepository")
 */
class EntranceFee
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
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="entranceFees")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $event;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var double
     *
     * @ORM\Column(name="price", type="decimal")
     */
    private $price;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event): void
    {
        $this->event = $event;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return EntranceFee
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price.
     *
     * @param double $price
     *
     * @return EntranceFee
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return double
     */
    public function getPrice()
    {
        return $this->price;
    }
}
