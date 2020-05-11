<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;

class ChangePassword
{
    /**
     * @var string
     * @SecurityAssert\UserPassword(
     *  message = "Le mot de passe n'est pas valide"
     * )
     */
    private $oldPassword;

    /**
     * @var string
     * @Assert\Length(min=7)
     */
    private $newPassword;

    /**
     * Get the value of oldPassword
     *
     * @return  string
     */ 
    public function getOldPassword()
    {
        return $this->oldPassword;
    }

    /**
     * Set the value of oldPassword
     *
     * @param  string  $oldPassword
     *
     * @return  self
     */ 
    public function setOldPassword(string $oldPassword)
    {
        $this->oldPassword = $oldPassword;

        return $this;
    }

    /**
     * Get the value of newPassword
     *
     * @return  string
     */ 
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * Set the value of newPassword
     *
     * @param  string  $newPassword
     *
     * @return  self
     */ 
    public function setNewPassword(string $newPassword)
    {
        $this->newPassword = $newPassword;

        return $this;
    }
}