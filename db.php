<?php

$server = 'localhost';
$username = 'postgres';
$password = '12345678';
$db_name = 'ram';

$dbcon = pg_connect("host=$server port=5432 dbname=$db_name user=$username password=$password");
//$dbcon = new PDO("pgsql:dbname=$db_name;host=$server", $username, $password);

if ($dbcon) {
     echo 'connected';
} else {
     echo 'there has been an error connecting';
}

?>