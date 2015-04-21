<?php
/**
 * Created by PhpStorm.
 * User: Tvel
 * Date: 21.4.2015 г.
 * Time: 4:32
 */

class Test_Model {

    private $db;
    public function __construct()
    {

    }

    public function get_test()
    {
//        $db = Database_PDO::get();
//        $handle = $db->prepare('select * from test');
//        $handle->execute();
        $result = R::findAll('test');
        return $result;
    }

}