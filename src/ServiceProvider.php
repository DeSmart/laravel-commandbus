<?php namespace DeSmart\CommandBus;

use DeSmart\CommandBus\Contracts\CommandBus as CommandBusInterface;
use DeSmart\CommandBus\Factory\Contracts\HandlerLocator;
use DeSmart\CommandBus\Factory\HandlerLocatorFactory;
use DeSmart\CommandBus\Factory\Contracts\ValidatorLocator;
use DeSmart\CommandBus\Factory\ValidatorLocatorFactory;
use DeSmart\CommandBus\Extractor\Contracts\CommandNameExtractor;
use DeSmart\CommandBus\Extractor\ClassNameExtractor;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            CommandBusInterface::class,
            CommandBus::class
        );

        $this->app->bind(
            HandlerLocator::class,
            HandlerLocatorFactory::class
        );

        $this->app->bind(
            ValidatorLocator::class,
            ValidatorLocatorFactory::class
        );

        $this->app->bind(
            CommandNameExtractor::class,
            ClassNameExtractor::class
        );
    }
}
