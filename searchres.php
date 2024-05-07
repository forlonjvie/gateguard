<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your actual database username
$password = ""; // Replace with your actual database password
$dbname = "townhomes"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data based on house number
if(isset($_POST['hnum'])) {
    $houseNumber = $_POST['hnum'];
    
    // Prepare and execute SQL query
    $sql = "SELECT `ID`, `Last_Name`, `First_Name`, `House_Number`, `Block`, `Email`, `Contact`, `Image` FROM `residence` WHERE `House_Number` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $houseNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any row is returned
    if ($result->num_rows > 0) {
        // Fetch the row
        $row = $result->fetch_assoc();
        
        // Return the row data as JSON
        echo json_encode($row);
    } else {
        // No matching record found
        echo json_encode(array('error' => 'No matching record found'));
    }
} else {
    // House number not provided
    echo json_encode(array('error' => 'House number not provided'));
}

// Close connection
$conn->close();
?>
