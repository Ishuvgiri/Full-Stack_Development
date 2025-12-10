<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];

    echo "Welcome, " . htmlspecialchars($username) . "!<br>";
    echo "Your email is: " . htmlspecialchars($email);

    if (empty($username) || empty($email)) {
        echo "<br>Please fill in all fields.";
    }
} else {
    echo "Form not submitted.";
}
?>