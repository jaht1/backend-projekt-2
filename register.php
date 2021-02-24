
<?php $conn = create_conn();?>

<!--- Login formulär -->

<form action="index.php" method="post">
Användarnamn:
<br><input type="text" name="usr"><br>
Lösenord:
<br><input type="password" name="psw"><br>
Ditt riktiga namn:
        <br><input type='text' name='rlname'><br>
        Email:
        <br><input type='text' name='email'><br>
        Postnummer:
        <br><input type='text' name='zip'><br>
        Berätta kort om dig själv:
        <br><input type='text' name='bio'><br>
        Lön:
        <br><input type='text' name='salary'><br>
        Preferens (1 = man, 2 = kvinna, 3 = annan, 4 = båda, 5 = alla):
        <br><input type='text' name='preference'><br>
        <input type="hidden" name="stage" value="register">
        <input type='submit' value='Registrera dig'/>
</form>

<?php

if (!empty($_REQUEST['usr']) && !empty($_REQUEST['psw']) && !empty($_REQUEST['email'])) {
    $userExist = false;
    $conn = create_conn();
    $sql = "SELECT * FROM users";
    if ($result = $conn->query($sql)) {
        //Skapa en while-loop för att hämta varje rad
        //Skriv ut endast ett värde(en kolumn, en rad -- en cell)
        while ($row = $result->fetch_assoc()) {
            if ($row['username'] == $_REQUEST['usr']) {
                print("<p style='color:red;''>Användarnamnet existerar redan. Vill du försöka <a href='index.php?stage=signin'> logga in? <a/></p><br>");
                $userExist = true;
            }
        }
    }
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Fel emailformat.";
    }
    
    if ($userExist == false) {
        $username = test_input($_REQUEST['usr']);
        $password = test_input($_REQUEST['psw']);
        $password = hash("sha256", $password);
        $realname = test_input($_REQUEST['rlname']);
        $email = test_input($_REQUEST['email']);
        $zip = test_input($_REQUEST['zip']);
        $bio = test_input($_REQUEST['bio']);
        $salary = test_input($_REQUEST['salary']);
        $preference = test_input($_REQUEST['preference']);

        // Prepared statements går snabbare att köra och skyddar mot SQL Injection!$statement = $conn->prepare("INSERTINTO users (username, email) VALUES (?, ?)");$statement->bind_param("ss", $username, $email);// De flesta metoderna returnerar ett objekt (sant) om de lyckas & false ifall de misslyckas.if ($statement->execute()) {    print("Du har registrerats!");}Bra MySQLi procedural och OO demo
        $statement = $conn->prepare("INSERT INTO users (username, realname, password, email, zipcode, bio, salary, preference)
     VALUES (?,?,?,?,?,?,?,?)");
        $statement->bind_param("ssssisii", $username, $realname, $password, $email, $zip, $bio, $salary, $preference);

        if ($statement->execute()) {
            $_SESSION['user'] = $username;
            print("<p style='color: green'>Du har registrerats!</p>");
            header("refresh:2;url=./users.php");
        } else {
            print("Något gick fel, senaste felet: " . $conn->$error);
        }

    }
} 
else if (empty($_REQUEST['usr']) || empty($_REQUEST['psw']) || empty($_REQUEST['email'])) {
    print("<p>Ange åtminstone användarnamn, lösenord och email.</p><br>");
}
