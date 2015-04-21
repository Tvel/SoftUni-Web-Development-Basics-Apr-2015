<?php

class Database_PDO
{
    public static $instance;
    private $db;
    //public function __construct( $db_host, $db_name, $db_login, $db_pass) {
    public function __construct() {

        $db_host = DB_HOST;
        $db_login = DB_USERNAME;
        $db_pass = DB_PASSWORD;
        $db_name = DB_DATABASE;

        $this->db = new PDO('mysql:host='.$db_host.';dbname='.$db_name.';charset=utf8', $db_login, $db_pass);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        self::$instance = $this->db;
    }

    public static function get() {
        if (self::$instance === null) {

            //die('something happened to db');
            $class =  new self();
            self::$instance = $class::get();
        }
        return self::$instance;
    }


}