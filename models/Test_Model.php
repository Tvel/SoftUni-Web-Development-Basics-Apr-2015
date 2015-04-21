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
        $this->db = Database::get();
    }

    public function get_test()
    {
        $db = Database::get();
        $handle = $db->prepare('select * from test');
        $handle->execute();
        $result = $handle->fetchAll(\PDO::FETCH_OBJ);
        return $result;
    }

}