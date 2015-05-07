<?php

class Page_Check {

    public static function Home(){
        if (Parameters::get_controller() === 'blog' && Parameters::get_method() === 'index') {
            return true;
        }
        return false;
    }

    public static function NewPost(){
        if (Parameters::get_controller() === 'blog' && Parameters::get_method() === 'newpost') {
            return true;
        }
        return false;
    }

    public static function Login(){
        if (Parameters::get_controller() === 'user' && Parameters::get_method() === 'login') {
            return true;
        }
        return false;
    }

    public static function Register(){
        if (Parameters::get_controller() === 'user' && Parameters::get_method() === 'register') {
            return true;
        }
        return false;
    }

}