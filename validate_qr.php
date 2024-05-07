<?php
// Include database connection
include 'connection.php';

// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Get the scanned content from POST request and sanitize it
$qr_content = sanitize_input($_POST['qr_content']);

// Initialize variables for user information and profile picture path
$name = $address = $contact = $photo_path = '';
$error_message = null;
$validity = 'Valid'; 

$sql = "SELECT v_lname, v_fname, house_Num, email, Date, expireDate, Time, Image FROM visit_history WHERE guestID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $qr_content);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();
    $name = $row['v_fname'] . ' ' . $row['v_lname'];
    $address = $row['house_Num'];
    $contact = $row['email'];
    $photo_path = $row['Image'];

    
    $current_date = date('Y-m-d');
    $expire_date = $row['expireDate'];

    if ($expire_date > $current_date) {
        $validity = 'VALID'; 
    } else if ($expire_date == $current_date) {
        $validity = 'VALID';
    } else {
        $validity = 'Expired Request';
    }
} else {
    
    $error_message = 'No user found for the scanned QR code.';
}

$stmt->close();
$conn->close();

$response = array(
    'name' => $name,
    'address' => $address,
    'contact' => $contact,
    'photo_path' => $photo_path, 
    'validity' => $validity,
    'error' => $error_message
);

// Send response back to the client as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
