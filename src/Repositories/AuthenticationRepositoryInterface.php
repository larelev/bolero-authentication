<?php

namespace Bolero\Plugins\Authentication\Repositories;

use Bolero\Plugins\Authentication\Components\AuthenticationInterface;

interface AuthenticationRepositoryInterface
{
    public function findByEmail(string $email): ?AuthenticationInterface;
}
