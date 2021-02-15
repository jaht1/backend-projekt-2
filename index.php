<?php include "init.php"?>
<?php include "head.php"?>

<article>
    <h1>Hämta data</h1>

    <?php include "fetch.php"?>
</article>

<article>
<h2>Logga in</h2>
<p>För att se emailen på annonserna, logga in eller registrera dig.</p>
<input type="button" value="Logga in">
<input type="button" value="Registrera dig"><br>

<!--- Login formulär -->
<form action="index.php" method="post">
Användarnamn:
<br><input type="text" name="usr"><br>
Lösenord
<br><input type="password" name="psw"><br>
<input type="submit" value="Logga in">
</form>


<?php include "register.php" ?>
</article>



<?php include "footer.php"?>