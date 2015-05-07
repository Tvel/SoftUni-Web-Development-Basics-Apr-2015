<?php
/**
 * Created by PhpStorm.
 * User: Tosil
 * Date: 3.5.2015 г.
 * Time: 20:45 ч.
 */

class Parameters {

    public static $params;
    public static $controller;
    public static $method;
    public static $is_admin;

    public function __construct($params) {

        self::$params = $params;
    }

    public static function get($num) {

        if (!isset(self::$params[$num])){
            return null;
        }
        return self::$params[$num];
    }

    public static function get_controller() {

        return self::$controller;
    }

    public static function get_method() {

        return self::$method;
    }

    public static function set_controller($controller) {

        self::$controller = $controller;
    }

    public static function set_method($method) {

        self::$method = $method;
    }

    public static function set_admin($admin) {

        self::$is_admin = $admin;
    }

    public static function get_admin() {

        return self::$is_admin;
    }



}