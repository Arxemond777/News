<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 22.11.15
 * Time: 0:22
 */

interface ISuperUser {
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
$objSU1->getInfo('Hacker', 'DefinitelyNotHacker', password_hash('qwerty', PASSWORD_BCRYPT));