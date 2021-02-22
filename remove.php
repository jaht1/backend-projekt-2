<?php $conn = create_conn();?>

<article>
<form action="index.php" method="post">
Ange ditt lösenord för att radera din kontaktannons:
<input type="password" name="pswrd"><br>
<input type="hidden" name="stage" value="delete">
<input type='submit' value='Radera'>
</form>



<?php
print($_SESSION['user']);
$conn = create_conn();
if (isset($_REQUEST['stage']) && ($_REQUEST['stage'] == 'delete')) {

    $conn = create_conn();
    $passw = $_REQUEST['pswrd'];
    $password = hash("sha256", $passw);
    $username = $_SESSION['user'];
    $sql = "SELECT * FROM users";

    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            if ($row['username'] == $username) {
                if ($row['password'] == $password) {
                    print("<p>Kontot raderas...</p>");
                    $del = "DELETE FROM users WHERE username='$username'";

                    if (mysqli_query($conn, $del)) {
                        echo "<p><b>Kontot har raderats.</b></p>";
                        header("refresh:2;url=./index.php");
                    } else {
                        echo "<p style='color:red;>Problem med att radera kontot: " . mysqli_error($conn) . "</p>";
                    }
                    //mysqli_close($conn);
                    
                } 
                else {
                    print("<p style='color:red;''>Lösenordet är fel. Det gick inte att radera ditt konto. </p><br>");
                    break;
                }

            }
        }
    }
    print("</article>");
}
