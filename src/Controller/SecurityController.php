<?php

namespace App\Controller;

use App\Entity\User;
use Swift_Mailer;
use App\Entity\ChangePassword;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Notifications\Security\ChangePasswordNotification;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Twig\Environment;


class SecurityController extends AbstractController
{
    //Attributs
    private $manager;

    //Déclaration du constructor, il initialise les attributs de l'objet, il est appelé en premier
    public function __construct(EntityManagerInterface $manager, Environment $renderer){
        $this->manager = $manager;
        $this->renderer = $renderer;
    }

    /**
     * @Route ("/change-password", name="change-password")
     */
    public function changePassword(Request $request, UserPasswordEncoderInterface $passwordEncoder, ChangePasswordNotification $notification) {
        $changePassword = new ChangePassword();
        $form = $this->createForm(ChangePasswordType::class, $changePassword);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->getUser()->setPassword($passwordEncoder->encodePassword($this->getUser(), $changePassword->getNewPassword()));
            $this->manager->persist($this->getUser());
            $this->manager->flush($this->getUser());
            $notification->notify($this->getUser());
            $this->addFlash('success', 'Votre mot de passe a été modifié avec success');
            return $this->redirectToRoute('parameters');
        }

        return $this->render('security/change-password.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/connexion", name="security_login")
     *
     */
    public function login(AuthenticationUtils $authentication) {
        $error= $authentication->getLastAuthenticationError();
        $lastusername= $authentication->getLastUsername();

        return $this->render('security/login.html.twig', [
            'error'=>$error,
            'lastusername'=>$lastusername
        ]); 
    }

    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout() {

    }


     /**
     * @Route("/motdepasse-oublie", name="security_forgot")
     */
    public function forgottenPassword(Request $request, UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator
    )
    {

        if ($request->isMethod('POST')) {

            $email = $request->request->get('email');

            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneBy(array('email' => $email));
            /* @var $user User */

            if ($user === null) {
                $this->addFlash('danger', 'Email Inconnu');
                return $this->redirectToRoute('security_login');
            }
            $token = $tokenGenerator->generateToken();

            try{
                $user->setResetToken($token);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
                return $this->redirectToRoute('security_login');
            }

            $url = $this->generateUrl('reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

            $message = (new \Swift_Message('Mot de passe oublié'))
                ->setFrom('christine.toval@jetski.com')
                ->setTo($user->getEmail())
                ->setBody($this->renderer->render('emails/modifPassword.html.twig', [
                    'url' => $url
                ]), 'text/html');
            $mailer->send($message);

            $this->addFlash('success', 'Votre mail de réinitialisation vous a bien été envoyé ! ');

            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/forgotten_password.html.twig');
    }

    /**
     * @Route("/reset_password/{token}", name="reset_password")
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {

        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->getRepository(User::class)->findOneByResetToken($token);
            /* @var $user User */

            if ($user === null) {
                $this->addFlash('danger', 'Token Inconnu');
                return $this->redirectToRoute('security_login');
            }

            $user->setResetToken(null);
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            $entityManager->flush();

            $this->addFlash('success', 'C\'est parfait, votre nouveau mot de passe a bien été enregistré ! ');

            return $this->redirectToRoute('security_login');
        }else {

            return $this->render('security/reset_password.html.twig', ['token' => $token]);
        }

    }
}
