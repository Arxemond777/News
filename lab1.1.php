<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 21.11.15
 * Time: 15:22
 */

class User {

    public $name;
    public $login;
    public $password;

    public function showInfo(/*$name, $login, $password*/){
        echo ('Hi User! <br> Your name: '.$this->name.'. You login: '.$this->login. '. You password: '.$this->password.'.<br><br>');
    }
}

$user1 = new User();
$user2 = new User();
$user3 = new User();


/*$user1->showInfo('Aaa', 'Bbb', 'Ccc');
$user2->showInfo('Ddd', 'Fff', 'Eee');
$user3->showInfo('Ggg', 'Hhh', 'Iii');*/
$user1->name = 'Aaa';
$user1->login = 'Bbb';
$user1->password = 'Ccc';
echo $user1->showInfo();

$user1->name = 'Ddd';
$user1->login = 'Eee';
$user1->password = 'Fff';
echo $user2->showInfo();

$user1->name = 'Ggg';
$user1->login = 'Hhh';
$user1->password = 'Iii';
echo $user3->showInfo();