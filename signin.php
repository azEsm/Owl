<?php session_start(); ?>

<html>
    <head>
    </head>
    <body>

<a href="index.php" target="_self">Main Page</a><br><br>

<?php

if(isset($_SESSION['registrationerror']) and isset($_SESSION['name']))
{
  echo '<font color="red"><b>'.$_SESSION['name'].'</b>, '.$_SESSION['registrationerror'].'</font><br>';
  unset($_SESSION['registrationerror']);
  unset($_SESSION['name']);
}

elseif(isset($_SESSION['signinerror']) and isset($_SESSION['name']))
{
  echo '<font color="red"><b>'.$_SESSION['name'].'</b>, '.$_SESSION['signinerror'].'</font><br>';
  unset($_SESSION['signinerror']);
  unset($_SESSION['name']);
}

?>

<form action="controller.php" method="post">
    Name: <input type="text"  maxlength="8" name="name" /><br />
    Password: <input type="password" maxlength="30" name="pass" /><br />

<?php

if(isset($_GET['reg']))
{

?>
    <input type="submit" name="register" value="Register" />

<?php
}

else
{

?>

    <input type="submit" name="signin" value="Sign In" />

<?php
}
?>
    
</form>

    </body>
</html>
