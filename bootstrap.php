<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;

Dotenv\Dotenv::create(__DIR__)->load();

function createEntityManager(Configuration $config): EntityManager{

    $config->setNamingStrategy(new UnderscoreNamingStrategy);

    Type::overrideType('datetime', UTCDateTimeType::class);

    return EntityManager::create(
        [
            'driver' => 'pdo_mysql',
            'host' => getenv('HOST'),
            'dbname' => getenv('SCHEMA'),
            'user' => getenv('USERNAME'),
            'password' => getenv('PASSWORD'),
            'charset' => 'utf8mb4',
        ],
        $config
    );
}