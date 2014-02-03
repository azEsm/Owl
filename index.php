<?php
session_start();
require_once("controller.php");
?>

<html>
<head></head>
<body>

<?php

if(isset($_SESSION['auth']))
{

if (isset($_SESSION['added']))
{
  echo '<font color="red"><b>'.$_SESSION['name'].'</b>, your message has been successfully added. Be happy!</font>';
  unset($_SESSION['added']);
}

elseif (isset($_SESSION['edit']))
{
  echo '<font color="red"><b>'.$_SESSION['name'].'</b>, your message has been successfully edited. Be happy!</font>';
  unset($_SESSION['edit']);
}

elseif (isset($_SESSION['delete']))
{
  echo '<font color="red"><b>'.$_SESSION['name'].'</b>, your message has been successfully deleted. Be happy!</font>';
  unset($_SESSION['delete']);
}

elseif(isset($_SESSION['registered']))
{
  echo '<font color="red"><b>'.$_SESSION['name'].'</b>, you are successfully registered. Now you can Sign In.</font>';
  unset($_SESSION['registered']);
}

elseif(isset($_SESSION['signin']))
{
  echo '<font color="red">Hello, <b>'.$_SESSION['name'].'</b>! Nice to meet you!</font>';
  unset($_SESSION['signin']);
}
else
{
  echo '<font color="red"><b>'.$_SESSION['name'].'</b></font>';
}

?>

<br><a href="controller.php?signout=1" target="_self">Sign Out</a><br><br>

<form action="edit.php" method="post">
<input type="submit" name="add" value="Add message" />
</form>

<?php
}
else
{
?>

<a href="signin.php" target="_self">Sign In</a> | 
<a href="signin.php?reg=1" target="_self">Register</a><br><br>

<?php
}

if (isset($mess) && empty($_SESSION['show']))
{

?>

<h2>Messages</h2><hr>

<?php
  foreach($mess as $id => $mess)
  {

echo '
<b>'.$mess['name'].'</b> is under <b>'.$mess['subject'].'</b><br>
<a href="index.php?id='.$mess['id'].'">Read</a><hr>';

  }
}

elseif(isset($_SESSION['show'])) {

$mess = $base->getById($_GET['id']);
?>

<form action="edit.php" method="post">
<hr>

<b><?php echo $mess['name'];?></b> is under <b><?php echo $mess['subject'];?></b><br>
<hr>

<p><?php echo nl2br($mess['message']);?></p>
<input type="hidden" name="id" value="<?php echo $mess['id'];?>">

<?php

if($_SESSION['name'] == $mess['name'])
{

?>

<input type="submit" name="edit" value="I changed my mind">
<input type="submit" name="delete" value="Delete"><br>

<?php
}
?>

<a href="index.php">Back to the primitive</a>
<hr></form>

<?php
unset($_SESSION['show']);
unset($_SESSION['id']);

}

else {
  echo '<b>No messages. You can be first!</b><br>';
}
?>


</body>
</html>
