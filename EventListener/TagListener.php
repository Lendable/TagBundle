<?php

namespace Alpha\TagBundle\EventListener;

use Doctrine\ORM\Event\PreFlushEventArgs;

class TagListener
{
    public function preFlush(PreFlushEventArgs $args)
    {
        $em = $args->getEntityManager();
        $uow = $em->getUnitOfWork();
        $tagRepo = $em->getRepository('Alpha\TagBundle\Entity\Tag');
        $map = $uow->getIdentityMap();
        if ($map) {
            $entities = call_user_func_array('array_merge', $uow->getIdentityMap());
            $entities = array_merge($entities, $uow->getScheduledEntityInsertions());
        } else {
            $entities = $uow->getScheduledEntityInsertions();
        }
        foreach ($entities as $entity) {
            if (in_array('Alpha\TagBundle\Traits\Taggable', class_uses($entity))) {
                foreach ($entity->getTags() as $tag) {
                    if (!$em->contains($tag)) {
                        $entity->removeTag($tag);
                        $entity->addTag($tagRepo->loadOrCreateTag($tag->getName()));
                    }
                }
            }
        }
    }
}
