<?php

namespace Krak\Arr;

class Bag implements \ArrayAccess
{
    private $data;

    public function __construct(array $data = []) {
        $this->data = $data;
    }

    public function get($key, $else = null, $sep = '.') {
        return get($this->data, $key, $else, $sep);
    }

    public function getIn(array $key, $else = null) {
        return getIn($this->data, $key, $else);
    }

    public function set($key, $value, $sep = '.') {
        return set($this->data, $key, $value, $sep);
    }

    public function has($key, $sep = '.') {
        return has($this->data, $key, $sep);
    }
    public function hasIn(array $key) {
        return hasIn($this->data, $key);
    }

    public function del($key, $sep = '.') {
        return del($this->data, $key, $sep);
    }

    public function raw() {
        return $this->data;
    }

    public function offsetExists($offset) {
        return array_key_exists($offset, $this->data);
    }

    public function offsetSet($offset, $value) {
        return $this->set($offset, $value, null);
    }

    public function offsetGet($offset) {
        return $this->get($offset, null, null);
    }

    public function offsetUnset($offset) {
        return $this->del($offset, null);
    }
}
