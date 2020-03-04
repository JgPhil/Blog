<?php

class database
{
protected static function connect() {
try{
$pdo = new PDO('mysql:host=localhost;dbname=blog','root','', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch(PDOException $e)
{
echo $e ;
}
}
}
