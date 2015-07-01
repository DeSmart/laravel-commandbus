<?php namespace DeSmart\CommandBus;

use DeSmart\CommandBus\Commands\LocatorHandlerFactory;
use Illuminate\Bus\Dispatcher;
use Illuminate\Container\Container;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            'DeSmart\CommandBus\Commands\Contracts\CommandBus',
            'DeSmart\CommandBus\Commands\CommandBus'
        );

        $this->app->bind(
            'DeSmart\CommandBus\Commands\Factory\Contracts\HandlerLocator',
            'DeSmart\CommandBus\Commands\Factory\HandlerLocatorFactory'
        );

        $this->app->bind(
            'DeSmart\CommandBus\Commands\Factory\Contracts\ValidatorLocator',
            'DeSmart\CommandBus\Commands\Factory\ValidatorLocatorFactory'
        );

        $this->app->bind(
            'DeSmart\CommandBus\Commands\Extractor\Contracts\CommandNameExtractor',
            'DeSmart\CommandBus\Commands\Extractor\ClassNameExtractor'
        );
    }
}
