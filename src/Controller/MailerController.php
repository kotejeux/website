<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Bridge\Sendgrid\Transport;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    /**
     * @Route("/email", name="mail-test")
     */
    public function send_email(MailerInterface $mailer)
    {
        $email = (new Email())
            ->from("jeanvanneste@example.com")
            ->to("jeanvanneste@gmail.com")
            ->subject("[KEJ] Créez votre mot de passe")
            ->text(bin2hex(random_bytes(10)));

        $sent_mail = $mailer->send($email);
    }
} 