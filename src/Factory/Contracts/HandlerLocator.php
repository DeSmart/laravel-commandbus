<?php namespace DeSmart\CommandBus\Factory\Contracts;

interface HandlerLocator
{
    /**
     * Retrieves the handler for a specified command
     *
     * @param string $commandName
     * @return object
     *
     * @throws \DeSmart\CommandBus\Exceptions\MissingHandlerException
     */
    public function getHandlerForCommand($commandName);
}
