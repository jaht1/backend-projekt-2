<?php include "init.php"?>
<?php include "head.php"?>




<article>


<?php if (!isset($_SESSION['user'])) {
    print("<h1>Logga in</h1>");
    print("<p>För att se emailen på annonserna, logga in eller registrera dig.</p>");
    print('<a href="index.php?stage=signin"><input type="button" class="button" value="Logga in"></a>');
    print('<a href="index.php?stage=signup"><input type="button" class="button" value="Registrera dig"></a><br>');
} else {
    print("<h1>Välkommen " . $_SESSION['user'] . "!</h1><br>");
    $_SESSION['refresh'] = "ref";
    print('<a href="index.php?stage=signout"><input type="button" class="button" value="Logga ut"></a>');
}

//$sql = "ALTER TABLE users ADD likes int(1000)";
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
<?php if(isset($_SESSION['refresh'])){ ?>
<article>
<h1>Uppgift 5 - ta bort data</h1><br>
<a href="index.php?stage=remove"><input type="button" class="button" value="Ta bort din kontaktannons"></a>
</article>
<?php } ?>
<?php
if (isset($_REQUEST['stage']) && ($_REQUEST['stage'] == 'remove' || $_REQUEST['stage'] == 'delete')) {
    include "remove.php";
}
?>
<article>
<?php
if (isset($_SESSION['refresh'])) {
    print('<a href=./profile.php?user=' . $_SESSION['user'] . '><input type="button" class="button" value="Modifiera din profil"></a>');

    //url=./profile.php"
}

?>
</article>
<?php include "footer.php"?>