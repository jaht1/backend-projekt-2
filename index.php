<?php include "init.php"?>
<?php include "head.php"?>




<article>


<?php if (!isset($_SESSION['user'])) {
    print("<h2>Logga in</h2>");
    print("<p>För att se emailen på annonserna, logga in eller registrera dig.</p>");
    print('<a href="index.php?stage=signin"><input type="button" value="Logga in"></a>');
    print('<a href="index.php?stage=signup"><input type="button" value="Registrera dig"></a><br>');
} else {
    print("<h2>Välkommen " . $_SESSION['user'] . "!</h2>");
    print('<a href="index.php?stage=signout"><input type="button" value="Logga ut"></a>');
}
?>






<?php
//Om man har klickat på register-knappen - includea register.php
if (isset($_REQUEST['stage']) && ($_REQUEST['stage'] == 'signup' || $_REQUEST['stage'] == 'register')) {
    include "register.php";
} else if (isset($_REQUEST['stage']) && ($_REQUEST['stage'] == 'signin') || $_REQUEST['stage'] == 'login') {
    include "login.php";
} else if (isset($_REQUEST['stage']) && ($_REQUEST['stage'] == 'signout') || $_REQUEST['stage'] == 'logout') {
    include "logout.php";
}
?>

</article>

<article>
<h2>Uppgift 5 - ta bort data</h2>
<a href="index.php?stage=remove"><input type="button" value="Ta bort din kontaktannons"></a>
</article>

<?php
if (isset($_REQUEST['stage']) && ($_REQUEST['stage'] == 'remove' || $_REQUEST['stage'] == 'delete')) {
    include "remove.php";
}
?>
<article>
<?php
if (isset($_SESSION['user'])) {
    print('<a href="https://cgi.arcada.fi/~ahtijenn/backend/backend-projekt-2/profile.php"><input type="button" value="Modifiera din profil"></a>');

    //url=./profile.php"
}

?>
</article>
<?php include "footer.php"?>