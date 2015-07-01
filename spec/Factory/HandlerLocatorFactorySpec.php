<?php namespace spec\DeSmart\CommandBus\Factory;

use DeSmart\CommandBus\Stubs\RegisterUserCommand;
use DeSmart\CommandBus\Stubs\RegisterUserCommandHandler;
use Illuminate\Contracts\Container\Container;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HandlerLocatorFactorySpec extends ObjectBehavior
{
    public function let(Container $app)
    {
        $this->beConstructedWith($app);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('DeSmart\CommandBus\Factory\HandlerLocatorFactory');
        $this->shouldImplement('DeSmart\CommandBus\Factory\Contracts\HandlerLocator');
    }

    public function it_should_return_handler_class_instance(Container $app, RegisterUserCommandHandler $handler) {
        $class_name = sprintf('%sHandler', RegisterUserCommand::class);
        $app->make($class_name)->willReturn($handler)->shouldBeCalled();

        $this->getHandlerForCommand(RegisterUserCommand::class)->shouldBe($handler);
    }

    public function it_should_throw_exception_when_handler_class_does_not_exist()
    {
        $class_name = preg_replace('/Command$/', 'FooBar', RegisterUserCommand::class);

        $this->shouldThrow('DeSmart\CommandBus\Exceptions\MissingHandlerException')
            ->during('getHandlerForCommand', [$class_name]);
    }
}
