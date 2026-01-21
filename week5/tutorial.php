<?php 
$file=fopen("file.txt", "r");
fread($file,100);;
echo "<p>$file</p>";
fclose($file);
?>
