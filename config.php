<?php
$hostname = "localhost";
$dbname = "psms";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "HI BAba";
} catch (PDOException $e) {
    echo "Connection Fail! " . $e->getMessage();
}

include_once("functions.php");
