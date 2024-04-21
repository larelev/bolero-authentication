<?php

namespace Bolero\Plugins\Authentication\Controllers;

use Bolero\Framework\Http\RedirectResponse;
use Bolero\Framework\Http\Response;
use Bolero\Framework\MVC\AbstractController;
use Bolero\Plugins\Authentication\Components\Authenticator;
use Bolero\Plugins\Authentication\Forms\RegistrationForm;
use Bolero\Plugins\Authentication\Repositories\UserMapper;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class RegistrationController extends AbstractController
{
    public function __construct(
        private readonly UserMapper $userMapper,
        private readonly Authenticator $authenticator,
    ) {
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(): Response
    {
        return $this->render('register.html.twig');
    }

    public function register(): Response
    {
        $form = new RegistrationForm($this->userMapper);
        $form->setFields(
            $this->request->searchFromBody('email'),
            $this->request->searchFromBody('password'),
        );

        if ($form->hasValidationErrors()) {
            foreach ($form->getValidationErrors() as $error) {
                $this->request->getFlashMessage()->setError($error);
            }

            return new RedirectResponse('/register');
        }

        $user = $form->save();

        $this->request->getFlashMessage()->setSuccess(
            'User %s created', $user->getEmail()
        );

        $this->authenticator->login($user);

        return new RedirectResponse('/dashboard');
    }

}
