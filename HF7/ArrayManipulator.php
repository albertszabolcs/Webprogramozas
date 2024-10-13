<?php

class ArrayManipulator {
    private $data = [];

    public function __get($name) {
        return isset($this->data[$name]) ? $this->data[$name] : null;
    }
    public function __set($name, $value) {
        $this->data[$name] = $value;
    }
    public function isset_($name) {
        return isset($this->data[$name]);
    }
    public function unset__($name) {
        unset($this->data[$name]);
    }
    public function __toString() {
        return implode(", ",$this->data);
    }
    public function __clone() {
        $this->data = array_map(function($item) {
            return $item;
        }, $this->data);
    }

}
?>