<?php
try{
    $db = new PDO("mysql:host=localhost; dbname=data34; charset=utf8", "root" , "");

}

catch(PDOException $e){

    echo $e -> getMessage();

}

?>
