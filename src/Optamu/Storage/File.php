<?php
/**
 * Created by PhpStorm.
 * User: michael.theuerzeit
 * Date: 11.10.17
 * Time: 14:11
 */

namespace ScfLib\Optamu\Storage;


class File implements StorageInterface
{

    private $filename;

    private $data = [];

    public function __construct($filename)
    {
        $this->filename = $filename;
        if( file_exists($this->filename) ) {
            $this->data = json_decode(file_get_contents($this->filename),true);
        }
    }

    private function persist() {
        file_put_contents($this->filename,json_encode($this->data));
    }

    public function setItem($key,$value)
    {
        $this->data[$key] = $value;
        $this->persist();
    }

    public function getItem($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function deleteItem($key)
    {
        unset($this->data[$key]);
        $this->persist();
    }

    public function clear()
    {
        $this->data = [];
        $this->persist();
    }

}