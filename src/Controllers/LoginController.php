<?php

namespace Bolero\Plugins\Authentication\Controllers;

use Bolero\Framework\Http\RedirectResponse;
use Bolero\Framework\Http\Response;
use Bolero\Framework\MVC\AbstractController;
use Bolero\Plugins\Authentication\Components\Authenticator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class LoginController extends AbstractController
{
    public function __construct(private readonly Authenticator $authenticator)
    {
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(): Response
    {
        return $this->render('login.html.twig');
    }

    public function login(): Response
    {
        $isAuthenticated = $this->authenticator->authenticate(
            $this->request->searchFromBody('email'),
            $this->request->searchFromBody('password'),
        );

        if (!$isAuthenticated) {
            $this->request->getFlashMessage()->setError('Bad credentials.');
            return new RedirectResponse('/login');
        }

        $user = $this->authenticator->getUser();
        $this->request->getFlashMessage()->setSuccess('You are now logged in.');

        return new RedirectResponse('/dashboard');
    }

    public function logout(): Response
    {
        $this->authenticator->logout();
        $this->request->getFlashMessage()->setSuccess('See you soon!');

        return new RedirectResponse('/');
    }

}
