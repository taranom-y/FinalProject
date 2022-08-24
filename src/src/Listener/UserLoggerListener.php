<?php

namespace App\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Model\UserLoggerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class UserLoggerListener
{
    private TokenStorageInterface $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }


    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof UserLoggerInterface) {
            return;
        }
        $token = $this->tokenStorage->getToken();
        $user = $token == null ? null : $this->tokenStorage->getToken()->getUser();

        $entity->setCreatedUser($user);
        $entity->setUpdatedUser($user);



    }
    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $entity = $args->getObject();


        if (!$entity instanceof UserLoggerInterface) {
            return;
        }
        $token = $this->tokenStorage->getToken();
        $user = $token == null ? null : $this->tokenStorage->getToken()->getUser();

        $entity->setUpdatedUser($user);

    }

}