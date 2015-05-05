<?php

class Login_Model {

    public function login($username, $password){
        $user = R::findOne('users', 'username = ?' , [ $username ]);
        if (!isset($user)) {
            throw new InvalidLoginUsernameException("Invalid username");
        }
        if ($user->password !== $password) {
            throw new InvalidLoginPasswordException("Invalid password");
        }

        $_SESSION['userId'] = $user->id;
        $_SESSION['userUsername'] = $user->username;
        $_SESSION['userEmail'] = $user->email;
    }

    public function logout(){

        unset($_SESSION['userId']);
        unset($_SESSION['userUsername']);
        unset($_SESSION['userEmail']);
    }
}