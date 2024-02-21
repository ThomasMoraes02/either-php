<?php 
namespace App\Application\UseCases;

use App\Domain\Entities\User;
use App\Application\Either\Left;
use App\Application\Either\Right;
use App\Application\Either\Either;
use App\Application\Repositories\UserRepository;

class LoadUser
{
    public function __construct(private readonly UserRepository $userRepository) {}

    public function execute(array $input): Either
    {
        if(isset($input['uuid'])) $user = $this->userRepository->userOfUuid($input['uuid']);
        if(isset($input['email'])) $user = $this->userRepository->userOfEmail($input['email']);
        if(!$user) return new Left('Usuário nao encontrado');
        return new Right($user);
    }
}