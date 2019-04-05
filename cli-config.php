<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;

require_once 'bootstrap.php';

$entityManager = createEntityManager(
    Setup::createAnnotationMetadataConfiguration(
        ['test/Relationships/OneToMany'],
        true,
        null,
        null,
        false
    )
);

return ConsoleRunner::createHelperSet($entityManager);