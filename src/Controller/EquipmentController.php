<?php
namespace App\Controller;

use App\Entity\Equipment;
use App\Form\EquipmentType;
use App\Repository\EquipmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EquipmentController extends AbstractController {

  /**
  * @var EntityManagerInterface
  */
  private $manager;

  public function __construct(EntityManagerInterface $manager)
  {
      $this->manager = $manager;
  }

  /**
   * @Route("/equipment", name="equipment.list")
   */
  public function list(EquipmentRepository $repository) {
    $equipments = $repository->findAll();
    return $this->render('equipment/list.html.twig', [
      'equipments' => $equipments
    ]);
  }

  /**
   * @Route("/equipment-{id}", name="equipment.view")
   */
  public function view(Equipment $equipment, Request $request) {
    
    $form = $this->createForm(EquipmentType::class, $equipment);

    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
        $this->manager->persist($equipment);
        $this->manager->flush();
        $this->addFlash('success', 'Equipement modifié avec succès');
        return $this->redirectToRoute('equipment.list');
    }

    return $this->render('equipment/form.html.twig', [
      'equipment' => $equipment,
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/equipment/create", name="equipment.create")
   */
  public function create(Request $request) {
    
    $equipment = new Equipment();
    $form = $this->createForm(EquipmentType::class, $equipment);

    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
        $equipment->getPrice() === [null, null, null];
        $equipment->setPrice([null, null, null]);
        $this->manager->persist($equipment);
        $this->manager->flush();
        $this->addFlash('success', 'Equipement créé avec succès');
        return $this->redirectToRoute('equipment.list');
    }

    return $this->render('equipment/form.html.twig', [
      'equipment' => $equipment,
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/equipment-{id}/delete", name="equipment.delete")
   */
  public function delete(Equipment $equipment) {
    $this->manager->remove($equipment);
    $this->manager->flush();
    $this->addFlash('success', 'Equipment supprimé avec succès');
    return $this->redirectToRoute('equipment.list');
  }
}