<?php

namespace PartyPlanner\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="PartyPlanner\UserBundle\Repository\UserRepository")
 *
 * @UniqueEntity(fields = "email", message = "A user with this email already exists")
 */
class User extends Person
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
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     *
     * @Assert\Email()
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthDate", type="datetime", nullable=true)
     *
     * @Assert\Date()
     */
    private $birthDate;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=60)
     *
     * @Assert\Length(min = 8, max=72)
     * @Assert\Regex(
     * pattern = "/[0-9]/",
     * message = "Your password must contain at least a digit."
     * )
     * @Assert\Regex(
     * pattern = "/[A-Z]/",
     * message = "Your password must contain at least a capital letter."
     * )
     * @Assert\Regex(
     * pattern = "/[^a-zA-Z0-9]/",
     * message = "Your password must contain at least a special character."
     * )
     */
    private $password;


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
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return User
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}
