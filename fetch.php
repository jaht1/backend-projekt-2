<?php
//Koppla oss till databasen

$conn = create_conn();

//Skapa SQL kommando
$sql = "SELECT * FROM users";

//Kör SQL kommando på databasen
if ($result = $conn->query($sql)) {
//Skapa en while-loop för att hämta varje rad
    //Skriv ut endast ett värde(en kolumn, en rad -- en cell)
    while ($row = $result->fetch_assoc()) {
        print("Användare i databasen: " . $row['realname'] . "<br>");

    }
}

else{
    print("Något gick fel, senaste felet: " . $conn->$error);
}
