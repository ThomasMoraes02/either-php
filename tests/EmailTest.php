<?php

use App\Domain\ValueObjects\Email;

test('email é válido', function () {
    $email = new Email('thomas@gmail.com');

    expect($email)->toBeInstanceOf(Email::class);
    expect((string) $email)->toBe('thomas@gmail.com');
});

test('email não é válido', function () {
    expect(fn () => new Email('abc'))->toThrow(InvalidArgumentException::class);
});