<?php namespace DeSmart\CommandBus\Stubs;

class RegisterUserCommand 
{
    protected $email;

    public function getEmail()
    {
        return $this->email;
    }
}
