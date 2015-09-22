<?php

namespace Alpha\TagBundle\Traits;

use Alpha\TagBundle\Entity\Tag;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

trait Taggable
{
    /**
     * @ORM\ManyToMany(targetEntity="Alpha\TagBundle\Entity\Tag")
     */
    private $tags;

    /**
     * @return ArrayCollection|Tag[]
     */
    public function getTags()
    {
        return $this->tags ?: new ArrayCollection();
    }

    /**
     * @param Tag $tag
     */
    public function addTag(Tag $tag)
    {
        if (!$this->tags) {
            $this->tags = new ArrayCollection();
        }
        if (!$this->getTags()->contains($tag)) {
            $this->tags[] = $tag;
        }
    }

    public function removeTag(Tag $tag)
    {
        if (!$this->tags) {
            $this->tags = new ArrayCollection();
        }

        $this->tags->removeElement($tag);
    }

    public function hasTag($name)
    {
        foreach ($this->getTags() as $tag) {
            if ($tag->getName() == $name) {
                return true;
            }
        }

        return false;
    }
}
