<?php

require_once("base.php");

class DatabaseFactory 
{
    private static $database = false;

    public static public function getDatabase()
    {
        if($database == false)
        {
            self::$database = true;
            $DataBase = new MySqlBase();
            return $DataBase;
        }
    }    
}

?>
