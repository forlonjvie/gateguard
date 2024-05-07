<?php

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the POST data
    $postData = json_decode(file_get_contents("php://input"), true);

    // Validate the data
    if (isset($postData['guestID']) && isset($postData['point'])) {
        // Extract the data
        $guestID = $postData['guestID'];
        $point = $postData['point'];
        
        // Create a database connection (replace with your own database credentials)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "townhomes";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the SQL statement
        $sql = "INSERT INTO guest_log (guestID, date, time, point) VALUES (?, CURDATE(), CURTIME(), ?)";

        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $guestID, $point);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            // Log saved successfully
            echo json_encode(array("status" => "success", "message" => "Log saved successfully"));
        } else {
            // Failed to save log
            echo json_encode(array("status" => "error", "message" => "Failed to save log: " . $conn->error));
        }

        // Close the connection
        $stmt->close();
        $conn->close();
    } else {
        // Invalid data
        echo json_encode(array("status" => "error", "message" => "Invalid data"));
    }
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(array("status" => "error", "message" => "Invalid request method"));
}
?>