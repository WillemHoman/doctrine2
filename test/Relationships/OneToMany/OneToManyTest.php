<?php
namespace Relationships\OneToMany;


/**
 * \@backupGlobals disabled
 */
class OneToManyTest extends \DoctrineTestCase
{
    protected function setup(): void
    {
        parent::setUp();

        $order1 = new Order(
            'joe@acme.com'
        );
        $order1->addLineItem(
        'Hat',
            4,
            '27.45'
        );
        $order1->addLineItem(
        'Shoes',
            1,
            '10.45'
        );
        $this->em->persist($order1);

        $order2 = new Order(
            'jenny@acme.com'
        );
        $order2->addLineItem(
        'Football',
            1,
            '40.00'
        );
        $order2->addLineItem(
        'Sunglasses',
            2,
            '27.90'
        );
        $this->em->persist($order2);

        $this->em->flush();
        $this->em->clear();
    }

    public function testFind(): void
    {
        $this->em->clear();
        $orderRepository = $this->em->getRepository(Order::class);
        $order = $orderRepository->find(1);
        $this->assertEquals('joe@acme.com', $order->getCustomerEmail());
    }
    
    public function testFindBy(): void
    {
        $this->em->clear();
        $orderRepository = $this->em->getRepository(Order::class);
        $order = $orderRepository->findOneBy(['customerEmail'=>'joe@acme.com']);
        $this->assertEquals(1, $order->getId());
    }
}
