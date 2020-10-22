<?php

namespace ArticleHub\Tests\Dto;

use ArticleHub\Dto\UserDataByToken;
use ArticleHub\Entity\User;
use PHPUnit\Framework\TestCase;

class UserDataByTokenTest extends TestCase
{
    public function testUserDataByToken(): void
    {
        $user = $this->getTestUser();

        $userDataByToken = new UserDataByToken($user);

        $this->assertSame($userDataByToken->getEmail(), $user->getEmail());
        $this->assertSame($userDataByToken->getFirstName(), $user->getFirstName());
        $this->assertSame($userDataByToken->getMiddleName(), $user->getMiddleName());
        $this->assertSame($userDataByToken->getLastName(), $user->getLastName());
    }

    private function getTestUser(): User
    {
        return (new User())
            ->setEmail('foo@bar.com')
            ->setFirstName('Foo')
            ->setLastname('Bar')
            ->setEmail('foo@bar.com')
            ;
    }
}
