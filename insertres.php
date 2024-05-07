<?php
require 'connection.php';

if (!empty($_POST)) {
    $id = $_POST['id'];
    $image = $_POST['imageData'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $hnum = $_POST['housenum'];
    $block = $_POST['block'];
    $email = $_POST['email'];
    $contact = "63" . $_POST['contact']; 
    $role = "Resident";

    $mysqli = new mysqli("localhost", "root", "", "townhomes");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Insert into residence table
    $residenceSql = "INSERT INTO residence (ID, First_name, Last_name, House_number, Block, Email, Contact ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $residenceStmt = $mysqli->prepare($residenceSql);
    $residenceStmt->bind_param("sssssss", $id, $fname, $lname, $hnum, $block, $email, $contact);
    $residenceStmt->execute();
    $residenceStmt->close();

    // Insert into account table
    $password = $hnum; // Using house number as password
    $accountSql = "INSERT INTO account (name, email, password, role) VALUES (?, ?, ?, ?)";
    $accountStmt = $mysqli->prepare($accountSql);
    $accountStmt->bind_param("ssss", $fname, $email, $password, $role);
    $accountStmt->execute();
    $accountStmt->close();

    $mysqli->close();

    // JavaScript for displaying pop-up notification and redirecting
    echo "<script>alert('Resident added successfully.'); setTimeout(function(){ window.location.href = 'n-resident.php'; }, 1000);</script>";
}
?>
