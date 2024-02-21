<?php 
namespace App\Domain\Entities;

use App\Domain\ValueObjects\Email;

class User
{
    public function __construct(
        private readonly string $uuid,
        private readonly string $name,
        private readonly Email $email,
    ) {}

    public static function create(string $name, string $email): User
    {
        return new User(rand(1,100),$name,new Email($email));
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }
}