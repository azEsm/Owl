<?php
  session_start();
  
  if(isset($_SESSION['auth']))
  {
      require_once("controller.php");

/* Форма для добавления записи */
      if (isset($_SESSION['add']))
      {
          unset($_SESSION['add']);
?>
<form action="edit.php" method="post">

<input type="hidden" name="send" >

<?php
      }
/* Конец формы для добавления записи */

/* Форма для редактирования */
      elseif (isset($_SESSION['doedit']))
      {

          unset($_SESSION['doedit']);?>

<form action="edit.php" method="post">

<input type="hidden" name="update" >
<input type="hidden" name="id" value="<?php echo $messages['id']; ?>">
<input type="hidden" name="name" value="<?php echo $messages['name']; ?>">

<?php
      }
/* Конец формы для редактирования */

      else header('Location: ' . "index.php");//Для залётных
?>

Name: <input type="text" name="name" value="<?php echo $_SESSION['name']; ?>" disabled><br>

Subject: <select name="subject">
<option><?php echo $messages['subject']?></option>
<option>Denial</option>
<option>Anger</option>
<option>Bargaining</option>
<option>Depression</option>
<option>Acceptance</option>
</select><br />

Mesage: <textarea rows="5" cols="25" name="message" />
<?php echo trim($messages['message']); ?>
</textarea><br />

<input type="submit" value="send" />
</form>

<?php
  }
  
  else
  {
      header('Location: ' . "index.php");
  }

?>
