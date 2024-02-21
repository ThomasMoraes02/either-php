<?php 
namespace App\Infra\Repositories;

use App\Application\Repositories\UserRepository;
use App\Domain\Entities\User;

class UserRepositoryMemory implements UserRepository
{
    public function __construct(private array $users = []) {}

    public function userOfUuid(string $uuid): ?User
    {
        return $this->users[$uuid] ?? null;
    }

    public function userOfEmail(string $email): ?User
    {
        $user = array_filter($this->users, fn (User $user) => $user->email() === $email);
        return (count($user) > 0) ? $user[array_key_first($user)] : null;
    }

    public function save(User $user): void
    {
        $this->users[$user->uuid()] = $user;
    }
}