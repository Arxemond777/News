<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 21.11.15
 * Time: 20:46
 */

class MyClass {

    function __autoload($class_name1, $class_name2, $class_name3){
        require $class_name1.'.php';
        require $class_name2.'.php';
        require $class_name3.'.php';
    }

}

$obj = new MyClass();
$obj->__autoload('lab1.8.classAbstract', 'lab1.8.classInterface', 'lab1.4');

/*abstract class AUser {

    abstract function showInfo($name, $login, $password);

}

class User extends AUser {

    function showInfo($name, $login, $password){
        echo ('Hi User! <br> Your name: '.$name.'. You login: '.$login. '. You password: '.$password.'.<br><br>');
    }

}

$obj = new User();
$obj->showInfo('a', 'b', 'c');*/



/**
    part 2
 */

/*interface ISuperUser {
    public function getInfo($name, $login, $password);
}

class SuperUser implements ISuperUser {

    public $role;

    public function getInfo($name, $login, $password){
        if (password_verify('qwerty', $password) == true){
            $data_array = array(
                'You name: ' => $this->$name,
                'You name login: ' => $login,
                'You password: ' => crypt($password, password_hash($password, PASSWORD_BCRYPT)),
                'You role: ' => $this->role
            );
            print_r($data_array);
        }
    }

}

$objSU = new SuperUser();
$objSU->role = 'admin';$objSU->getInfo('Yuri', 'Yuri1994', password_hash('qwerty', PASSWORD_BCRYPT));
$objSU1 = new SuperUser();
$objSU1->role = 'admin1';
$objSU1->getInfo('Hacker', 'DefinitelyNotHacker', password_hash('qwerty', PASSWORD_BCRYPT));*/