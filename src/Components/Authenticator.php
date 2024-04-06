<?php

namespace Bolero\Plugins\Authentication\Components;

use Bolero\Framework\Session\SessionInterface;
use Bolero\Plugins\Authentication\Authentication;
use Bolero\Plugins\Authentication\Repositories\AuthenticationRepositoryInterface;

class Authenticator implements AuthenticatorInterface
{
    private AuthenticationInterface $user;

    public function getUser(): AuthenticationInterface
    {
        return $this->user;
    }

    public function __construct(
        private readonly AuthenticationRepositoryInterface $userRepository,
        private readonly SessionInterface $session,
    ) {
    }

    public function authenticate(string $email, string $password): bool
    {
        $user = $this->userRepository->findByEmail($email);

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user->getPassword())) {
            return false;
        }

        $this->login($user);

        return true;
    }

    public function login(AuthenticationInterface $user): void
    {
        $this->session->start();
        $this->session->write(Authentication::AUTH_KEY, $user->getAuthId());
        $this->user = $user;
    }

    public function logout(): void
    {
        $this->session->remove(Authentication::AUTH_KEY);
    }

    public function isAuthenticated(): bool
    {
        return $this->session->has(Authentication::AUTH_KEY);
    }

    public static function hasLoggedIn(SessionInterface $session): bool
    {
        $auth = $session->has(Authentication::AUTH_KEY);
        return $auth;
    }

}
