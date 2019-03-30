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
        $name = 'asdf';
        $product = new Product($name, 'php');

        $this->em->persist($product);
        $this->em->flush();

        $this->assertEquals($product->getName(), $name);
    }
}