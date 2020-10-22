<?php

namespace ArticleHub\Security\Article;

use ArticleHub\Entity\Article;
use ArticleHub\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class ArticleVoter extends Voter
{
    const CAN_HANDLE_REQUEST = 'can_handle_article';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject): bool
    {
        return self::CAN_HANDLE_REQUEST == $attribute && $subject instanceof Article;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (!$user instanceof User) {
            return false;
        }

        return $user->getId() == $subject->getCreatedBy()->getId();
    }
}