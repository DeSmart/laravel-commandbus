<?php namespace spec\DeSmart\CommandBus;

use DeSmart\CommandBus\Extractor\Contracts\CommandNameExtractor;
use DeSmart\CommandBus\Factory\Contracts\HandlerLocator;
use DeSmart\CommandBus\Factory\Contracts\ValidatorLocator;
use DeSmart\CommandBus\Stubs\RegisterUserCommand;
use DeSmart\CommandBus\Stubs\RegisterUserCommandHandler;
use DeSmart\CommandBus\Stubs\RegisterUserCommandValidator;
use Illuminate\Contracts\Container\Container;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommandBusSpec extends ObjectBehavior
{
    public function let(Container $app)
    {
        $this->beConstructedWith($app);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('DeSmart\CommandBus\CommandBus');
        $this->shouldImplement('DeSmart\CommandBus\Contracts\CommandBus');
    }

    public function it_should_make_handler_and_validator(
        Container $app,
        RegisterUserCommand $command,
        RegisterUserCommandHandler $handler,
        RegisterUserCommandValidator $validator,
        HandlerLocator $handlerLocator,
        ValidatorLocator $validatorLocator,
        CommandNameExtractor $commandNameExtractor
    ) {
        $app->make('DeSmart\CommandBus\Factory\Contracts\ValidatorLocator')
            ->willReturn($validatorLocator);
        $app->make('DeSmart\CommandBus\Factory\Contracts\HandlerLocator')
            ->willReturn($handlerLocator);
        $app->make('DeSmart\CommandBus\Extractor\Contracts\CommandNameExtractor')
            ->willReturn($commandNameExtractor);

        $command_name = 'ExampleName';

        $commandNameExtractor->extract($command)->willReturn($command_name);
        $validatorLocator->getValidatorForCommand($command_name)->willReturn($validator);
        $handlerLocator->getHandlerForCommand($command_name)->willReturn($handler);

        $validator->validate($command)->shouldBeCalled();
        $handler->handle($command)->shouldBeCalled();

        $this->handle($command);
    }

    public function it_should_make_only_handler(
        Container $app,
        RegisterUserCommand $command,
        RegisterUserCommandHandler $handler,
        HandlerLocator $handlerLocator,
        ValidatorLocator $validatorLocator,
        CommandNameExtractor $commandNameExtractor
    ) {
        $app->make('DeSmart\CommandBus\Factory\Contracts\ValidatorLocator')
            ->willReturn($validatorLocator);
        $app->make('DeSmart\CommandBus\Factory\Contracts\HandlerLocator')
            ->willReturn($handlerLocator);
        $app->make('DeSmart\CommandBus\Extractor\Contracts\CommandNameExtractor')
            ->willReturn($commandNameExtractor);

        $command_name = 'ExampleName';

        $commandNameExtractor->extract($command)->willReturn($command_name);
        $validatorLocator->getValidatorForCommand($command_name)->willReturn(null);
        $handlerLocator->getHandlerForCommand($command_name)->willReturn($handler);

        $handler->handle($command)->shouldBeCalled();
        $this->handle($command);
    }
}
