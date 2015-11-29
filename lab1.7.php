<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 21.11.15
 * Time: 23:56
 */

class User {

    public static $CountUser = 0;
    public  $CountUser1 = 0;

    public function __construct(){
        ++self::$CountUser;
    }

    public function showInfo($name, $login, $password){
        echo 'Hi User! <br> Your name: '.$name.
            '. You login: '.$login.
            '. You password: '.$password.'.<br><br>';
    }
}

class SuperUser extends User {
    public static $CountSuperUser = 0;

    public function __construct(){
        parent::__construct();
        ++self::$CountSuperUser;
    }
}

$user0 = new User();
$user1 = new User();
$user2 = new User();
$user3 = new User();
$user4 = new SuperUser();
$user5 = new SuperUser();

echo "Общие число пользователей: ".User::$CountUser
     ." из них администраторов ".SuperUser::$CountSuperUser."<br>".
     "Что = ".round(((SuperUser::$CountSuperUser * 100) / User::$CountUser), 2)."%"; 

