<?php 
     $jsondata=file_get_contents("users.json")
     $data=json_decode($jsondata)
     $assocData = json_decode($jsonString, true);
     echo $data;
?>
