<?php 
namespace App\Application\UseCases;

use App\Domain\Entities\User;
use App\Application\Either\Left;
use App\Application\Either\Right;
use App\Application\Either\Either;
use App\Application\Repositories\UserRepository;

class CreateUser
{
    public function __construct(private readonly UserRepository $userRepository) {}

    public function execute(array $input): Either
    {
        $userOfEmail = $this->userRepository->userOfEmail($input['email']);
        if($userOfEmail) return new Left('Email ja existe');
        $user = User::create($input['name'],$input['email']);
        $this->userRepository->save($user);
        return new Right($user);
    }
}