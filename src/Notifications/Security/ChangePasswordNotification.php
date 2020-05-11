<?php
namespace App\Notifications\Security;

use Swift_Mailer;
use Twig\Environment;
use App\Entity\User;
use Swift_Message;

class ChangePasswordNotification
{
    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
    **/
    private $renderer;

    public function __construct(Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(User $user)
    {
        $message = (new Swift_Message('Dynamic Jet - Votre mot de passe a été correctement modifié'))
            ->setFrom('noreply@threasn.com')
            ->setTo($user->getEmail())
            ->setBody($this->renderer->render('emails/changePassword.html.twig', [
                'user' => $user
            ]), 'text/html')
        ;

        $this->mailer->send($message);
    }
}