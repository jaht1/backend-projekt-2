
<?php
$conn = create_conn();
//Om man har sorterat/filtrerat - if

if(isset($_REQUEST['pref'])){
    $preference = $_REQUEST['pref'];
    if($preference == "male"){
        $sql = "SELECT * FROM `users` WHERE `preference` = 1";
        filter($sql);
    }
    else if($preference == "female"){
        $sql = "SELECT * FROM `users` WHERE `preference` = 2";
        filter($sql);
    }
    else if($preference == "other"){
        $sql = "SELECT * FROM `users` WHERE `preference` = 3";
        filter($sql);
    }
    else if($preference == "both"){
        $sql = "SELECT * FROM `users` WHERE `preference` = 4";
        filter($sql);
    }
    else if($preference == "all"){
        $sql = "SELECT * FROM `users` WHERE `preference` = 5";
        filter($sql);
    }

}


else if (isset($_REQUEST['salary'])) {
    print("filtrerar enligt årslön...");
    //Skapa SQL kommando
    $sql = "SELECT * FROM users ORDER BY salary DESC";
    filter($sql);
}


if (!isset($_REQUEST['salary'])) {
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
            print("<p>Användarnamn: " . $row['username'] . "</p>");
            print($row['bio'] . '<br>');
            print("<b>Preferens: </b>" . $prefArray[$row['preference']] . "<br>");
           if (isset($_SESSION['user'])) {
                print("<b>Email: </b>" . $row['email'] . "<br>");
                print("<b>Lön: </b>" . $row['salary'] . "<br>");

            }
            //$_SESSION['userdata'] = $row['username'];
            print("<a href='./profile.php?user=".$row['username']."'>Kommentera!</a>");
            print("</div></article>");
        }
    } else {
        print("Något gick fel, senaste felet: " . $conn->$error);
    }

}
