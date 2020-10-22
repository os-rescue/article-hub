<?php

namespace ArticleHub\Dto;

use ArticleHub\Entity\User;

final class UserDataByToken
{
    private $email;
    private $firstName;
    private $middleName;
    private $lastName;
    private $admin;

    public function __construct(User $user)
    {
        $this->email = $user->getEmail();
        $this->firstName = $user->getFirstName();
        $this->middleName = $user->getMiddleName();
        $this->lastName = $user->getLastName();
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
}
