<?php

class Login_Model {

    public function login($username, $password){
        $user = R::findOne('users', 'username = ?' , [ $username ]);



    }

    public function logout(){

    }
}