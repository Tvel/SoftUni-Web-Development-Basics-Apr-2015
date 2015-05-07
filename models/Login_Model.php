<?php

class Login_Model {

    public function Login($username, $password){
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

    public function Logout(){

        unset($_SESSION['userId']);
        unset($_SESSION['userUsername']);
        unset($_SESSION['userEmail']);
    }

    public function Register($username, $password, $email) {

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

        $this->Login($user->username, $user->password);
    }
}