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

    public static function Moderator(){
        if (!isset($_SESSION['userId'] )){
            return false;
        }
        if ($_SESSION['userRole'] === R::enum('role:admin')->name) {
            return true;
        }
//        if ($_SESSION['userRole'] === R::enum('role:poster')->name) {
//            return true;
//        }
        if ($_SESSION['userRole'] === R::enum('role:moderator')->name) {
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


    public static function Regular(){
        if (!isset($_SESSION['userId'] )){
            return false;
        }
        return true;
    }

    public static function CheckIfOwnerOfUser($user) {
        if (!isset($_SESSION['userId'] )){
            return false;
        }

        if ($user->id === $_SESSION['userId']) {
            return true;
        }
        return false;
    }

    public static function CheckIfOwnerOfPost($post) {
        if (!isset($_SESSION['userId'] )){
            return false;
        }
        if ($post->users === null) {
            return false;
        }
        if ($post->users->id === $_SESSION['userId']) {
            return true;
        }
        return false;
    }

    public static function CheckIfOwnerOfComment($comment) {
        if (!isset($_SESSION['userId'] )){
            return false;
        }
        if ($comment->users === null) {
            return false;
        }
        if ($comment->users->id === $_SESSION['userId']) {
            return true;
        }
        return false;
    }

    public static function CheckIfCanEditUser($user) {
        if (!isset($_SESSION['userId'] )){
            return false;
        }
        if (self::CheckIfOwnerOfUser($user)) {
            return true;
        }
        if (self::OnlyAdmin()) {
            return true;
        }
        return false;
    }

    public static function CheckIfCanEditPost($post) {
        if (!isset($_SESSION['userId'] )){
            return false;
        }
        if (self::CheckIfOwnerOfPost($post)) {
            return true;
        }
        if (self::OnlyAdmin()) {
            return true;
        }
        return false;
    }

    public static function CheckIfCanEditComment($comment) {
        if (!isset($_SESSION['userId'] )){
            return false;
        }
        if (self::CheckIfOwnerOfComment($comment)) {
            return true;
        }
        if (self::Moderator()) {
            return true;
        }
        return false;
    }

    public static function CheckIfCanEditTags() {
        if (!isset($_SESSION['userId'] )){
            return false;
        }
        if (self::OnlyAdmin()) {
            return true;
        }
        return false;
    }

}