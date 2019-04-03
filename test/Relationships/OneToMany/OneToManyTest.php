<?php
namespace Relationships\OneToMany;


/**
 * \@backupGlobals disabled
 */
class OneToManyTest extends \DoctrineTestCase
{

    /** @var Person */
    private $rider1;

    /** @var Person */
    private $rider2;

    protected function setup(): void
    {
        parent::setUp();
        $this->rider1 = new Person("Willem");
        $norco = new Bike('Norco', $this->rider1);
        $this->rider1->addBike($norco);
        $heckler = new Bike('Heckler', $this->rider1);
        $this->rider1->addBike($heckler);
        $this->em->persist($this->rider1);

        $this->rider2 = new Person("Joe");
        $specialized = new Bike('Specialized',$this->rider2 );
        $this->rider2->addBike($specialized);
        $bianchi = new Bike('Bianchi', $this->rider2);
        $this->rider2->addBike($bianchi);
        $this->em->persist($this->rider2);
        $this->em->flush();
        $this->em->clear();
    }

    public function testFind(): void
    {
        $this->em->clear();
        $personRepository = $this->em->getRepository(Person::class);
        $rider = $personRepository->find($this->rider1->getId());
        $this->assertEquals($this->rider1->getName(), $rider->getName());
    }
    
    public function testFindBy(): void
    {
        $this->em->clear();
        $riderRepository = $this->em->getRepository(Person::class);
        $rider = $riderRepository->findOneBy(['name'=>'Willem']);
        $this->assertEquals($this->rider1->getName(), $rider->getName());
    }
    

    private function assertBikes(array $expectedBikes, Person $person)
    {
        $bikes = $person->getBikes()->map(static function(Bike $bike){
            return $bike->getName();
        });
        $this->assertEquals($expectedBikes, $bikes->toArray());
    }
}
