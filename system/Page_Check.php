<?php

class Page_Check {

    private static function _Checker($controller, $method){
        if (Parameters::get_controller() === $controller && Parameters::get_method() === $method) {
            return true;
        }
        return false;
    }

    public static function Home(){
        return self::_Checker('blog','index');
    }

    public static function TagPosts(){
        return self::_Checker('blog','tag');
    }

    public static function DatePosts(){
        return self::_Checker('blog','date');
    }

    public static function NewPost(){
        return self::_Checker('blog','newpost');
    }

    public static function UserProfile(){
        return self::_Checker('user','profile');
    }

    public static function Login(){
        return self::_Checker('user','login');
    }

    public static function Register(){
        return self::_Checker('blog','register');
    }

}