<?php
session_start();
require_once("controller.php");
?>

<html>
<head></head>
<body>

<?php

if (isset($_SESSION['added']) and isset($_SESSION['name']))
{
  echo '<font color="red"><b>'.$_SESSION['name'].'</b>, your message has been successfully added. Be happy!</font>';
  unset($_SESSION['add']);
  unset($_SESSION['name']);
}

elseif (isset($_SESSION['edit']) and isset($_SESSION['name']))
{
  echo '<font color="red"><b>'.$_SESSION['name'].'</b>, your message has been successfully edited. Be happy!</font>';
  unset($_SESSION['edit']);
  unset($_SESSION['name']);
}

elseif (isset($_SESSION['delete']) and isset($_SESSION['name']))
{
  echo '<font color="red"><b>'.$_SESSION['name'].'</b>, your message has been successfully deleted. Be happy!</font>';
  unset($_SESSION['delete']);
  unset($_SESSION['name']);
}

elseif(isset($_SESSION['registered']) and isset($_SESSION['name']))
{
  echo '<font color="red"><b>'.$_SESSION['name'].'</b>, you are successfully registered. Now you can Sign In.</font>';
  unset($_SESSION['registered']);
  unset($_SESSION['name']);
}

elseif(isset($_SESSION['signin']) and isset($_SESSION['name']))
{
  echo '<font color="red">Hello, <b>'.$_SESSION['name'].'</b>. Nice to meet you!</font>';
}

?>

<br><a href="signin.php" target="_self">Sign In</a><br><br>

<form action="edit.php" method="post">
<input type="submit" name="add" value="Add message" />
</form>

<h2>Messages</h2><hr>


<?php

if (isset($mess) && empty($_SESSION['show']))
{
  foreach($mess as $id => $mess)
  {

echo '
<b>'.$mess['name'].'</b> is under <b>'.$mess['subject'].'</b><br>
<a href="index.php?id='.$mess['id'].'">Read</a><hr>';

  }
}

elseif(isset($_SESSION['show'])) {

$mess = $base->getById($_GET['id']);

echo '<form action="edit.php" method="post">
<b>'.$mess['name'].'</b> is under <b>'.$mess['subject'].'</b><br>
<p>'.nl2br($mess['message']).'</p>
<input type="hidden" name="id" value="'.$mess['id'].'">
<input type="submit" name="edit" value="I changed my mind">
<input type="submit" name="delete" value="Delete"><br>
<a href="index.php">Back to the primitive</a>
<hr></form>';

unset($_SESSION['show']);
unset($_SESSION['id']);

}

else {
  echo '<b>No messages. You can be first!</b><br>';
}
?>


</body>
</html>
