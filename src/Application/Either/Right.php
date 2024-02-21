<?php 
namespace App\Application\Either;

use App\Application\Either\Either;

class Right implements Either
{
    public function __construct(private mixed $value) {}

    public function isLeft(): bool
    {
        return false;
    }

    public function isRight(): bool
    {
        return true;
    }

    public function get(): mixed
    {
        return $this->value;
    }

    public function getOrElse(mixed $default): mixed
    {
        return $this->value;
    }
}