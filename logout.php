<?php
$conn = create_conn();
print("Loggar ut...");
header("refresh:1;url=./index.php");
session_destroy();