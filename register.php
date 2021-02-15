<?php
//Kolla att man klickat på submit
if(isset($_REQUEST['usr']) && isset($_REQUEST['psw'])){

    //KOM IHÅG XSS PROTECTION
    $username = $_REQUEST['usr'];
    $password = $_REQUEST['psw'];
    $password = hash("sha256", $password);
    $realname = "asd";
    $email = "aasd";
    $zip = 02230;
    $bio = "bäst";
    $salary = 100;
    $preference = 2;


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
}