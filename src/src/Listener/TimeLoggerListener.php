<?php

namespace App\Listener;

use App\Model\TimeLoggerInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Persistence\Event\PreUpdateEventArgs;

class TimeLoggerListener
{
    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof TimeLoggerInterface) {
            return;
        }

        $entity->setCreatedAt(new \DateTimeImmutable());
        $entity->setUpdatedAt(new \DateTimeImmutable());

    }


    public function preUpdate(PreUpdateEventArgs  $args): void
    {
        $entity = $args->getObject();


        if (!$entity instanceof TimeLoggerInterface) {
            return;
        }
        $entity->setUpdatedAt(new \DateTimeImmutable());

    }
}