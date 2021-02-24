<?php
$conn = create_conn();
print("<br><p><b>Loggar ut...</b></p>");
header("refresh:1;url=./index.php");
session_destroy();