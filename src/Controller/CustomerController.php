<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CustomerController extends AbstractController
{

    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

    /**
     * @Route("/customer", name="customer")
     */
    public function index(CustomerRepository $repo)
    {
        /*grace au parametre CustomerRepository $repo =>
        $repo = $this->getDoctrine()->getRepository(Customer::class);*/

        $customers = $repo->findAll();
        return $this->render('customer/index.html.twig', [
            'controller_name' => 'CustomerController', 'customers' => $customers
        ]);
    }

    /**
     * @Route("/customer/{id}/edit", name="customer_edit")
     */
    public function view(Customer $customer, Request $request) {
        $form= $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->manager->persist($customer);
            $this->manager->flush();
            $this->addFlash('success', 'Client modifié avec succès');
            return $this->redirectToRoute('customer');
        }
        return $this->render('customer/create.html.twig', [
            'formCustomer' => $form->createView(),
            'customer' => $customer
        ]);
    }

        /**
     * @Route("/customer/create", name="customer_create")
     */
    public function create(Request $request) {
        $customer = new Customer();
        $form= $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $customer->setReduction(0);
            $this->manager->persist($customer);
            $this->manager->flush();
            $this->addFlash('success', 'Client créé avec succès');
            return $this->redirectToRoute('customer');
        }
        return $this->render('customer/create.html.twig', [
            'formCustomer' => $form->createView(),
            'customer' => $customer
        ]);
    }

    /**
     * @Route("/customer/{id}/delete", name="customer_delete")
     */
    public function delete(Customer $customer) {
        $this->manager->remove($customer);
        $this->manager->flush();
        $this->addFlash('success', 'Client supprimé avec succès');
        return $this->redirectToRoute('customer');
    }
}