<?php
/**
 * Created by PhpStorm.
 * User: michael.theuerzeit
 * Date: 11.10.17
 * Time: 14:30
 */

namespace ScfLib\Optamu;

/**
 * Class Resource
 * @package ScfLib\Optamu
 */
class Resource
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $response;

    /**
     * @var array
     */
    protected $info;

    /**
     * @var string
     */
    protected $url;

    /**
     * Resource constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $uri
     * @param array|null $filter
     * @param array|null $order
     * @return array|bool|mixed
     */
    public function getList($uri,array $filter=null,array $order=null)
    {
        $url = $this->client->getUrl().$uri;
        if( $filter !== null ) {
            $url.= '?'.http_build_query($filter);
        }
        if( $order !== null ) {
            if( $filter === null ) {
                $url.= '?';
            } else {
                $url.= '&';
            }
            $url.= http_build_query($filter);
        }
        return $this->request($url,'GET');
    }

    /**
     * @param $uri
     * @param $id
     * @return array|bool|mixed
     */
    public function get($uri,$id)
    {
        $url = $this->client->getUrl().$uri.'/'.$id;
        return $this->request($url,'GET');
    }

    /**
     * @param $uri
     * @param array $data
     * @return array|bool|mixed
     */
    public function post($uri,array $data)
    {
        $url = $this->client->getUrl().$uri;
        return $this->request($url,'POST',$data);
    }

    /**
     * @param $uri
     * @param $id
     * @param array $data
     * @return array|bool|mixed
     */
    public function put($uri,$id,array $data)
    {
        $url = $this->client->getUrl().$uri.'/'.$id;
        return $this->request($url,'PUT',$data);
    }

    /**
     * @param $uri
     * @param $id
     * @return array|bool|mixed
     */
    public function delete($uri,$id)
    {
        $url = $this->client->getUrl().$uri.'/'.$id;
        return $this->request($url,'DELETE');
    }

    /**
     * @return bool
     */
    public function isResponseValid() {
        return ($this->getHttpStatusCode() <= 300);
    }

    /**
     * @return integer
     */
    public function getHttpStatusCode() {
        return (int) $this->info['http_code'];
    }

    /**
     * @return array
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * @param $url
     * @param $method
     * @param array|null $data
     * @return array|bool|mixed
     */
    private function request($url,$method,array $data=null) {
        $this->url = $url;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST,$method);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/ld+json',
            'Authorization: Bearer '.$this->client->getToken()
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if( $data !== null ) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        $response = curl_exec($ch);
        $this->response = null;
        $this->info = curl_getinfo($ch);
        curl_close ($ch);
        if( $response === false ) {
            return false;
        }
        $this->response = json_decode($response,true);
        return $this->response;
    }

}