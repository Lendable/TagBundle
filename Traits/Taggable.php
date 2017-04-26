<?php

namespace Alpha\TagBundle\Traits;

use Alpha\TagBundle\Entity\Tag;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

trait Taggable
{
    /**
     * @var Collection|Tag[]
     *
     * @ORM\ManyToMany(targetEntity="Alpha\TagBundle\Entity\Tag")
     */
    private $tags;

    /**
     * @return Collection|Tag[]
     */
    public function getTags()
    {
        if (!$this->tags instanceof Collection) {
            throw new \RuntimeException(sprintf('The tags property must be initialized as an instance of %s', Collection::class));
        }

        return $this->tags;
    }

    /**
     * @param Tag $tag
     */
    public function addTag(Tag $tag)
    {
        if (!$this->tags instanceof Collection) {
            throw new \RuntimeException(sprintf('The tags property must be initialized as an instance of %s', Collection::class));
        }

        if (!$this->getTags()->contains($tag)) {
            $this->tags->add($tag);
        }
    }

    public function removeTag(Tag $tag)
    {
        if (!$this->tags instanceof Collection) {
            throw new \RuntimeException(sprintf('The tags property must be initialized as an instance of %s', Collection::class));
        }

        $this->tags->removeElement($tag);
    }

    public function hasTag(string $name): bool
    {
        if (!$this->tags instanceof Collection) {
            throw new \RuntimeException(sprintf('The tags property must be initialized as an instance of %s', Collection::class));
        }

        $name = mb_strtolower($name);

        foreach ($this->getTags() as $tag) {
            if (mb_strtolower($tag->getName()) === $name) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $name
     *
     * @return Tag|null
     */
    public function getTag(string $name)
    {
        if (!$this->tags instanceof Collection) {
            throw new \RuntimeException(sprintf('The tags property must be initialized as an instance of %s', Collection::class));
        }

        $name = mb_strtolower($name);

        foreach ($this->getTags() as $tag) {
            if (mb_strtolower($tag->getName()) === $name) {
                return $tag;
            }
        }

        return null;
    }
}
