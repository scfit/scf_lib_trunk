<?php
/**
 * Created by PhpStorm.
 * User: michael.theuerzeit
 * Date: 11.10.17
 * Time: 14:30
 */

namespace ScfLib\Optamu;


class Resource
{

    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getList($uri,array $filter=null,array $order=null)
    {
        $url = $this->client->getUrl().$uri;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/ld+json',
            'Authorization: Bearer '.$this->client->getToken()
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close ($ch);
        return json_decode($response,true);
    }

    public function get($uri,$id)
    {
        $ch = curl_init($this->client->getUrl().$uri.'/'.$id);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/ld+json',
            'Authorization: Bearer '.$this->client->getToken()
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close ($ch);
        return json_decode($response,true);
    }

    public function post($uri,array $data)
    {
        $ch = curl_init($this->client->getUrl().$uri);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/ld+json',
            'Authorization: Bearer '.$this->client->getToken()
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($ch);
        curl_close ($ch);
        return json_decode($response,true);
    }

    public function put($uri,$id,array $data)
    {
        $ch = curl_init($this->client->getUrl().$uri.'/'.$id);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'PUT');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/ld+json',
            'Authorization: Bearer'.$this->client->getToken()
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($ch);
        curl_close ($ch);
        return json_decode($response,true);
    }

    public function delete($uri,$id)
    {
        $ch = curl_init($this->client->getUrl().$uri.'/'.$id);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'DELETE');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/ld+json',
            'Authorization: Bearer'.$this->client->getToken()
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close ($ch);
        return json_decode($response,true);
    }
}