<?php

require_once("config.php");

  $admin_contact = "v.kirill.01@gmail.com"; // Administrator e-mail
  $def_email = "v.kirill.01@gmail.com";

  $base_dir = 'test'; // Directory of site

  $base_href = 'http://'.$_SERVER['SERVER_NAME'];

// Connecting to database
  $dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
  if (!$dbcnx) showError( "(MySQL) #".mysql_errno(), mysql_error());
  if (! @mysql_select_db($dbname,$dbcnx) ) showError( "(MySQL) #".mysql_errno(), mysql_error() );

  $query = "SET CHARACTER SET utf8";
  $prev = mysql_query($query);

function showError($err_header, $err_message)
{
  echo '<div style="font-family: Arial, Helvetica, sans-serif; width:500px; border-color: #cc0000; border-width: 2px;	border-style:solid; background-color: #ffffff;">
<div style="padding:5px; font-size: 20px; font-weight: bold; color: #ffffff; background-color: #cc0000;"><img src="images/error.png" width=16 height=16 />&nbsp;Error ',$err_header,'</div>
<div style="padding:5px; font-size: 14px; color: #000000; background-color: #ffffff;">',$err_message,'<br>Please contact to <a href="mailto:',$GLOBALS["admin_contact"],'">site administrator</a></div></div>';
  exit();
}

/* Функция добавления записи */

function addMessage($name, $subject, $message)
{
    $sql_query = "INSERT INTO `messages` ( `name` , `subject` , `message` ) VALUES ( '".$name."', '".$subject."', '".$message."' );";
    $query = mysql_query($sql_query);
    if(!$query) showError("(MySQL) #".mysql_errno(), '<div>'.$sql_query.'</div>'.mysql_error());
}

/* Конец функции для добавления записи */

/* Функция редактирования */

function updateMessage($id, $subject, $message)
{
    $sql_query = "UPDATE `messages` SET `subject`='".$subject."', `message`='".$message."' WHERE `id`='".$id."'";
    $query = mysql_query($sql_query);
    if(!$query) showError("(MySQL) #".mysql_errno(), '<div>'.$sql_query.'</div>'.mysql_error());
}

/* Конец функции редактирования */

/* Функция выбора сообщения по ID */

function getById($id)
{
    $sql_query = "SELECT * FROM `messages` WHERE `id`='".$id."'";
    $query = mysql_query($sql_query);
    if(!$query) showError("(MySQL) #".mysql_errno(), '<div>'.$sql_query.'</div>'.mysql_error());
    $i = mysql_fetch_array($query);
    
    $messages = array("id"=>$i['id'], "name" => $i['name'], "subject" => $i['subject'], "message" => $i['message']);
    return $messages;
}

/* Конец функции выбора сообщения по ID */

/* Функция удаления записи */

function delete($id)
{
    $sql_query = "DELETE FROM `messages` WHERE `id`='".$id."'";
    $query = mysql_query($sql_query);
    if(!$query) showError("(MySQL) #".mysql_errno(), '<div>'.$sql_query.'</div>'.mysql_error());
}

/* Конец функции удаления записи */

/* Функция списка сообщений */

function getList() {
    $sql_query = "SELECT id, name, subject FROM `messages` ORDER BY ID DESC" ;
    $query = mysql_query($sql_query);
    if(!$query) showError("(MySQL) #".mysql_errno(), '<div>'.$sql_query.'</div>'.mysql_error());
    
    if (mysql_num_rows($query) > 0)
    {
        while($messages = mysql_fetch_array($query))
        {
          $mess[$messages['id']] = 
          array("id"=>$messages['id'], "name" => $messages['name'], "subject" => $messages['subject']/*, "message" => $messages['message']*/);          
        }
    }
    return $mess;
}
/* Конец функции списка сообщений */

?>