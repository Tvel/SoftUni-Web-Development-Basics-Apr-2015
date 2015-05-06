<?php

class Auth_Check {
    public static function OnlyAdmin(){
        if (!isset($_SESSION['userId'] )){
            return false;
        }
        if ($_SESSION['userRole'] === R::enum('role:admin')->name) {
            return true;
        }
        return false;
    }

    public static function Poster(){
        if (!isset($_SESSION['userId'] )){
            return false;
        }
        if ($_SESSION['userRole'] === R::enum('role:admin')->name) {
            return true;
        }
        if ($_SESSION['userRole'] === R::enum('role:poster')->name) {
            return true;
        }
        return false;
    }

    public static function Moderator(){
        if (!isset($_SESSION['userId'] )){
            return false;
        }
        if ($_SESSION['userRole'] === R::enum('role:admin')->name) {
            return true;
        }
        if ($_SESSION['userRole'] === R::enum('role:poster')->name) {
            return true;
        }
        if ($_SESSION['userRole'] === R::enum('role:moderator')->name) {
            return true;
        }
        return false;
    }

    public static function Regular(){
        if (!isset($_SESSION['userId'] )){
            return false;
        }
        return true;
    }

}