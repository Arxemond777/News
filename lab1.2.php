<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 21.11.15
 * Time: 15:26
 */

class User {

    public function __construct($name, $login, $password){
        echo ('Hi User! <br> Your name: '.$name.'. You login: '.$login. '. You password: '.crypt($password, password_hash($login, PASSWORD_BCRYPT)).'.<br><br>');
    }

}
$user1 = new User('Aaa', 'Bbb', 'Ccc');
$user2 = new User('123', '456', '789');


class MyClass {

    public $login;

    public function __destruct() {
        echo 'Пользователь ' .
            $this->login . ' удален';
    }
}
$obj = new MyClass();
$obj->login = 'Yuri';