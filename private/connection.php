<?php
$hostname = null;
$username = $_SERVER['MYSQL_USER'];
$password = $_SERVER['MYSQL_PASSWORD'];
$database = $_SERVER['MYSQL_DATABASE'];
$port= null;
$socket = $_SERVER['MYSQL_SOCKET'];
$mysqli = new mysqli($hostname,$username, $password,$database,$port,$socket);
if ($mysqli->connect_errno) 
{
  echo "Sorry, this website is unable to connect to database.";
  echo "We are working on it.";
  echo "Phone:- 8390601504";
  exit;
}
?>

