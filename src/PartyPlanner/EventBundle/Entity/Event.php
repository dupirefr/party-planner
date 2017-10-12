<?php

namespace PartyPlanner\EventBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="PartyPlanner\EventBundle\Repository\EventRepository")
 */
class Event
{
    ////////////
    // Fields //
    ////////////

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
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max = 255)
     */
    private $name;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     *
     * @Assert\DateTime()
     * @Assert\GreaterThan(
     *     value = "now UTC+1",
     *     message = "The date must happen in the future"
     * )
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     *
     * @Assert\NotBlank()
     */
    private $description;

    ///////////////
    // Accessors //
    ///////////////

    /**
     * Get id
     *
     * @return int
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Event
     */
    public function setName(string $name) : Event
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get date
     *
     * @return DateTime
     */
    public function getDate() : ?DateTime
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param DateTime $date
     *
     * @return Event
     */
    public function setDate(DateTime $date) : Event
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() : ?string
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Event
     */
    public function setDescription(string $description) : Event
    {
        $this->description = $description;

        return $this;
    }
}