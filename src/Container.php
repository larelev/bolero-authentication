<?php

namespace Bolero\Plugins\Authentication;

use Bolero\Framework\Plugin\PluginContainerInterface;
use Bolero\Framework\Session\SessionInterface;
use Bolero\Plugins\Authentication\Components\Authenticator;
use Bolero\Plugins\Authentication\Repositories\UserRepository;
use League\Container\DefinitionContainerInterface;

class Container implements PluginContainerInterface
{

    public static function provide(DefinitionContainerInterface $container): DefinitionContainerInterface
    {
        $container->add(Authenticator::class)
            ->addArguments([
                UserRepository::class,
                SessionInterface::class,
            ]);

        return $container;
    }
}
