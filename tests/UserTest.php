<?php

use App\Domain\Entities\User;
use App\Application\UseCases\LoadUser;
use App\Application\UseCases\CreateUser;
use App\Infra\Repositories\UserRepositoryMemory;

describe('UserTest', function() {
    beforeEach(function() {
        $this->userRepository = new UserRepositoryMemory();
    });

    dataset('user', [
        [
            [
                'name' => 'John Doe',
                'email' => 'johndoe@gmail.com'
            ]
        ]
    ]);

    it('deve criar um usuario', function(array $user) {
        $useCase = new CreateUser($this->userRepository);
        $output = $useCase->execute($user);
        $user = $output->get();
    
        expect($user)->toBeInstanceOf(User::class);
        expect($user->uuid())->toBeString();
        expect($user->name())->toBe('John Doe');
        expect($user->email())->toBe('johndoe@gmail.com');
    })->with('user');
    
    it('deve retornar um erro se o email ja existir', function(array $user) {
        $useCase = new CreateUser($this->userRepository);
        $useCase->execute($user);
        $output2 = $useCase->execute($user);
    
        expect($output2->isLeft())->toBeTrue();
        expect($output2->get())->toBe('Email ja existe');
    })->with('user');
    
    it('deve retornar um usuario por email', function(array $user) {
        $useCase = new CreateUser($this->userRepository);
        $output = $useCase->execute($user);
    
        $useCase = new LoadUser($this->userRepository);
        $output = $useCase->execute([
            'email' => 'johndoe@gmail.com'
        ]);
    
        expect($output->isRight())->toBeTrue();
        expect($output->get())->toBeInstanceOf(User::class);
    })->with('user');
    
    it('deve retornar um erro ao buscar por email inexistente',function(array $user) {
        $useCase = new CreateUser($this->userRepository);
        $output = $useCase->execute($user);
    
        $useCase = new LoadUser($this->userRepository);
        $output = $useCase->execute([
            'email' => 'thomas2@gmail.com'
        ]);
    
        expect($output->isLeft())->toBeTrue();
        expect($output->get())->toBe('Usuário nao encontrado');
    })->with('user');
    
    it('deve retornar um usuario por uuid',function(array $user) {
        $useCase = new CreateUser($this->userRepository);
        $output = $useCase->execute($user);
    
        $useCase = new LoadUser($this->userRepository);
        $output = $useCase->execute([
            'uuid' => $output->get()->uuid()
        ]);
    
        expect($output->isRight())->toBeTrue();
        expect($output->get())->toBeInstanceOf(User::class);
    })->with('user');
    
    it('deve retornar um erro ao buscar por uuid inexistente',function(array $user) {
        $useCase = new CreateUser($this->userRepository);
        $output = $useCase->execute($user);
    
        $useCase = new LoadUser($this->userRepository);
        $output = $useCase->execute([
            'uuid' => 'fake'
        ]);
    
        expect($output->isLeft())->toBeTrue();
        expect($output->get())->toBe('Usuário nao encontrado');
    })->with('user');
});
