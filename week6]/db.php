<?php

$server = "mysql:host=localhost;dbname=mydatabase;charset=utf8";
$user = "admin";
$password = "";
  $con = new PDO($server,$user,$password);

  try
    {
        $con = new PDO($server,$user,$password);
    }
    catch(PDOException $e)
    {
        die("Connection failed: " . $e->getMessage());
    }

?>  