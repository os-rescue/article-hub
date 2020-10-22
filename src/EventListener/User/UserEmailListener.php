<?php

namespace ArticleHub\EventListener\User;

use API\UserBundle\Message\UserEmailUpdate;
use ArticleHub\Entity\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Messenger\MessageBusInterface;

final class UserEmailListener implements EventSubscriber
{
    private $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::onFlush,
        ];
    }

    public function onFlush(OnFlushEventArgs $args): void
    {
        $em = $args->getEntityManager();
        $uow = $em->getUnitOfWork();

        foreach ($uow->getScheduledEntityUpdates() as $entity) {
            if (!$entity instanceof User) {
                continue;
            }

            $changeSet = $uow->getEntityChangeSet($entity);
            if (!empty($changeSet['email'])) {
                $this->bus->dispatch(new UserEmailUpdate($entity->getId()));
            }
        }
    }
}
