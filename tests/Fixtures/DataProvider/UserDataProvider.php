<?php

namespace ArticleHub\Tests\DataProvider;

use ArticleHub\Entity\User;
use Doctrine\Persistence\ManagerRegistry;

final class UserDataProvider
{
    private $repository;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->repository = $doctrine->getManager()->getRepository(User::class);
    }

    public function findBy(array $creteria): array
    {
        $this->repository->clear();

        return $this->repository->findBy($creteria);
    }

    public function findOneBy(array $creteria): ?User
    {
        $this->repository->clear();

        return $this->repository->findOneBy($creteria);
    }
}
