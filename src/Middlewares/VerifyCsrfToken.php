<?php

namespace Bolero\Plugins\Authentication\Middlewares;

use Bolero\Framework\Http\Request;
use Bolero\Framework\Http\Response;
use Bolero\Framework\Middleware\MiddlewareInterface;
use Bolero\Framework\Middleware\RequestHandlerInterface;
use Bolero\Framework\Session\Session;
use Bolero\Plugins\Authentication\Exceptions\CsrfTokenMismatchException;

class VerifyCsrfToken implements MiddlewareInterface
{

    public function process(Request $request, RequestHandlerInterface $requestHandler): Response
    {
        if ($request->getMethod() == 'GET') {
            return $requestHandler->handle($request);
        }

        $session = $request->getSession();

        $sessionToken = $session->read(Session::CSRF_TOKEN) ?? '';
        $formToken = $request->searchFromBody(Session::CSRF_TOKEN);

        if (!hash_equals($sessionToken, $formToken)) {
            throw new CsrfTokenMismatchException();
        }

        return $requestHandler->handle($request);
    }
}
