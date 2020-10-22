<?php

namespace ArticleHub\Dto;

final class UserRequiredData
{
    private $email;
    private $plainPassword;
    private $firstName;
    private $lastName;
    private $roles;

    public function __construct(
        string $email,
        string $firstName,
        string $lastName,
        ?array $roles,
        ?string $plainPassword
    ) {
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->roles = $roles;
        $this->plainPassword = $plainPassword;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }
}
