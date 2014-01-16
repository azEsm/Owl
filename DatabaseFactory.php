<?php

require_once("base.php");

class DatabaseFactory {

    public static public function getDatabase()
    {
        $DataBase = new MySqlBase();
        return $DataBase;
    }    
}
?>