
<?php $conn = create_conn();?>


<form action="index.php" method="post">
Användarnamn:
<br><input type="text" name="usrn"><br>
Lösenord:
<br><input type="password" name="pswr"><br>
<input type="hidden" name="stage" value="login">
<input type='submit' value='Logga in'>
</form>
<?php
//if (isset($_REQUEST['usr']) && isset($_REQUEST['psw'])) {
if (isset($_REQUEST['stage']) && ($_REQUEST['stage'] == 'login')) {
    $wrongPass = false;
    $conn = create_conn();
    $password = $_REQUEST['pswr'];
    $password = hash("sha256", $password);
    $username = $_REQUEST['usrn'];

    $sql = "SELECT * FROM users";

    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            //print($row['username']);
            if ($row['username'] == $_REQUEST['usrn']) {

                if ($row['password'] == $password) {
                    $wrongpass == false;
                    print("<p style='color:green;''>loggar in om 2 sekunder...<a/></p><br>");
                    $_SESSION['user'] = $username;
                    //print("Hej igen ".$_SESSION['user']);
                    header("refresh:2;url=./profile.php");
                    //exit();
                    break;
                }

            } else {
                $wrongPass = true;

            }
        }

    } if ($wrongPass == true) {
        print("<p style='color:red;''>Användarnamn eller lösenord är fel. Försök igen. </p>");
    }
}

/*if (isset($_REQUEST['stage']) && ($_REQUEST['stage'] == 'login')) {
$conn = create_conn();

$username = $_REQUEST['usr'];
$password = $_REQUEST['psw'];
//$password = hash("sha256", $password);

$sql = "SELECT * FROM users WHERE username = $username AND password = $password";
//$sql = "SELECT * FROM users WHERE username = $username AND password = $password";
if ($result = $conn->query($sql)) {
while ($row = $result->fetch_assoc()) {
if ($row['username'] == $_REQUEST['usr']) {
print("<p style='color:red;''>Användarnamnet existerar redan. Vill du försöka <a href='index.php?stage=signin'> logga in? <a/></p><br>");
//$userExist = true;
}
}
} /*else {
print("fel användarnamn eller lösneord");
}

/*if(mysql_num_rows($query)){
$user = mysql_fetch_assoc($query);
print("loggar in om 2 sekunder...");
$_SESSION['user'] = $_REQUEST['usr'];
header("refresh:2;url=./profile.php");
}
//FIXA senare koden nedan

//Egen kod
else{
print("Fel användarnamn eller lösenord.");
}*/

/*$query = "SELECT `username` AND `password` FROM `users` WHERE `username` = '$username' and password = '$password'";

$result = $conn->query($query);
if($result->num_rows > 0) {
header('Location:welcome.php');
print("du är inloggad");
}
else $message = 'user does not exist';

/*print("loggar in om 2 sekunder...");
$_SESSION['user'] = $_REQUEST['usr'];
header("refresh:2;url=./profile.php");

//stäng inte php-tag i includes
}*/