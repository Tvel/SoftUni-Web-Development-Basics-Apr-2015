<?php

class Database
{
    public static $instance;
    private $db;
    public function __construct( $db_host, $db_name, $db_login, $db_pass) {
        $this->db = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_login, $db_pass);
        self::$instance = $this->db;
    }

    public static function get() {
        if (self::$instance === null) {

            die('something happened to db');
            //self::$instance = new self();
        }
        return self::$instance;
    }


}