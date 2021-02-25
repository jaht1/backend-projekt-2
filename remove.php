<?php $conn = create_conn();?>

<article>
<form action="index.php" method="post">
Ange ditt lösenord för att radera din kontaktannons:<br>
<input type="password" name="pswrd"><br>
<input type="hidden" name="stage" value="delete">
<input type='submit' value='Radera'>
</form>



<?php
//print($_SESSION['user']);
$conn = create_conn();
if (isset($_REQUEST['stage']) && ($_REQUEST['stage'] == 'delete')) {

    $conn = create_conn();
    $passw = $_REQUEST['pswrd'];
    $password = hash("sha256", $passw);
    $user = $_SESSION['user'];

    $sql = "SELECT * FROM users WHERE username=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();

    $result = $stmt->get_result();

    $row = $result->fetch_assoc();

    if ($row['password'] == $password) {
        $statement = $conn->prepare("DELETE FROM users WHERE username=?");
        $statement->bind_param("s", $user);
        $statement->execute();
        if ($statement->execute()) {
            echo "Användaren har raderats.";
            session_destroy();
            header("refresh:2;url=./index.php");
        } else {
            echo "Något problem uppstod: " . $mysqli->errno;
        }
    } else {
        echo "Fel lösenord.";
    }

    $statement->close();
    print("</article>");
}
/* $sql = "SELECT * FROM users";

if ($result = $conn->query($sql)) {
while ($row = $result->fetch_assoc()) {
if ($row['username'] == $username) {
if ($row['password'] == $password) {
print("<p>Kontot raderas...</p>");
$del = "DELETE FROM users WHERE username='$username'";

/*$statement = $conn->prepare("DELETE users WHERE username=?");
$statement->bind_param("s", $username);

$statement->execute();
if (mysqli_query($conn, $del)) {
//if ($statement->execute()) {
session_destroy();
echo "<p><b>Kontot har raderats.</b></p>";

header("refresh:2;url=./index.php");
} else {
echo "<p style='color:red;>Problem med att radera kontot: " . mysqli_error($conn) . "</p>";
}
$statement->close();
//mysqli_close($conn);

} else {
print("<p style='color:red;''>Lösenordet är fel. Det gick inte att radera ditt konto. </p><br>");
break;
}

}
}
}*/
