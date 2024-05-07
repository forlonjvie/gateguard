<?php
require 'connection.php';

// Check if the ID is present in the URL
if (empty($_GET['id'])) {
    header("Location: resident_data.php");
    exit();
}

$id = $_GET['id'];

if (!empty($_POST)) {
    // Keep track of post values
    $id = $_POST['id'];
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $housenum = $_POST['House_num'];
    $block = $_POST['block'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    // $image = $_POST['image'];

    // Create MySQLi connection
    $mysqli = new mysqli("localhost", "root", "", "Townhomes");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Modified SQL statement for UPDATE
    $sql = "UPDATE residence 
            SET Last_Name=?, First_Name=?, House_Number=?, Block=?, Email=?, Contact=?
            WHERE ID=?";
    $stmt = $mysqli->prepare($sql);

    // Adjusted bind_param to include the data types
    $stmt->bind_param("ssssssi", $lname, $fname, $housenum, $block, $email, $contact, $id);
    $stmt->execute();

    $stmt->close();
    $mysqli->close();

    header("Location: a-r-view.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM residence WHERE ID = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    header("Location: resident_data.php");
    exit();
}
?>