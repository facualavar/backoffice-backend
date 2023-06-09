<?php

namespace Src\Backoffice\Users\Domain;

use DateTime;
use Src\Backoffice\Domain\Roles\IRole;
use Src\Backoffice\Roles\Domain\Permissions\PermissionGroup;
use Src\Shared\Domain\Entity;

class User extends Entity
{
    private string $username;
    private string $password;
    private string $email;
    private IRole $role;
    private DateTime $creationDate;

    public function __construct(string $username, string $password, string $email, IRole $role)
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

    public function getRole(): IRole
    {
        return $this->role;
    }

    public function changeRole(IRole $newRole): void
    {
        $this->role = $newRole;
    }

    public function getPermissions(): array
    {
        return $this->getRole()->getPermissions();
    }
}