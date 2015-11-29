<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 21.11.15
 * Time: 20:04
 */


class User {

    public function __construct($name, $login, $password){
            echo 'Hi User! <br> Your name: '.$name.'. You login: '.$login. '. You password: '.md5($password);
    }

    private function __toString() {
        return $this->__construct();
    }

    public function showInfo(){
        echo 'Secret info. ';
    }

}
class SuperUser extends User {

        public function __construct($role){
            if (!empty($role)){
                $data = parent::__construct('a', 'b', 'c');
                echo $data.' You role: '.$role.'<br>';
            } else {
                echo 'Введите роль';
            }
        }

        public function showInfo($role){
            $showInfo = parent::showInfo();
            echo $showInfo.' You role: '.$role;
        }

}

$userN = new SuperUser('d');
$userN->showInfo('root');