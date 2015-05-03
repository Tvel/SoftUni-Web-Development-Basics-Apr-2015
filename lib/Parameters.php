<?php
/**
 * Created by PhpStorm.
 * User: Tosil
 * Date: 3.5.2015 г.
 * Time: 20:45 ч.
 */

class Parameters {

    public static $params;

    public function __construct($params) {

        self::$params = $params;
    }

    public static function get($num) {

        return self::$params[$num];
    }
}