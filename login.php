<form action="index.php" method="post">
Användarnamn:
<br><input type="text" name="usr"><br>
Lösenord:
<br><input type="password" name="psw"><br>
<input type="hidden" name="stage" value="login">
<input type='submit' value='Logga in'>

<?php


if(isset($_REQUEST['stage']) && ($_REQUEST['stage'] == 'login')){
    print("loggar in om 2 sekunder...");
    //FIXA senare koden nedan
    $_SESSION['user'] = $_REQUEST['usr'];
    header("refresh:2;url=./profile.php"); //Redirect user on login
}
 //stäng inte php-tag i includes