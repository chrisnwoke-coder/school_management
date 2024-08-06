<?php
define("DATABASE_NAME","school");
define("DATABASE_USER", "root");
define("DATABASE_PASSWORD", "");

try{
    // establish a connection to the database
$conn = new PDO("mysql:host=localhost;dbname=".DATABASE_NAME,DATABASE_USER,DATABASE_PASSWORD);
$conn->setATTribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "ERR_CONNECTION_FAILED".$e->getMessage();
}
?>