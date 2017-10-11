<?php

namespace ScfLib\Optamu\Storage;

interface StorageInterface {

    public function setItem($key,$value);

    public function getItem($key);

    public function deleteItem($key);

    public function clear();

}