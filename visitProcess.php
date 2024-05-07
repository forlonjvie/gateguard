<?php
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fname = sanitizeInput($_POST['fname']);
    $lname = sanitizeInput($_POST['lname']);
    $contact = sanitizeInput($_POST['contact']);
    $houseNumber = sanitizeInput($_POST['hnum']);
    $add = sanitizeInput($_POST['block']);
    $email = sanitizeInput($_POST['email']);
    $imageData = $_POST['imageData']; // Get image data from POST
    
    // Convert base64 image data to a file and save it
    $imagePath = saveImageFromBase64($imageData, $fname, $lname);
    
    $conn = establishDatabaseConnection();

    $unique_id = generateUniqueId();
    
    $sql_guest = "INSERT INTO guest_data (id, name, address, contact, email, image, date_time)
            VALUES ('$unique_id', '$fname $lname', '$add $houseNumber', '$contact', '$email', '$imagePath', NOW())";

    if ($conn->query($sql_guest) === TRUE) {
        $sql_visit = "INSERT INTO visit_history (guestID, v_lname, v_fname, house_Num, email, Date, Time, image, Status)
            VALUES ('$unique_id','$lname', '$fname', '$houseNumber', '$email', CURDATE(), CURTIME(),  '$imagePath', 'progress')";

        if ($conn->query($sql_visit) === TRUE) {
            $residentContact = fetchResidentContact($conn, $houseNumber);
            sendSMSNotification($residentContact, $fname, $lname, $add, $houseNumber, $contact, $imagePath);
            echo "Data saved successfully";
        } else {
            echo "Error: " . $sql_visit . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql_guest . "<br>" . $conn->error;
    }

    $conn->close();
    
    header("Location: index.html");
    exit();
}

function saveImageFromBase64($base64Data, $fname, $lname) {
    // Extract image data and extension
    $data = explode(',', $base64Data);
    $imageData = base64_decode($data[1]);
    $extension = 'png'; // Change this based on your requirements

    // Generate filename based on guest's name
    $filename = strtolower($fname . '_' . $lname) . '.' . $extension;
    $filePath = 'uploads/' . $filename;

    // Save the image
    file_put_contents($filePath, $imageData);

    return $filePath;
}


function sanitizeInput($input) {
    global $conn;
    return $conn->real_escape_string($input);
}

function handleFileUpload($file) {
    if ($file['error'] === UPLOAD_ERR_OK) {
        $photo_tmp = $file['tmp_name'];
        $photo_name = $file['name'];
        $photo_path = 'uploads/' . $photo_name;
        move_uploaded_file($photo_tmp, $photo_path);
        return $image;
    }
    return '';
}

function establishDatabaseConnection() {
    $conn = new mysqli("localhost", "root", "", "townhomes");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function generateUniqueId() {
    return date('mdy') . '_' . mt_rand(10000, 99999);
}

function fetchResidentContact($conn, $houseNumber) {
    $query = "SELECT Contact FROM residence WHERE House_Number = '$houseNumber'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["Contact"];
    }
    return '';
}

function sendSMSNotification($residentContact, $fname, $lname, $add, $houseNumber, $contact, $image) {
    $sms_message = "Dear Mr/Ms. $res,\nYou have a visitor scheduled to visit your premises.\n\nVisitor's Name: $fname $lname\nDate of Visit: " . date('Y-m-d H:i:s') . "\nContact Number: $contact\nImage: $image\n\nPlease login to your account to review and confirm the visit.";

    $sms_data = [
        "secret" => "5e453ee722b83a4b79f1f85b0545a207bf47b7e5",
        "mode" => "devices",
        "device" => "00000000-0000-0000-4cbf-0a24d9cad2e1",
        "sim" => 1,
        "priority" => 1,
        "phone" => $residentContact,
        "message" => $sms_message
    ];

    $cURL = curl_init("https://www.cloud.smschef.com/api/send/sms");
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURL, CURLOPT_POSTFIELDS, $sms_data);
    $response = curl_exec($cURL);
    curl_close($cURL);

    $result = json_decode($response, true);

    if (!$result['success']) {
        echo "Error sending SMS: " . $result['error'];
    }
}
?>
