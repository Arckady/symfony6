<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('admin');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('admin/security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/admin', name: 'admin')]
    public function adminStub(): Response
    {
        $respnse = new Response();
        $respnse->setContent('<h1>Это заготовка для админки из SecurityController.</h1>
         <p>По-хорошему, экшн админ панели должен быть в отдельном контроллере или генерироваться бандлом, например EasyAdmin</p>
         <p>Чтобы выйти из этого гиблого места, <a href="/logout">разлогинься</a> или <a href="/">возвращайся на сайт</a> </p>');

        return $respnse;
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): never
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
