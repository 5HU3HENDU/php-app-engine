<?php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = str_replace("/","",$path);
if(preg_match("/^[A-Za-z-]+$/",$path))
{
require_once __DIR__ . '/../private/connection.php';
$sql = "SELECT place_id FROM place WHERE acronym='{$path}'";
if(!$result = $mysqli->query($sql))
{
echo "Sorry, our website is too dumb to understand the url you entered :("; 
exit;
}
if($result->num_rows === 1)
{
$place = $result->fetch_assoc();
header("HTTP/1.1 301 Moved Permanently");
header("Location: https://www.chalparty.co/place.php?place=".$place['place_id']);
exit();
}
$sql = "SELECT party_id FROM party WHERE name='{$path}'";
if(!$result = $mysqli->query($sql))
{
echo "Sorry, our website is too dumb to understand the url you entered :("; 
exit;
}
if($result->num_rows === 1)
{
$party = $result->fetch_assoc();
header("HTTP/1.1 301 Moved Permanently");
header("Location: https://www.chalparty.co/party.php?party=".$party['party_id']);
exit;
}
else
{
header("HTTP/1.1 301 Moved Permanently");
header("Location: https://www.chalparty.co/");
exit;
}
}
else
{
header("HTTP/1.1 301 Moved Permanently");
header("Location: http://www.chalparty.co/");
exit;
}
?>

