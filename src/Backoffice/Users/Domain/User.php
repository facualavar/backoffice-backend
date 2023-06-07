<?php

namespace Src\Backoffice\Users\Domain;

use DateTime;
use Src\Shared\Domain\Entity;

class User extends Entity
{
    private string $username;
    private string $password;
    private string $email;
    private Role $role;
    private DateTime $creationDate;

    public function __construct(string $username, string $password, string $email, Role $role)
    {
        $this->id             = new UserId();
        $this->username       = $username;
        $this->password       = $password;
        $this->email          = $email;
        $this->role           = $role;
        $this->creationDate   = new DateTime('now');
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function changeRole(Role $newRole): void
    {
        $this->role = $newRole;
    }

    public function getPermissions(): array
    {
        return $this->getRole()->getPermissions();
    }
}