<?php 

class User {

    public function main(){
        echo 'Main '.'<br>';
    }

    public function self(){
        echo 'Self ';	
	    self::main();
    }

    public function stat(){
        echo 'Static ';
        static::main();
    }
}

class SUser extends User {
    
    public function main(){
        echo 'Children '.'<br>';
    }

}

$obj = new SUser;
$obj->main();
$obj->self();
$obj->stat();
