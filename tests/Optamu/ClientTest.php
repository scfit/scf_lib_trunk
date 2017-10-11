<?php
/**
 * Created by PhpStorm.
 * User: michael.theuerzeit
 * Date: 11.10.17
 * Time: 13:46
 */

use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{

    /*
    public function testAuthenticate()
    {
        $storage = new \ScfLib\Optamu\Storage\File(__DIR__.'/../assets/optamu_storage.json');
        $client = new \ScfLib\Optamu\Client($storage);
        $this->assertTrue($client->authenticate('mtheuerzeit','MkTime08'));
    }
    */

    public function testList()
    {
        $storage = new \ScfLib\Optamu\Storage\File(__DIR__.'/../assets/optamu_storage.json');
        $client = new \ScfLib\Optamu\Client($storage);
        if( $client->authenticate('mtheuerzeit','555Nase') ) {
            $resource = new  \ScfLib\Optamu\Resource($client);

            //$users = $resource->getList('/users'); var_dump($users);
            //$user = $resource->getList('/users/1'); var_dump($user);

            $user = $resource->post('/users',[
                'manager' => '/manager/1',
                'username' => 'mtheuerzeit',
                'fullname' => 'Michael Theuerzeit',
                'enabled' => true,
                'email' => 'michael.theuerzeit@supplychainfactory.com',
                'passwordPlain' => uniqid()
            ]);

            var_dump($user);



        } else {
            $this->any();
        }
    }
}