<?php 
namespace App\Application\Either;

interface Either
{
    public function isLeft(): bool;

    public function isRight(): bool;

    public function get(): mixed;

    public function getOrElse(mixed $default): mixed;
}