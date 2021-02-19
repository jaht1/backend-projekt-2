<?php include "init.php"?>
<?php include "head.php"?>

<article>
<h1>Profilsidan</h1>
<?php
// Här hämtar vi användarens data
//print($_SESSION['user']);

if (isset($_SESSION['user'])) {
    $conn = create_conn(); // mysqli objektet skapas
    $user = $_SESSION['user']; //Kolla vem som är inloggad
    $sql = "SELECT * FROM users WHERE username = ?"; // ? placeholder för data

    $stmt = $conn->prepare($sql); // prepare returnerar mysqli_stmt objekt
    $stmt->bind_param("s", $user); //mata nu först in användarinmatad data i sql
    $stmt->execute(); //returnerar true eller false (lyckades köra på JB eller ej)

    $result = $stmt->get_result(); //Returnerar datan i form av mysqli_result objekt

    $row = $result->fetch_assoc(); // Ta ut datan från mysqli_result objektet till en associativ array

    print("Riktiga namnet: " . $row['realname']);
    print("<p>Riktiga namnet: <input type'text' value='" . $row['realname'] . "'></p><br>");
    print("<p>Annonstext: <textarea>" . $row['bio'] . "</textarea></p>");
}


else{
    print("Du försöker se på någon annans profil");
    //TODO: kommentarsformulär
    //För att hitta kommentarerna för en viss profil måste ni hitta idn för profilen
    //SELECT id, username FROM users HWERE username = $_REQUEST['user];
    //SELECT comment FROM comment WHERE profile_id = $row['id];
}
?>
<input type="button" value = "Modifiera">
<?php
//PHP-koden fortsätter
print("Lite till info från databasen : ");

//Checka att session user e set för att ändra profilen
?>
</article>


<?php include "footer.php"?>


