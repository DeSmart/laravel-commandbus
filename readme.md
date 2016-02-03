# Laravel CommandBus

A small, pluggable command bus.

## Instalation

1. `$ composer require desmart/laravel-commandbus`
2. Add `DeSmart\CommandBus\ServiceProvider` to `app.php`

## Example usage:

### Command Class

```php
class RegisterUserCommand
{
    protected $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
```

### CommandValidator Class

```php
class RegisterUserCommandValidator
{
    public function validate(RegisterUserCommand $command)
    {
        // it will be called before handler
    }
}
```

### CommandHandler Class

```php
class RegisterUserCommandHandler
{
    public function handle(RegisterUserCommand $command)
    {
        // it will be called if validator won't throw any exception
    }
}
```

### Execute the command:

```php
class Controller
{
    /**
     * @var \DeSmart\CommandBus\Contracts\CommandBus
     */
    protected $commandBus;

    public function __construct(\DeSmart\CommandBus\Contracts\CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function index()
    {
        $command = new RegisterUserCommand("foo@bar.net");
        $this->commandBus->handle($command);
    }
}
```
