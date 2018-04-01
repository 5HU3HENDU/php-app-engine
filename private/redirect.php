<?php
if($_SERVER['HTTP_HOST']=='chalparty.co')
{
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: https://www.chalparty.co".$_SERVER['REQUEST_URI']);
  exit();
}
?>

