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
        $_SESSION['userRole'] = $user->role->name;
    }

    public function logout(){

        unset($_SESSION['userId']);
        unset($_SESSION['userUsername']);
        unset($_SESSION['userEmail']);
    }

    public function register($username, $password, $email) {

        $user = R::findOne('users', 'username = ?' , [ $username ]);
        if (isset($user)) {
            throw new InvalidRegisterException("Username Exists");
        }
        $user = R::findOne('users', 'email = ?' , [ $email ]);
        if (isset($user)) {
            throw new InvalidRegisterException("Email Exists");
        }

        $user = R::dispense('users');
        $user->username = $username;
        $user->email = $email;
        $user->password = $password;
        $user->role = R::enum('role:regular');

        R::store($user);

        $this->login($user->username, $user->password);
    }
}