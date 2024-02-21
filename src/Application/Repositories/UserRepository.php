<?php 
namespace App\Application\Repositories;

use App\Domain\Entities\User;

interface UserRepository
{
    public function userOfUuid(string $uuid): ?User;

    public function userOfEmail(string $email): ?User;

    public function save(User $user): void;
}