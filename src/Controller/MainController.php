<?php
//Chemin depuis src
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController{
    
    /**
     * @Route("/", name="home")
     */
     public function home(){
       return $this->render('main/home.html.twig');
     }

     /**
     * @Route("/parameters", name="parameters")
     */
    public function parameters(){
      return $this->render('main/parameters.html.twig');
    }
}
?>