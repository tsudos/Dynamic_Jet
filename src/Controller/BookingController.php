<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingController extends AbstractController {

  /**
  * @var EntityManagerInterface
  */
  private $manager;

  public function __construct(EntityManagerInterface $manager)
  {
      $this->manager = $manager;
  }

  /**
   * @Route("/booking", name="booking.list")
   */
  public function list(BookingRepository $repository) {
    $bookings = $repository->findAll();
    return $this->render('booking/list.html.twig', [
      'bookings' => $bookings
    ]);
  }

    /**
   * @Route("/booking-{id}", name="booking.view")
   */
  public function view(Booking $booking, Request $request) {
    
    $form = $this->createForm(BookingType::class, $booking);

    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
        $this->manager->persist($booking);
        $this->manager->flush();
        $this->addFlash('success', 'Réservation modifiée avec succès');
        return $this->redirectToRoute('booking.list');
    }

    return $this->render('booking/form.html.twig', [
      'booking' => $booking,
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/booking/create", name="booking.create")
   */
  public function create(Request $request) {
    
    $booking = new Booking();
    $form = $this->createForm(BookingType::class, $booking);

    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
        $booking->setBookingDate(new \DateTime());
        $this->manager->persist($booking);
        $this->manager->flush();
        $this->addFlash('success', 'Booking créé avec succès');
        return $this->redirectToRoute('booking.list');
    }

    return $this->render('booking/form.html.twig', [
      'booking' => $booking,
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/booking-{id}/delete", name="booking.delete")
   */
  public function delete(Booking $booking) {
    $this->manager->remove($booking);
    $this->manager->flush();
    $this->addFlash('success', 'Réservation supprimé avec succès');
    return $this->redirectToRoute('booking.list');
  }
}