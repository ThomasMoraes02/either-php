<?php

use App\Application\UseCases\CreateUser;
use App\Domain\Entities\User;
use App\Infra\Repositories\UserRepositoryMemory;

test('deve criar um usuario', function() {
    $userRepository = new UserRepositoryMemory();
    $useCase = new CreateUser($userRepository);
    $output = $useCase->execute([
        'name' => 'Thomas Moraes',
        'email' => 'thomas@gmail.com'
    ]);

    $user = $output->get();

    expect($user)->toBeInstanceOf(User::class);
    expect($user->uuid())->toBeString();
    expect($user->name())->toBe('Thomas Moraes');
    expect($user->email())->toBe('thomas@gmail.com');
});

test('deve retornar um erro se o email ja existir', function() {
    $userRepository = new UserRepositoryMemory();
    $useCase = new CreateUser($userRepository);
    $output = $useCase->execute([
        'name' => 'Thomas Moraes',
        'email' => 'thomas@gmail.com'
    ]);

    $output = $useCase->execute([
        'name' => 'Thomas Moraes',
        'email' => 'thomas@gmail.com'
    ]);

    expect($output->isLeft())->toBeTrue();
    expect($output->get())->toBe('Email ja existe');
});