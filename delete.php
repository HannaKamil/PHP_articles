<?php

include 'connection.php';

$id = $_GET['idd'];
$q="DELETE FROM articles WHERE id=$id";
$conn->exec($q);
echo "Delete done!";
header("location: ../index.php");
