<?php

namespace Bolero\Plugins\Authentication\Middlewares;

use Bolero\Framework\Http\HistoryInterface;
use Bolero\Framework\Http\RedirectResponse;
use Bolero\Framework\Http\Request;
use Bolero\Framework\Http\Response;
use Bolero\Framework\Middleware\MiddlewareInterface;
use Bolero\Framework\Middleware\RequestHandlerInterface;
use Bolero\Framework\Session\SessionInterface;

class Guest implements MiddlewareInterface
{
    private bool $isAuthenticated = true;

    public function __construct(
        private readonly SessionInterface $session,
        private readonly HistoryInterface $history,
    ) {
    }

    public function process(Request $request, RequestHandlerInterface $requestHandler): Response
    {
        $this->session->start();
        $this->history->set($request->getInfo());
        $lastGetRequest = $this->history->getLastGetRequest();
        $pathname = $lastGetRequest->getPathInfo();

        if ($pathname == '/login' || $pathname == '/register') {
            $pathname = '/dashboard';
        }

        if ($this->session->has(\Bolero\Plugins\Authentication\Configuration::AUTH_KEY)) {
            return new RedirectResponse($pathname);
        }

        return $requestHandler->handle($request);
    }
}
