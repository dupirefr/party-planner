<?php

namespace PartyPlanner\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="PartyPlanner\UserBundle\Repository\PersonRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"person" = "Person", "user" = "User"})
 */
class Person
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
     * @ORM\Column(name="firstName", type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(max = 50)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(max = 50)
     */
    private $lastName;

    ///////////////
    // Accessors //
    ///////////////

    /**
     * @return int
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Person
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName() : ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return Person
     */
    public function setFirstName($firstName) : Person
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName() : ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return Person
     */
    public function setLastName($lastName) : Person
    {
        $this->lastName = $lastName;

        return $this;
    }
}
