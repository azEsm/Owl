<?php

require_once("readprop.php");

class MySqlBase 
{
  
  public static $admin_contact = "test@test.te"; // Administrator e-mail
  public static $def_email = "test@test.te";
  public static $base_dir = 'test'; // Directory of site

/* Connecting to database */

function __construct()
{
  $BaseConfig = readprop("config.properties");
  $dbcnx = @mysql_connect($BaseConfig['dblocation'],$BaseConfig['dbuser'],$BaseConfig['dbpasswd']);

  if (!$dbcnx) $this->showError( "(MySQL) #".mysql_errno(), mysql_error());
  if (! @mysql_select_db($BaseConfig['dbname'],$dbcnx) ) $this->showError( "(MySQL) #".mysql_errno(), mysql_error() );

  $query = "SET CHARACTER SET utf8";
  $prev = mysql_query($query);
}

/* End of Connecting to database */

public function showError($err_header, $err_message)
{
  echo '<div style="font-family: Arial, Helvetica, sans-serif; width:500px; border-color: #cc0000; border-width: 2px;	border-style:solid; background-color: #ffffff;">
<div style="padding:5px; font-size: 20px; font-weight: bold; color: #ffffff; background-color: #cc0000;"><img src="images/error.png" width=16 height=16 />&nbsp;Error ',$err_header,'</div>
<div style="padding:5px; font-size: 14px; color: #000000; background-color: #ffffff;">',$err_message,'<br>Please contact to <a href="mailto:',self::$admin_contact,'">site administrator</a></div></div>';
  exit();
}

/* Add Message function */

public function addMessage($name, $subject, $message)
{
    $sql_query = "INSERT INTO `messages` ( `name` , `subject` , `message` ) VALUES ( '".$name."', '".$subject."', '".$message."' );";
    $query = mysql_query($sql_query);
    if(!$query) $this->showError("(MySQL) #".mysql_errno(), '<div>'.$sql_query.'</div>'.mysql_error());
}

/* End of Add Message function */

/* Edit Message function */

public function updateMessage($id, $subject, $message)
{
    $sql_query = "UPDATE `messages` SET `subject`='".$subject."', `message`='".$message."' WHERE `id`='".$id."'";
    $query = mysql_query($sql_query);
    if(!$query) $this->showError("(MySQL) #".mysql_errno(), '<div>'.$sql_query.'</div>'.mysql_error());
}

/* End of Edit Message function */

/* Get Message by ID function */

public function getById($id)
{
    $mess = array();
    $sql_query = "SELECT * FROM `messages` WHERE `id`='".$id."'";
    $query = mysql_query($sql_query);
    if(!$query) $this->showError("(MySQL) #".mysql_errno(), '<div>'.$sql_query.'</div>'.mysql_error());
    $i = mysql_fetch_array($query);
    
    $mess = array("id"=>$i['id'], "name" => $i['name'], "subject" => $i['subject'], "message" => $i['message']);
    return $mess;
}

/* End of Get Message by ID function */

/* Delete Message function */

public function delete($id)
{
    $sql_query = "DELETE FROM `messages` WHERE `id`='".$id."'";
    $query = mysql_query($sql_query);
    if(!$query) $this->showError("(MySQL) #".mysql_errno(), '<div>'.$sql_query.'</div>'.mysql_error());
}

/* End of Delete Message function */

/* Messages List function */

public function getList() 
{
    $mess = array();
    $sql_query = "SELECT id, name, subject FROM `messages` ORDER BY ID DESC" ;
    $query = mysql_query($sql_query);
    if(!$query) $this->showError("(MySQL) #".mysql_errno(), '<div>'.$sql_query.'</div>'.mysql_error());
    
    if (mysql_num_rows($query) > 0)
    {
        while($messages = mysql_fetch_array($query))
        {
          $mess[$messages['id']] = 
          array("id"=>$messages['id'], "name" => $messages['name'], "subject" => $messages['subject']);          
        }
    }
    return $mess;
}
/* End of Messages List function */

/* Add User function */

public function addUser($name, $pass)
{
    $sql_query_check = "SELECT name FROM `users` WHERE `name`='".$name."'";
    $query_check = mysql_query($sql_query_check);
    if(!$query_check) $this->showError("(MySQL) #".mysql_errno(), '<div>'.$sql_query_check.'</div>'.mysql_error());
    
    $user = mysql_fetch_array($query_check);
    $result = 0;

    if ($user == "")
    {    
        $sql_query = "INSERT INTO `users` ( `name` , `pass` ) VALUES ( '".$name."', '".$pass."' );";
        $query = mysql_query($sql_query);
        if(!$query) $this->showError("(MySQL) #".mysql_errno(), '<div>'.$sql_query.'</div>'.mysql_error());
        
        $result = 1;
    }
    
    return $result;
}

/* End of Add User function */

/* Check User function */

public function checkUser($name, $pass)
{
    $sql_query = "SELECT pass FROM `users` WHERE `name`='".$name."'";
    $query = mysql_query($sql_query);
    if(!$query) $this->showError("(MySQL) #".mysql_errno(), '<div>'.$sql_query.'</div>'.mysql_error());
    
    $user = mysql_fetch_array($query);
        
    if ($user == "")
    {
        $result = 1;
    }
    elseif ($pass == $user['pass'])
    {
        $result = 2;
    }
    else
    {
        $result = 3;
    }
    
    return $result;
}

/* End of Check User function */

}
?>
