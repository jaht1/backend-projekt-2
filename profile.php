<?php include "init.php"?>
<?php include "head.php"?>
<?php $conn = create_conn();?>


<article>

<?php
// Här hämtar vi användarens data

if ($_SESSION['user'] == $_GET['user']) {
    //print($_GET['user']);
    $prefArray = ['', 'Man', 'Kvinna', 'Annan', 'Båda', 'Alla'];
    $conn = create_conn(); // mysqli objektet skapas
    //echo $row['username'];
    $user = $_SESSION['user']; //Kolla vem som är inloggad
    $sql = "SELECT * FROM users WHERE username = ?"; // ? placeholder för data

    $stmt = $conn->prepare($sql); // prepare returnerar mysqli_stmt objekt
    $stmt->bind_param("s", $user); //mata nu först in användarinmatad data i sql
    $stmt->execute(); //returnerar true eller false (lyckades köra på JB eller ej)

    $result = $stmt->get_result(); //Returnerar datan i form av mysqli_result objekt

    $row = $result->fetch_assoc(); // Ta ut datan från mysqli_result objektet till en associativ array

    // print("test");
    //while ($row = $result->fetch_assoc()) {
        print("<h1> " . $row['realname'] . "</h1>");
    print("<form action='profile.php?user=". $user . "' method='post'>");
    print("Användarnamn: <br><input type='text' name='usr' value='" . $row['username'] . "'required>");
    print("<p>Riktiga namnet: <br><input type='text' name='rlname' value='" . $row['realname'] . "'></p>");
    print("<p>Email: <br><input type='text' name='email' value='" . $row['email'] . "'required></p>");
    print("<p>Postnummer: <br><input type='text' name='zip' value='" . $row['zipcode'] . "'></p>");

    print("<p>Annonstext: <br><input type='text' name='bio' value='" . $row['bio'] . "'></p>");
    //print("<p>Postnummer: <br><input type='text' name='zip' value='" . $row['zip'] . "'></p>");
    print("<p>Lön: <br><input type='text' name='salary' value='" . $row['salary'] . "'>€/år</p>");
    print("<p>Preferens: <br> <input type='text' name='preference' value='" . $row['preference'] . "'required></p>");
    //print("id: " . $row['id']);
    print("<input type='submit' value='Uppdatera din profil'/>");
    print("</form>");
    $id = $row['id'];
    //}


    //sätt ny session user

    if (isset($_REQUEST['usr']) && isset($_REQUEST['email'])) {

        $conn = create_conn();

        $username = test_input($_REQUEST['usr']);
        $realname = test_input($_REQUEST['rlname']);
        $email = test_input($_REQUEST['email']);
        $zip = test_input($_REQUEST['zip']);
        $bio = test_input($_REQUEST['bio']);
        $salary = test_input($_REQUEST['salary']);
        $preference = test_input($_REQUEST['preference']);


        
        $statement = $conn->prepare("UPDATE users SET username=?, realname=?, email=?, zipcode=?, bio=?, salary=?, preference=? WHERE id=?");
        $statement->bind_param("sssisiii", $username, $realname, $email, $zip, $bio, $salary, $preference, $id);

        $statement->execute();
        if ($statement->execute()) {
            $_SESSION['user'] = $username;
            echo "<p style='color: green'>Informationen uppdaterad.</p>";
            header("Refresh:1");
        } else {
            echo "<p style='color: red'>Något gick fel: " . $mysqli->errno . "</p>";
            //die('Error : (' . $mysqli->errno . ') ' . $mysqli->error);
        }
        $statement->close();
    } else {
        echo "Ange minst användarnamn och email.";
    }

} else {

    $prefArray = ['', 'Man', 'Kvinna', 'Annan', 'Båda', 'Alla'];
    $conn = create_conn(); // mysqli objektet skapas
    //echo $row['username'];
    $user = $_GET['user']; //Kolla vem som är inloggad
    $sql = "SELECT * FROM users WHERE username = ?"; // ? placeholder för data

    $stmt = $conn->prepare($sql); // prepare returnerar mysqli_stmt objekt
    $stmt->bind_param("s", $user); //mata nu först in användarinmatad data i sql
    $stmt->execute(); //returnerar true eller false (lyckades köra på JB eller ej)

    $result = $stmt->get_result(); //Returnerar datan i form av mysqli_result objekt

    $row = $result->fetch_assoc();
    
    
    print("<h1> " . $row['realname'] . "</h1>");
    print("<p >Användarnamn: <br> <b>" . $row['username'] . "</b></p>");
    
    if (isset($_SESSION['user'])) {
        
        print("<p>Email: <br><b>" . $row['email'] . "</b></p>");
        print("<p>Lön: <br><b>" . $row['salary'] . "€/år</b></p>");
    }
    print("<p>Postnummer: <br> <b>" . $row['zip'] . "</b></p>");
    print("<p>Preferens: <br><b>" . $prefArray[$row['preference']] . "</b></p>");
    print("<p>Bio: <br><b>" . $row['bio'] . "</b></p>");

    if(!isset($_SESSION['user'])){
        print("<br><p><a class= 'link' href='index.php?stage=signin'><b><u>Logga in för att se användarens email och lön.</u></b></a></p>");
    }
    //TODO: kommentarsformulär
    //För att hitta kommentarerna för en viss profil måste ni hitta idn för profilen
    //SELECT id, username FROM users HWERE username = $_REQUEST['user];
    //SELECT comment FROM comment WHERE profile_id = $row['id];
}
?>
<!--<input type="button" value = "Modifiera">-->

</article>


<?php include "footer.php"?>


