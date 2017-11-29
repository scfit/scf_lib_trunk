<?php

use PHPUnit\Framework\TestCase;
use \Doctrine\ORM\Tools\SchemaTool;
use ScfLib\Tms\Entity\VehicleType;

/**
 * Class DataSourceTest
 * @covers \ScfLib\Tms
 */
class SchemaTest extends TestCase
{

    public function testSchema() {
        $className = 'ScfLib\Tms\Entity\VehicleType';
        //var_dump( new $className() );

        $em = Bootstrap::getEntityManager();

        //var_dump( $em );

        $tool = new SchemaTool($em);
        $classes = [$em->getClassMetadata($className)];

        /*
        foreach (new DirectoryIterator(__DIR__.'/../../src/Tms/Entity') as $fileInfo) {
            if( $fileInfo->isFile() ) {
                echo $fileInfo->getBasename('.php')."\n";
                $classes[] = $em->getClassMetadata($fileInfo->getBasename('.php'));
            }
        }
        */
        try {
            $tool->createSchema($classes);
        } catch (Exception $e) {
            echo $e;
        }


    }

}