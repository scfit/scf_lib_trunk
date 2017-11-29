<?php

require_once 'vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Bootstrap {

    /**
     * @return EntityManager
     */
    public static function getEntityManager()
    {
        $config = Setup::createAnnotationMetadataConfiguration(
            [ 'src/Tms/Entity'],
            true,
            __DIR__.'/..cache/proxies',
            null,
            false
        );
        $entityManager = EntityManager::create([
            'driver'   => 'pdo_sqlite',
            'path' => __DIR__ . '/db.sqlite'
        ], $config);
        return $entityManager;
    }

}