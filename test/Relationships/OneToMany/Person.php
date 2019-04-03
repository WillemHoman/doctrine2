<?php

namespace Relationships\OneToMany;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 **/
class Person
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var String $name
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Bike", mappedBy="person", cascade={"all"}, orphanRemoval=true)
     */
    protected $bikes;


    function __construct(string $name, Collection $bikes = null)
    {
        $this->name = $name;
        $this->bikes = $bikes ?? new ArrayCollection;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function addBike(Bike $bike): void
    {
        $this->bikes->add($bike);
        $bike->setPerson($this);
    }

    public function removeBike(Bike $bike): void
    {
        $this->bikes->removeElement($bike);
    }

    public function setName(String $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBikes(): Collection
    {
        return $this->bikes;
    }

    /**
     * @param Collection|Bike[] $bikes
     */
    public function setBikes(Collection $bikes): void
    {
        $this->bikes = $bikes;
    }
}