<?php

//Repère de l'emplacement du controller
namespace App\Controller;

use App\Entity\User;
use App\Form\StaffType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

//AbstractController permet l'acces à la methode render
class StaffController extends AbstractController{

    //Attributs
    private $manager;

    //Déclaration du constructor, il initialise les attributs de l'objet, il est appelé en premier
    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }




    //Annotations pour la route
    /**
     * @Route("/staff", name="staff")
     */

     public function Staff( UserRepository $userRepository){

        $listUser = $userRepository->findAll();
        
         return $this->render('staff/staff.html.twig', [
             'users' => $listUser
         ]);
     }

     //Annotations pour la route
    /**
     * @Route("/staff-{id}", name="staff.detail")
     */
     public function view (User $user, Request $request){

        //Je prends la bonne classe de formulaire, ici StaffType
        $form = $this->createForm(StaffType::class, $user);

        //Modification du formulaire
        $form->handleRequest($request);
            
        if($form->isSubmitted() && $form->isValid()){
            $this->manager->persist($user);
            $this->manager->flush();
            $this->addFlash('success','Les informations ont étés modifiées avec succès');
            return $this->redirectToRoute('staff');
        }

        return $this->render('staff/detail.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
     }

     //Fonction d'ajout d'un nouveau membre
     /**
      * @Route ("/staff/create", name="staff.create")
      */

      public function create(Request $request, UserPasswordEncoderInterface $encoder) {

        $user = new User();
        $form = $this->createForm(StaffType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, 'password');
            $user->setPassword($hash);
            $this->manager->persist($user);
            $this->manager->flush();
            $this->addFlash('success', 'La creation a été éffectuée avec succès !');
            return $this->redirectToRoute('staff');
        }

        //Je retourne la vue voulu
        return $this->render('staff/detail.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
      }

      /**
     * @Route("/staff-{id}/delete", name="staff.delete")
     */
      public function delete(User $user){
          
        $this->manager->remove($user);
        //J'execute avec flush
        $this->manager->flush();
        $this->addFlash('success', 'Le membre a été supprimé avec succès'); 
        return $this->redirectToRoute('staff');
      }
}
?>