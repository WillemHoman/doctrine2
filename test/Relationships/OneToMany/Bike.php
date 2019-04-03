<?php

namespace Relationships\OneToMany;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 **/
class Bike
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;


    /**
     * @var Person
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="bikes", cascade={"persist"} )
     */
    protected $person;

    public function __construct(string $name, Person $person)
    {
        $this->name = $name;
        $this->person = $person;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Person
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /**
     * @param Person $person
     */
    public function setPerson(Person $person): void
    {
        $this->person = $person;
    }
}