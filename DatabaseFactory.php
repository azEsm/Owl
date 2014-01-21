<?php

require_once("base.php");

class DatabaseFactory 
{
    private static $database = null;

    public static public function getDatabase()
    {
        if(is_null($database))
        {
            $database = new MySqlBase();
        }
        return $database;
    }    
}

?>
