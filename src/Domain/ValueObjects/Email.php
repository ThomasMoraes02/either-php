<?php 
namespace App\Domain\ValueObjects;

use InvalidArgumentException;

class Email
{
    public function __construct(private string $email)
    {
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email inválido');
        }
        $this->email = $email;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}