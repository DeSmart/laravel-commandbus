<?php namespace DeSmart\CommandBus;

use DeSmart\CommandBus\Contracts\CommandBus as CommandBusInterface;
use Illuminate\Contracts\Container\Container;

class CommandBus implements CommandBusInterface
{
    /**
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function handle($command)
    {
        $class_name = $this->getClassName($command);
        $validator = $this->getValidatorForCommand($class_name);

        if (null !== $validator) {
            $validator->validate($command);
        }

        $handler = $this->getHandlerForCommand($class_name);

        return $handler->handle($command);
    }

    /**
     * Retrieves the validator for a specified command
     *
     * @param $command
     * @return Object
     */
    protected function getValidatorForCommand($command)
    {
        $factory = $this->app->make('DeSmart\CommandBus\Factory\Contracts\ValidatorLocator');

        return $factory->getValidatorForCommand($command);
    }

    /**
     * Retrieves the handler for a specified command
     *
     * @param $command
     * @return null|Object
     */
    protected function getHandlerForCommand($command)
    {
        $factory = $this->app->make('DeSmart\CommandBus\Factory\Contracts\HandlerLocator');

        return $factory->getHandlerForCommand($command);
    }

    /**
     * Extract the name from a command
     *
     * @param $command
     * @return string
     */
    protected function getClassName($command)
    {
        $extractor = $this->app->make('DeSmart\CommandBus\Extractor\Contracts\CommandNameExtractor');

        return $extractor->extract($command);
    }
}
