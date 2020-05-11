<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 * "email",
 * message= "L'email que vous avez indiqué existe déjà !"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string le token qui servira lors de l'oubli de mot de passe
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $resetToken;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8",minMessage="Votre mot de passe doit fait minimum 8 caractères")
     */
    private $password;

     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ss_number;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $hiring_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $me_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coastal_licence;

    /**
     * @ORM\Column(type="boolean")
     */
    private $bees;

   /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contract_type;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Booking", mappedBy="staffs")
     */
    private $bookings;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUsername()
    {
        return null;
    }
    
    public function getSsNumber(): ?string
    {
        return $this->ss_number;
    }

    public function setSsNumber(?string $ss_number): self
    {
        $this->ss_number = $ss_number;

        return $this;
    }

    public function getHiringDate(): ?\DateTimeInterface
    {
        return $this->hiring_date;
    }

    public function setHiringDate(?\DateTimeInterface $hiring_date): self
    {
        $this->hiring_date = $hiring_date;

        return $this;
    }

    public function getMeDate(): ?\DateTimeInterface
    {
        return $this->me_date;
    }

    public function setMeDate(?\DateTimeInterface $me_date): self
    {
        $this->me_date = $me_date;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCoastalLicence(): ?string
    {
        return $this->coastal_licence;
    }

    public function setCoastalLicence(?string $coastal_licence): self
    {
        $this->coastal_licence = $coastal_licence;

        return $this;
    }

    public function getContractType(): ?string
    {
        return $this->contract_type;
    }

    public function setContractType(string $contract_type): self
    {
        $this->contract_type = $contract_type;

        return $this;
    }
   
    public function getBees(): ?bool
    {
        return $this->bees;
    }

    public function setBees(bool $bees): self
    {
        $this->bees = $bees;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getResetToken(): string
    {
        return $this->resetToken;
    }

    /**
     * @param string $resetToken
     */
    public function setResetToken(?string $resetToken): void
    {
        $this->resetToken = $resetToken;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
    
        return array_unique($roles);
    }
    
    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt(){
        return null;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials(){

    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->addStaff($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            $booking->removeStaff($this);
        }

        return $this;
    }
}
