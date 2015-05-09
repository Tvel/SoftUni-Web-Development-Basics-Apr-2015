<?php

class Page_Check {

    private static function _Checker($controller, $method){
        if (Parameters::get_controller() === $controller && Parameters::get_method() === $method) {
            return true;
        }
        return false;
    }
    private static function _AdminChecker($controller, $method){
        if(!Parameters::get_admin()) {
            return false;
        }
        if ( self::_Checker($controller,$method) ) {
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

    public static function Search(){
        return self::_Checker('blog','search');
    }

    public static function NewPost(){
        return self::_Checker('blog','newpost');
    }

    public static function UserProfile(){
        return self::_Checker('user','profile');
    }

    public static function MyProfile(){
        return self::_Checker('user','myprofile');
    }

    public static function MyPosts(){
        return self::_Checker('user','myposts');
    }

    public static function EditPost(){
        return self::_Checker('blog','editpost');
    }

    public static function Login(){
        return self::_Checker('user','login');
    }

    public static function Register(){
        return self::_Checker('blog','register');
    }

    public static function AdminStats(){
        return self::_AdminChecker('blog','stats');
    }

    public static function AdminPosts(){
        return self::_AdminChecker('blog','posts');
    }

    public static function AdminEditPost(){
        return self::_AdminChecker('blog','editpost');
    }

    public static function AdminComments(){
        return self::_AdminChecker('blog','comments');
    }

    public static function AdminEditComment(){
        return self::_AdminChecker('blog','editcomment');
    }

    public static function AdminUsers(){
        return self::_AdminChecker('blog','users');
    }

    public static function AdminEditUser(){
        return self::_AdminChecker('blog','edituser');
    }

}