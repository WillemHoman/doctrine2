<?php

namespace XmlMapping;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;
use DoctrineTestCase;

/**
 * \@backupGlobals disabled
 */
class ProductTest extends DoctrineTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function configure(string $entityDir): Configuration
    {
        $config = Setup::createXMLMetadataConfiguration(
            [__DIR__],
            true
        );
        return $config;
    }


    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function testCreate(): void
    {
        $product = new Product('xml', 'XYZ-123');

        $this->em->persist($product);
        $this->em->flush();

        $this->assertEquals($product->getName(), 'xml');
    }
}