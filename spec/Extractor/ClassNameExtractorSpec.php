<?php namespace spec\DeSmart\CommandBus\Extractor;

use DeSmart\CommandBus\Stubs\RegisterUserCommand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClassNameExtractorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('DeSmart\CommandBus\Extractor\ClassNameExtractor');
        $this->shouldImplement('DeSmart\CommandBus\Extractor\Contracts\CommandNameExtractor');
    }

    public function it_return_class_name()
    {
        $command = new RegisterUserCommand;

        $this->extract($command)->shouldReturn('DeSmart\CommandBus\Stubs\RegisterUserCommand');
    }
}
