<?php namespace DeSmart\CommandBus\Contracts;

interface CommandBus
{
    /**
     * Executes the given command and optionally returns a value
     *
     * @param object $command
     * @return mixed
     */
    public function handle($command);
}
