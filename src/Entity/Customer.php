<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Erreur, pas assez de caractères",
     *      maxMessage = "Erreur, trop de caractères"
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre nom ne peut contenir de nombre"
     * )
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Erreur, pas assez de caractères",
     *      maxMessage = "Erreur, trop de caractères"
     * )
     * @Assert\NotNull
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre nom ne peut contenir de nombre"
     * )
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=150)
     *  @Assert\Length(
     *      min = 2,
     *      max = 150,
     *      minMessage = "Erreur, pas assez de caractères",
     *      maxMessage = "Erreur, trop de caractères"
     * )
     * @Assert\NotNull
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)    
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Erreur, pas assez de caractères",
     *      maxMessage = "Erreur, trop de caractères"
     * )
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Erreur, pas assez de caractères",
     *      maxMessage = "Erreur, trop de caractères"
     * )
     * @Assert\NotNull
     */
    private $phone;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birth_date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Erreur, pas assez de caractères",
     *      maxMessage = "Erreur, trop de caractères"
     * )
     */
    private $coastal_license;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $reduction;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="customer", orphanRemoval=true)
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(?\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getCoastalLicense(): ?string
    {
        return $this->coastal_license;
    }

    public function setCoastalLicense(?string $coastal_license): self
    {
        $this->coastal_license = $coastal_license;

        return $this;
    }

    public function getReduction(): ?int
    {
        return $this->reduction;
    }

    public function setReduction(?int $reduction): self
    {
        $this->reduction = $reduction;

        return $this;
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
            $booking->setCustomer($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            // set the owning side to null (unless already changed)
            if ($booking->getCustomer() === $this) {
                $booking->setCustomer(null);
            }
        }

        return $this;
    }

    
}
