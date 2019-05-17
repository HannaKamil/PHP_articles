<?php
$dns = "mysql:host=localhost;dbname=myarticles";
$usernamee = "root";
$passwordd = "";

try{

    $conn = new PDO($dns, $usernamee, $passwordd);
//to make language arabic
    $val1 = "SET NAMES 'UTF8'";
    $val2 = "SET CAHRACTER SET UTF8";
    $conn->exec($val1);
    $conn->exec($val2);


}
catch(PDOException $e){
    echo "false" . $e->getMessage();
}

