<?php
session_start();
require_once("DatabaseFactory.php");

$base = DatabaseFactory::getDatabase();

  if(isset($_GET['id'])) {
	
	$_SESSION['id']=$_GET['id'];
	$_SESSION['show']=1;
  }

/* For Deleting of message just in case */
  elseif (isset($_POST['add']))
  {
		$_SESSION['add']=1;	  
  }
/* End of For deleting of message  */

/* Adding of message */
  elseif (isset($_POST['send']))
  {
        $base->addMessage($_POST['name'], $_POST['subject'], $_POST['message']);

	$_SESSION['name']=$_POST['name'];
	$_SESSION['added']=1;	  

	header('Location: ' . "index.php");  
  }
/* End of Adding of message  */

/* Data for Edit form */
  elseif (isset($_POST['edit']))
  {
	$messages = $base->getById($_POST['id']);

	$_SESSION['doedit']=1;
  }
/* End of Data for Edit form */

/* Editing */  
  elseif (isset($_POST['update']))
  {
        $base->updateMessage($_POST['id'], $_POST['subject'], $_POST['message']);

	$_SESSION['name']=$_POST['name'];
	$_SESSION['edit']=1;

	header('Location: ' . "index.php");
  }
/* End of Editing */

/* Deleting of message */
  elseif (isset($_POST['delete']))
  {
        $messages = $base->getById($_POST['id']);

	$_SESSION['name']=$messages['name'];

	$base->delete($_POST['id']);

	$_SESSION['delete']=1;

	header('Location: ' . "index.php");
  }
/* End of Deleting of message */

/* Adding of user */
  elseif (isset($_POST['register']))
  {
      $base->addUser($_POST['name'], md5(md5($_POST['pass'])));
      $_SESSION['registered'] = 1;
      $_SESSION['name'] = $_POST['name'];
      header('Location: ' . "index.php");
  }
/* End of Adding of user */

/* Users check */
  elseif (isset($_POST['signin']))
  {
      $check = $base->checkUser($_POST['name'], md5(md5($_POST['pass'])));
      if ($check == 1)
      {
          $_SESSION['signinerror'] = "you should register before sign in.";
          $_SESSION['name'] = $_POST['name'];
          header('Location: ' . "signin.php"); 
      }
      elseif ($check == 2)
      {
          $_SESSION['signin'] = 1;
          $_SESSION['name'] = $_POST['name'];
          header('Location: ' . "index.php"); 
      }
      else
      {
          $_SESSION['signinerror'] = "you entered incorrect password. Try again.";
          $_SESSION['name'] = $_POST['name'];
          header('Location: ' . "signin.php");
      }
  }
/* End of Users check */ 

/* Data for messages list */
  else
  {
    $mess = $base->getList();
  }
/* End of Data for messages list */

?>
