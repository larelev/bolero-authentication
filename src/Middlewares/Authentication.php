<?php

namespace Bolero\Plugins\Authentication\Middlewares;

use Bolero\Framework\Http\RedirectResponse;
use Bolero\Framework\Http\Request;
use Bolero\Framework\Http\Response;
use Bolero\Framework\Middleware\MiddlewareInterface;
use Bolero\Framework\Middleware\RequestHandlerInterface;
use Bolero\Framework\Session\SessionInterface;
use Bolero\Plugins\FlashMessage\FlashMessageInterface;

class Authentication implements MiddlewareInterface
{
    private bool $isAuthenticated = true;

    public function __construct(
        private readonly SessionInterface $session,
        private readonly FlashMessageInterface $flashMessage,
    ) {
    }

    public function process(Request $request, RequestHandlerInterface $requestHandler): Response
    {
        $this->session->start();
        if (!$this->session->has(\Bolero\Plugins\Authentication\Authentication::AUTH_KEY)) {
            $this->flashMessage->setError('Please sign in.');
            return new RedirectResponse("/login");
        }

        return $requestHandler->handle($request);
    }
}
