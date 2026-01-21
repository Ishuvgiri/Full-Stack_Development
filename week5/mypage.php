<form>
    <input type="text" name="message">
    <br>
    <input type="submit" value="Submit">
</form>

<?php
if (isset($_GET['message']))
   $message = $_GET['message'];

   $file=fopen("file.txt", "w");
    fwrite($file, $message);
    fclose($file);

    try {
        $file=fopen("file.txt", "r");
        $content = fread($file, 100);
        echo "<p>$content</p>";
        fclose($file);
    } catch (Exception $e) {
        echo "Error reading file: " . $e->getMessage();
    }
?>




