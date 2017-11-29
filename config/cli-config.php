<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
require __DIR__.'/../vendor/autoload.php';


$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
    [ 'src/Tms/Entity'],
    true,
    __DIR__.'/..cache/proxies',
    null,
    false
);

$em = \Doctrine\ORM\EntityManager::create([
    'driver'   => 'pdo_sqlite',
    'path' => __DIR__ . '/db.sqlite'
], $config);

return ConsoleRunner::createHelperSet($em);
