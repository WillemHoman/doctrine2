<?php

namespace HelloWorld;

use DoctrineTestCase;

/**
 * \@backupGlobals disabled
 */
class ProductTest extends DoctrineTestCase
{
    public function testCreate(): void
    {
        $product = new Product('asdf', 'php');

        $this->em->persist($product);
        $this->em->flush();

        $this->assertEquals($product->getName(), 'asdf');
    }
}