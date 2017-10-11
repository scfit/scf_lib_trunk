<?php
/**
 * Created by PhpStorm.
 * User: michael.theuerzeit
 * Date: 11.10.17
 * Time: 13:21
 */

namespace ScfLib\Optamu;

use ScfLib\Optamu\Storage\StorageInterface;

class Client
{

    private $url = 'http://localhost/app_dev.php';
    //private $url = 'https://tracker.supplychainfactory.com';

    /**
     * @var StorageInterface
     */
    private $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function authenticate($username,$password)
    {
        $url = $this->url.'/login_check';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query([
            '_username' => $username,
            '_password' => $password
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close ($ch);

        if( $response ) {
            $data = json_decode($response,true);
            $this->storage->setItem('token',$data['token']);
            $this->storage->setItem('refresh_token',$data['refresh_token']);
            return true;
        } else {
            return false;
        }
    }

    public function getToken() {
        return $this->storage->getItem('token');
    }

    public function getUrl()
    {
        return $this->url;
    }
}