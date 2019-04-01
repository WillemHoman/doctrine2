<?php

use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\Setup;
use PHPUnit\Framework\TestCase;

abstract class DoctrineTestCase extends TestCase
{
    /** @var EntityManager */
    protected $em;

    private $dbConfig = [
        'mysql' => [
            'driver' => 'pdo_mysql',
            'host' => 'mysql.store.bcdev',
            'dbname' => 'doctrine',
            'user' => 'root',
            'password' => 'magic',
            'charset' => 'utf8mb4',
        ],
    ];

    protected function setUp(): void
    {
        $this->em = EntityManager::create(
            $this->dbConfig['mysql'],
            $this->configure($this->getEntityDir())
        );

        $this->dropAndCreateSchema();
    }

    /**
     * @param string $entityDir
     * @return Configuration
     */
    protected function configure(string $entityDir): Configuration
    {
        $config = Setup::createAnnotationMetadataConfiguration(
            [$entityDir],
            true,
            null,
            null,
            false
        );
        return $config;
    }

    private function dropAndCreateSchema(): void
    {
        $schemaTool = new SchemaTool($this->em);
        $classes = array_map(
            function (string $className) {
                return $this->em->getClassMetadata($className);
            },
            $this->em->getConfiguration()->getMetadataDriverImpl()->getAllClassNames()
        );
        $schemaTool->dropSchema($classes);
        $schemaTool->createSchema($classes);
    }

    private function getEntityDir(): string
    {
        $reflectionClass = new ReflectionClass($this);
        return dirname($reflectionClass->getFileName());
    }
}