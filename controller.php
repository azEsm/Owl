<?php

require_once("DatabaseFactory.php");

$base = DatabaseFactory::getDatabase();

  if(isset($_GET['id'])) {
	
	$_SESSION['id']=$_GET['id'];
	$_SESSION['show']=1;
  }

/* Для добавление записи, на всякий */
  elseif (isset($_POST['add']))
  {
		$_SESSION['add']=1;	  
  }
/* Конец для добавления записи  */

/* Добавление записи */
  if (isset($_POST['send']))
  {
        $base->addMessage($_POST['name'], $_POST['subject'], $_POST['message']);

	$_SESSION['name']=$_POST['name'];
	$_SESSION['added']=1;	  

	header('Location: ' . "index.php");  
  }
/* Конец добавления записи  */

/* Данные для формы редактирования */
  elseif (isset($_POST['edit']))
  {
	$messages = $base->getById($_POST['id']);

	$_SESSION['doedit']=1;
  }
/* Конец данных для формы редактирования */

/* Редактирование */  
  elseif (isset($_POST['update']))
  {
        $base->updateMessage($_POST['id'], $_POST['subject'], $_POST['message']);

	$_SESSION['name']=$_POST['name'];
	$_SESSION['edit']=1;

	header('Location: ' . "index.php");
  }
/* Конец редактирования */

/* Удаление записи */
  elseif (isset($_POST['delete']))
  {
        $messages = $base->getById($_POST['id']);

	$_SESSION['name']=$messages['name'];

	$base->delete($_POST['id']);

	$_SESSION['delete']=1;

	header('Location: ' . "index.php");
  }
/* Конец удаления записи */



/* Данные для формы отображения */
  else
  {
    $mess = $base->getList();
  }
/* Конец данных для формы отображения */

?>