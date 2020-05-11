<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $bookingDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Equipment", inversedBy="bookings")
     */
    private $equipments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $timeRange;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="bookings")
     */
    private $staffs;

    public function __construct()
    {
        $this->equipments = new ArrayCollection();
        $this->staffs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookingDate(): ?\DateTimeInterface
    {
        return $this->bookingDate;
    }

    public function setBookingDate(\DateTimeInterface $bookingDate): self
    {
        $this->bookingDate = $bookingDate;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @return Collection|Equipment[]
     */
    public function getEquipments(): Collection
    {
        return $this->equipments;
    }

    public function addEquipment(Equipment $equipment): self
    {
        if (!$this->equipments->contains($equipment)) {
            $this->equipments[] = $equipment;
        }

        return $this;
    }

    public function removeEquipment(Equipment $equipment): self
    {
        if ($this->equipments->contains($equipment)) {
            $this->equipments->removeElement($equipment);
        }

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getTimeRange(): ?string
    {
        return $this->timeRange;
    }

    public function setTimeRange(string $timeRange): self
    {
        $this->timeRange = $timeRange;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getStaffs(): Collection
    {
        return $this->staffs;
    }

    public function addStaff(User $staff): self
    {
        if (!$this->staffs->contains($staff)) {
            $this->staffs[] = $staff;
        }

        return $this;
    }

    public function removeStaff(User $staff): self
    {
        if ($this->staffs->contains($staff)) {
            $this->staffs->removeElement($staff);
        }

        return $this;
    }
}
