<?php

use Doctrine\ORM\EntityManager;

Dotenv\Dotenv::create(__DIR__)->load();

function createEntityManager($config): EntityManager{
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