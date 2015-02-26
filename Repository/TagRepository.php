<?php

namespace Alpha\TagBundle\Repository;

use Alpha\TagBundle\Entity\Tag;
use Doctrine\ORM\EntityRepository;

class TagRepository extends EntityRepository
{
    /**
     * @param  string $name
     * @return Tag
     */
    public function loadOrCreateTag($name)
    {
        $existing = $this->findOneBy(["name" => $name]);

        if ($existing instanceof Tag) {
            return $existing;
        } else {
            $tag = new Tag();
            $tag->setName($name);
            $this->_em->persist($tag);

            return $tag;
        }
    }
}
