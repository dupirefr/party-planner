<?php

namespace PartyPlanner\UserBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="PartyPlanner\UserBundle\Repository\UserRepository")
 *
 * @UniqueEntity(fields = "username", message = "A user with this username already exists")
 * @UniqueEntity(fields = "email", message = "A user with this email already exists")
 */
class User extends Person implements UserInterface
{
    ////////////
    // Fields //
    ////////////

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=30, unique=true)
     *
     * @Assert\Length(max = 30)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     *
     * @Assert\Email()
     */
    private $email;

    /**
     * @var DateTime
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

    /////////////
    // Methods //
    /////////////

    /**
     * @return string
     */
    public function getSalt() : ?string
    {
        return null;
    }

    /**
     *
     */
    public function eraseCredentials() : void
    {
        // TODO
    }

    ///////////////
    // Accessors //
    ///////////////

    /**
     * @return string
     */
    public function getUsername() : ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return User
     */
    public function setUsername(string $username) : User
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail() : ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return User
     */
    public function setEmail(string $email) : User
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getBirthDate() : ?DateTime
    {
        return $this->birthDate;
    }

    /**
     * @param DateTime $birthDate
     *
     * @return User
     */
    public function setBirthDate(DateTime $birthDate) : User
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword() : ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword(string $password) : User
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return array
     */
    public function getRoles() : array
    {
        // TODO
        return array('ROLE_USER');
    }
}