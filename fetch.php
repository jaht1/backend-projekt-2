
<?php
$conn = create_conn();
//Om man har sorterat/filtrerat - if
if (isset($_REQUEST['salary'])) {
    print("filtrerar...");
    //Skapa SQL kommando
    $sql = "SELECT * FROM users ORDER BY salary DESC";
    filter($sql);
}


else if (!isset($_REQUEST['salary'])) {
    $sql = "SELECT * FROM users";
    filter($sql);
}

function filter($sql)
{
    $conn = create_conn();
    $prefArray = ['', 'Man', 'Kvinna', 'Annan', 'Båda', 'Alla'];
    //Kör SQL kommando på databasen
    if ($result = $conn->query($sql)) {
        //Skapa en while-loop för att hämta varje rad
        //Skriv ut endast ett värde(en kolumn, en rad -- en cell)
        while ($row = $result->fetch_assoc()) {
            print("<article><div class='outer'>");
            print("<div class='centered'>" . $row['realname'] . "</div>");
            print($row['bio'] . '<br>');
            print("<b>Preferens: </b>" . $prefArray[$row['preference']] . "<br>");
            if (isset($_SESSION['user'])) {
                print("<b>Email: </b>" . $row['email'] . "<br>");
                print("<b>Lön: </b>" . $row['salary'] . "<br>");

            }
            print("<a href='profile.php?user='" . $row['username']."'>Kommentera</a><br>");
            print("</div></article>");
        }
    } else {
        print("Något gick fel, senaste felet: " . $conn->$error);
    }

}
