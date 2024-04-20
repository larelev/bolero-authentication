<?php

namespace Bolero\Plugins\Authentication;

use Bolero\Framework\Plugin\AbstractPluginConfiguration;
use Bolero\Framework\Plugin\PluginConfigurationInterface;

class Configuration extends AbstractPluginConfiguration implements PluginConfigurationInterface
{
    public const AUTH_KEY = 'auth_id';

    public static function getNamespace(): string
    {
        return __NAMESPACE__;
    }

    public static function viewsPath(): string
    {
        return parent::getViewsPath(__DIR__);
    }

    public static function routes(): void
    {
        parent::getRoutes(__DIR__);
    }

    public static function commandsLocation(): array
    {
        return parent::getCommandsLocation(__DIR__, __NAMESPACE__);
    }
}
