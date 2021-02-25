



<?php
$conn = create_conn();
$username = $_SESSION['user'];
if ($_REQUEST['pref'] != '') {
    $preference = $_REQUEST['pref'];
    if ($preference == "male") {
        $sql = "SELECT * FROM `users` WHERE `preference` = 1";
        filter($sql);
    } else if ($preference == "female") {
        $sql = "SELECT * FROM `users` WHERE `preference` = 2";
        filter($sql);
    } else if ($preference == "other") {
        $sql = "SELECT * FROM `users` WHERE `preference` = 3";
        filter($sql);
    } else if ($preference == "both") {
        $sql = "SELECT * FROM `users` WHERE `preference` = 4";
        filter($sql);
    } else if ($preference == "all") {
        $sql = "SELECT * FROM `users` WHERE `preference` = 5";
        filter($sql);
    }

} else if ($_REQUEST['salary'] == "rich") {
    //print("filtrerar enligt hög årslön...");
    //Skapa SQL kommando
    $sql = "SELECT * FROM users ORDER BY salary DESC";
    filter($sql);
}

if ($_REQUEST['salary'] == "poor") {

    $sql = "SELECT * FROM users ORDER BY salary ASC";
    filter($sql);
}
/*else{
$sql = "SELECT * FROM users";
filter($sql);
/*$query = "SELECT * FROM users";

$result = mysqli_query($conn, $query);
$number_of_result = mysqli_num_rows($result);

$number_of_page = ceil($number_of_result / $results_per_page);

//Vilken sida är användaren på
if (!isset($_GET['page'])) {
$page = 1;
} else {
$page = $_GET['page'];
}
//determine the sql LIMIT starting number for the results on the displaying page
$page_first_result = ($page - 1) * $results_per_page;

//retrieve the selected results from database
$query = "SELECT * FROM users LIMIT " . $page_first_result . ',' . $results_per_page;
$result = mysqli_query($conn, $query);

//display the retrieved result on the webpage
while ($row = mysqli_fetch_array($result)) {
print("pls work");
}

for($page = 1; $page<= $number_of_page; $page++) {
echo '<a href = "index.php?page=' . $page . '">' . $page . ' </a>';
}

$conn->close();
}*/

function filter($sql)
{

    $conn = create_conn();
    $prefArray = ['', 'Man', 'Kvinna', 'Annan', 'Båda', 'Alla'];

    if ($result = $conn->query($sql)) {

        while ($row = $result->fetch_assoc()) {
            print("<article><div class='outer'>");
            print("<div class='centered'>" . $row['realname'] . "</div>");
            print("<b>Användarnamn: </b>" . $row['username'] . "<br>");
            print("<b>Preferens: </b>" . $prefArray[$row['preference']] . "<br>");
            if (isset($_SESSION['user'])) {
                print("<b>Email: </b>" . $row['email'] . "<br>");
                print("<b>Lön: </b>" . $row['salary'] . "<br>");

            }
            print($row['bio'] . '<br>');
            //$_SESSION['userdata'] = $row['username'];
            $userName =$row['username'];
            
            print("<a href='./profile.php?user=" . $row['username'] . "'>Kommentera!</a><br>");
            /*print('<form action="./users.php" method="post"><input type="submit" name="addLike" value="Like"/><input type="hidden" name="id" value="$userName"/>');
            print("</form>");*/
            
            print("</div></article>");
        }
       
    } else {
        print("Något gick fel, senaste felet: " . $conn->$error);
    }
    if (isset($_POST['id'])) {
                print("<h1>test</h1>");
            }

}


/*

$query = "SELECT * FROM users";

$result = mysqli_query($conn, $query);
$number_of_result = mysqli_num_rows($result);

$number_of_page = ceil($number_of_result / $results_per_page);

//Vilken sida är användaren på
if (!isset($_GET['page'])) {
$page = 1;
} else {
$page = $_GET['page'];
}
//determine the sql LIMIT starting number for the results on the displaying page
$page_first_result = ($page - 1) * $results_per_page;

//retrieve the selected results from database
$query = "SELECT * FROM users LIMIT " . $page_first_result . ',' . $results_per_page;
$result = mysqli_query($conn, $query);

//display the retrieved result on the webpage
while ($row = mysqli_fetch_array($result)) {
print("pls work");
}

for($page = 1; $page<= $number_of_page; $page++) {
echo '<a href = "index.php?page=' . $page . '">' . $page . ' </a>';
}

$conn->close();

 */