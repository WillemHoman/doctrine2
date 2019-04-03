<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;

// replace with file to your own project bootstrap
require_once 'bootstrap.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = createEntityManager(
    Setup::createAnnotationMetadataConfiguration(
        ['test/HelloWorld'],
        true,
        null,
        null,
        false
    )
);

return ConsoleRunner::createHelperSet($entityManager);