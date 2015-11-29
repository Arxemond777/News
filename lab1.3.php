<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 21.11.15
 * Time: 19:37
 */

class User {

    public $name = 'Abc';

    public function showInfo() {
        echo 'You name: '.$this->name.'<br>';
    }

    public function __clone() {
        $this->name = 'Cba';
    }
}

$obj = new User();
$obj->showInfo();
$user4 = clone $obj;
$user4->showInfo();