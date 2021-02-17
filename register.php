
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
        Preferens (1-3):
        <br><input type='text' name='preference'><br>
        <input type='submit' value='Registrera dig'>
</form>

<?php
if(isset($_REQUEST['stage']) && ($_REQUEST['stage'] == 'signup')){
//Kolla att man klickat på submit
//if (isset($_REQUEST['usr']) && isset($_REQUEST['psw'])) {

    $userExist = false;
    $conn = create_conn();

//Skapa SQL kommando
    $sql = "SELECT * FROM users";

//Kör SQL kommando på databasen
    if ($result = $conn->query($sql)) {
//Skapa en while-loop för att hämta varje rad
        //Skriv ut endast ett värde(en kolumn, en rad -- en cell)
        while ($row = $result->fetch_assoc()) {
            if ($row['username'] == $_REQUEST['usr']) {
                print("Användarnamnet existerar redan. Vill du försöka <a href='index.php?stage=signin'> logga in? <a/><br>");
                $userExist = true;
            }
        }
    }
    /*if (isset($_REQUEST['stage']) && ($_REQUEST['stage'] == 'signin') || $_REQUEST['stage'] == 'login'){
        include "login.php";
    }*/

    //KOM IHÅG XSS PROTECTION

    $realname = $_REQUEST['rlname'];
    $email = $_REQUEST['email'];
    $zip = $_REQUEST['zip'];
    $bio = $_REQUEST['bio'];
    $salary = $_REQUEST['salary'];
    $preference = $_REQUEST['preference'];

    //TODO: börja med att checka ifall användaren redan finns i databasen
    //TODO: slutför registreringsförmuläret
    //TODO: Skapa inloggningsformuläret

    // Prepared statements går snabbare att köra och skyddar mot SQL Injection!$statement = $conn->prepare("INSERTINTO users (username, email) VALUES (?, ?)");$statement->bind_param("ss", $username, $email);// De flesta metoderna returnerar ett objekt (sant) om de lyckas & false ifall de misslyckas.if ($statement->execute()) {    print("Du har registrerats!");}Bra MySQLi procedural och OO demo
    $statement = $conn->prepare("INSERT INTO users (username, realname, password, email, zipcode, bio, salary, preference)
                                    VALUES (?,?,?,?,?,?,?,?)");
    $statement->bind_param("ssssisii", $username, $realname, $password, $email, $zip, $bio, $salary, $preference);

    if ($statement->execute()) {
        print("Du har registrerats!");
    }
//Kom ihåg errorhandling - här ska finnas en else-sats
    else {
        print("Något gick fel, senaste felet: " . $conn->$error);
    }
}