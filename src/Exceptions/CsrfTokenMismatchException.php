<?php

namespace Bolero\Plugins\Authentication\Exceptions;

use Bolero\Framework\Http\Exceptions\HttpException;
use Bolero\Framework\Http\HttpStatusCodeEnum;
use Throwable;

class CsrfTokenMismatchException extends HttpException
{
    public function __construct(null | Throwable $previous = null)
    {
        parent::__construct(
            'Your request could not be validated. Please try again.',
            HttpStatusCodeEnum::FORBIDDEN_ACCESS,
            $previous,
        );
    }
}
