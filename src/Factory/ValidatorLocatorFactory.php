<?php namespace DeSmart\CommandBus\Factory;

use DeSmart\CommandBus\Factory\Contracts\ValidatorLocator;
use Illuminate\Contracts\Container\Container;

class ValidatorLocatorFactory implements ValidatorLocator
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
     * Retrieves the validator for a specified command
     *
     * @param string $commandName
     * @return null|object
     */
    public function getValidatorForCommand($commandName)
    {
        $class_name = sprintf('%sValidator', $commandName);

        if (false === class_exists($class_name)) {
            return null;
        }

        return $this->app->make($class_name);
    }
}
