<?php

namespace App\Listener;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;

#[AsDoctrineListener(event: Events::onFlush)]
class DummyListener
{
    public function onFlush(OnFlushEventArgs $eventArgs): void
    {
        $objectManager = $eventArgs->getObjectManager();
        $uow = $objectManager->getUnitOfWork();

        foreach ($uow->getScheduledEntityDeletions() as $entity) {
            $originalEntity = $uow->getOriginalEntityData($entity);
            dump(['Saved Entity' => $entity]);
            dump(['Original Entity From Repository' => $originalEntity]);
        }
    }
}