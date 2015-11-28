<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 22.11.15
 * Time: 0:12
 */

abstract class AUser {

    abstract function showInfo($name, $login, $password);

}

class User extends AUser {

    function showInfo($name, $login, $password){
        echo ('Hi User! <br> Your name: '.$name.'. You login: '.$login. '. You password: '.$password.'.<br><br>');
    }

}

$obj = new User();
$obj->showInfo('a', 'b', 'c');