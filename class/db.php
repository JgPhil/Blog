<?php

class database
{
public static function dbConnect() {
try{
$bd = new PDO('mysql:host=localhost;dbname=blog','root','', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch(PDOException $e)
{
echo $e ;
}
return $db;
}
}
