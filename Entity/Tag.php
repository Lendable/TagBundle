<?php

namespace Alpha\TagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Tag
 *
 * @package Alpha\TagBundle\Entity
 *
 * @ORM\Entity(repositoryClass="Alpha\TagBundle\Repository\TagRepository")
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    public function __construct($name = null)
    {
        if (null !== $name) {
            $this->setName($name);
        }
    }

    /**
     * Gets the id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name.
     *
     * @param  string $name
     *
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
