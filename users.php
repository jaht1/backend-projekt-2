<?php include "init.php"?>
<?php include "head.php"?>

<article>
    <h1>Bläddra bland kontaktannonserna</h1>
    
    <br>
<!--filtreringsformulär-->
        <form action="users.php" method="post">
<!--radio buttons för sortering - förmögenhet-->
<label for="rich">Rika först</label>
<input type="radio" name="salary" value="rich" checked>

<label for="poor">Rika sist</label>
<input type="radio" name="salary" value="poor"><br>

<label for="pop">Populära först</label>
<input type="radio" name="likes" value="pop" checked>

<label for="notpop">Populära sist</label>
<input type="radio" name="likes" value="notpop"><br><br>

<!--dropdown för preferens-->
<label for="pref">Preference:</label><br>

<select name="pref">
<option disabled selected value> välj könpreferens </option>
  <option value="male">Man</option>
  <option value="female">Kvinna</option>
  <option value="other">Annan</option>
  <option value="both">Båda</option>
  <option value="all">Alla</option>
</select>
<input type="submit" value="filtrera">
</form>
    </p>

    <?php include "fetch.php"?>
</article>

<?php include "footer.php"?>