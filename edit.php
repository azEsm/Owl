<?php
  session_start();
  require_once("controller.php");
  if (isset($_SESSION['add'])){
/* Форма для добавления записи */
?>
<form action="edit.php" method="post">

Name: <input type="text" name="name" /><br />

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
<input type="hidden" name="id" value="<?php echo $messages['id']?>">
<input type="hidden" name="name" value="<?php echo $messages['name']?>">
Name: <input type="text" name="name" value="<?php echo $messages['name']?>" disabled><br>

<?php
}
/* Конец формы для редактирования */

else header('Location: ' . "index.php");//Для залётных
?>

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
