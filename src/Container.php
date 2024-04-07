<?php

namespace Bolero\Plugins\Authentication;

use Bolero\Framework\Plugin\PluginContainerInterface;
use League\Container\DefinitionContainerInterface;

class Container implements PluginContainerInterface
{

    public static function provide(DefinitionContainerInterface $container): DefinitionContainerInterface
    {
        $container->add(\Bolero\Plugins\Authentication\Components\Authenticator::class)
            ->addArguments([
                \Bolero\Plugins\Authentication\Repositories\UserRepository::class,
                \Bolero\Framework\Session\SessionInterface::class,
            ]);

        return $container;
    }
}
