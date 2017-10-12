<?php

namespace PartyPlanner\UserBundle\Entity;

use DateTime;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

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

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="PartyPlanner\UserBundle\Entity\Role", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $roles;

    ////////////////
    // Controller //
    ////////////////

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    /////////////
    // Methods //
    /////////////

    /**
     * Get salt
     *
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
     * Get username
     *
     * @return string
     */
    public function getUsername() : ?string
    {
        return $this->username;
    }

    /**
     * Set username
     *
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
     * Get email
     *
     * @return string
     */
    public function getEmail() : ?string
    {
        return $this->email;
    }

    /**
     * Set email
     *
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
     * Get birth date
     *
     * @return DateTime
     */
    public function getBirthDate() : ?DateTime
    {
        return $this->birthDate;
    }

    /**
     * Set birth date
     *
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
     * Get password
     *
     * @return string
     */
    public function getPassword() : ?string
    {
        return $this->password;
    }

    /**
     * Set password
     *
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
     * Get roles
     *
     * @return array
     */
    public function getRoles() : array
    {
        $role = new Role();
        return $this->roles->map([$role, 'getName'])->toArray();
    }

    /**
     * Add role
     *
     * @param Role $role
     *
     * @return User
     */
    public function addRole(Role $role) : User
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param Role $role
     *
     * @return User
     */
    public function removeRole(Role $role) : User
    {
        $this->roles->removeElement($role);

        return $this;
    }
}
