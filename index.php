<?php include "init.php"?>
<?php include "head.php"?>



<article>
<h2>Logga in</h2>
<p>För att se emailen på annonserna, logga in eller registrera dig.</p>
<a href="index.php?stage=signin"><input type="button" value="Logga in"></a>
<a href="index.php?stage=signup"><input type="button" value="Registrera dig"></a><br>


<?php

?>



<?php
//Om man har klickat på register-knappen - includea register.php
if (isset($_REQUEST['stage']) && ($_REQUEST['stage'] == 'signup' || $_REQUEST['stage'] == 'register'))
{
    include "register.php";
}

else if (isset($_REQUEST['stage']) && ($_REQUEST['stage'] == 'signin') || $_REQUEST['stage'] == 'login'){
    include "login.php";
}
?>

</article>

<article>
<h2>Uppgift 5 - ta bort data</h2>
<a href="index.php?stage=remove"><input type="button" value="Ta bort din kontaktannons"></a>
</article>

<?php
if (isset($_REQUEST['stage']) && ($_REQUEST['stage'] == 'remove' || $_REQUEST['stage'] == 'remove'))
{
    include "remove.php";
}
?>

<?php include "footer.php"?>