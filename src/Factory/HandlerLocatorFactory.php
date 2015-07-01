<?php namespace DeSmart\CommandBus\Factory;

use DeSmart\CommandBus\Exceptions\MissingHandlerException;
use DeSmart\CommandBus\Factory\Contracts\HandlerLocator;
use Illuminate\Contracts\Container\Container;

class HandlerLocatorFactory implements HandlerLocator
{
    /**
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    /**
     * Retrieves the handler for a specified command
     *
     * @param string $commandName
     * @return object
     *
     * @throws \DeSmart\CommandBus\Exceptions\MissingHandlerException
     */
    public function getHandlerForCommand($commandName)
    {
        $class_name = sprintf('%sHandler', $commandName);

        if (false === class_exists($class_name)) {
            throw new MissingHandlerException("Class $class_name does not exist!");
        }

        return $this->app->make($class_name);
    }
}
