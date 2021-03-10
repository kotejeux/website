<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CreateUserType;
use App\Form\UserConfirmationType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
     * @Route("/api/login", name="loginAPI", methods={"POST"})
     */
    public function APIlogin(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        if ($this->getUser()) {
            $user = $this->getUser();

            return $this->json("authenticated");
        } else {
            $error = $authenticationUtils->getLastAuthenticationError();
            $lastUsername = $authenticationUtils->getLastUsername();

            return $this->json([
                "error" => $error,
                "lastUsername" => $lastUsername,
            ]);
        }
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
        if ($form->isSubmitted() && $form->isValid()) {
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

        return $this->render('user/new.html.twig', [
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
    public function test_user_routing()
    {
        return $this->render("test_page.html.twig");
    }

    /**
     * @Route("/user/confirm/{security_token}", name="userConfirmation")
     */
    public function confirm_user(Request $request, UserPasswordEncoderInterface $passwordEncoder, String $security_token)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        $user = $repository->findOneBy(["connectionToken" => $security_token]);

        $entityManager = $this->getDoctrine()->getManager();

        $userInfo = new User();

        $form = $this->createForm(UserConfirmationType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userInfo = $form->getData();

            if ($userInfo->getPassword() == $form->get("confirm_password")->getData()) {
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $userInfo->getPassword()
                    )

                );
                $user->setConnectionToken(null);

                $entityManager->persist($user);
                $entityManager->flush();
            } else {
                return $this->render('user/password.html.twig', [
                    'username' => $user->getUsername(),
                    'form' => $form->createView(),
                    'error' => "Les mots de passe ne correspondent pas.",
                ]);
            }
        }

        return $this->render('user/password.html.twig', [
            'username' => $user->getUsername(),
            'form' => $form->createView(),
        ]);
    }

    private function send_authentication_email(String $email, String $connection_token)
    {
        $transport = Transport::fromDsn($_SERVER["MAILER_DSN"]);
        $mailer = new Mailer($transport);
        $email = (new TemplatedEmail())
            ->from("noreply@kotejeux.be")
            ->to(new Address($email))
            ->subject("[KEJ] Créez votre mot de passe")
            ->html('
                <h1>Create your password</h1>

                <p>Someone created an account for this email address</p>

                <p>
                    If it was you, you can set your password on clicking the following <a href=http://localhost:8000/user/confirm/' . $connection_token . '>link</a>.
                </p>
                <p>
                    If the link doesn\'t work, copy paste in your browser.
                    <code>http://localhost:8000/user/confirm/' . $connection_token . '</code>
                </p>
                <p>
                    If it wasn\'t you, you can ignore this email
                </p>
            ');

        $sent_mail = $mailer->send($email);
    }

}
