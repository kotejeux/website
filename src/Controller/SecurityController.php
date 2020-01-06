<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CreateUserType;
use App\Controller\MailerController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;


class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Redirect to homepage if user is already logged in
        if ($this->getUser()) {
            return $this->redirectToRoute('index');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/user/new", name="create_user")
     */
    public function createUser(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();

        $form = $this->createForm(CreateUserType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $user = $form->getData();

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    bin2hex(random_bytes(64))
                )
            );
            $token = $user->setConnectionToken(bin2hex(random_bytes(10)));
            
            $entityManager->persist($user);
            $entityManager->flush();

            $this->send_authentication_email($user->getEmail(), $user->getConnectionToken());
        } 

        return $this->render('user/new.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
    }

    /**
     * @Route("/user/test")
     */
    public function test_user_routing(){
        return $this->render("test_page.html.twig");
    }

    private function send_authentication_email(String $email, String $connection_token)
    {
        $transport = Transport::fromDsn($_SERVER["MAILER_DSN"]);
        $mailer = new Mailer($transport);
        $email = (new Email())
            ->from("noreply@kotejeux.be")
            ->to($email)
            ->subject("[KEJ] Créez votre mot de passe")
            ->text($connection_token);
        
        $sent_mail = $mailer->send($email);
    }

}