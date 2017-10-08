<?php

namespace PartyPlanner\UserBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;

/**
 * Model to enable password update
 *
 * @package PartyPlanner\UserBundle\Form\Model
 */
class PasswordChange
{
    ////////////
    // Fields //
    ////////////
    /**
     * @var string
     *
     * @SecurityAssert\UserPassword(message = "Current password don't password")
     */
    private $currentPassword;

    /**
     * @var string
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
    private $newPassword;

    ///////////////
    // Accessors //
    ///////////////
    /**
     * @return string
     */
    public function getCurrentPassword() : ?string
    {
        return $this->currentPassword;
    }

    /**
     * @param string $currentPassword
     */
    public function setCurrentPassword(string $currentPassword)
    {
        $this->currentPassword = $currentPassword;
    }

    /**
     * @return string
     */
    public function getNewPassword() : ?string
    {
        return $this->newPassword;
    }

    /**
     * @param string $newPassword
     */
    public function setNewPassword(string $newPassword)
    {
        $this->newPassword = $newPassword;
    }
}