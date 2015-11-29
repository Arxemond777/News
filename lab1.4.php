<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 21.11.15
 * Time: 19:52
 */

class User {

    public $name = 'Aaa';
    public $login = 'Bbb';
    public $password = 'Ccc';

}

class SuperUser extends User {

    public $role;

    public function showInfo() {
        if(
            !empty($this->role)
            && $this->role != ' '
            && $this->role === 'admin1'
        ){
            echo 'You name: '.$this->name.
                '. You login: '.$this->login.
                '. You password: '.$this->password.
                ' You role: '.$this->role.'.<br><br>';
        } else {
            echo 'Введите роль, соответсвующию заданию!11Пыщь-пыщь';
        }
    }

}

$user1 = new SuperUser();
$user1->role = 'admin1';
$user1->showInfo();