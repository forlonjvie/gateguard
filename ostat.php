<?php
// Include PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Include database connection
include 'connection.php';

// Function to send confirmation email with QR code
function sendConfirmationEmail($recipientEmail, $id, $guestDetails) {
    // Instantiate PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'jvdelima9@gmail.com'; // Set default sender email address
        $mail->Password   = 'hfncagmmofrhhemi'; // Replace with your Gmail password
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('jvdelima9@gmail.com', 'GateGuard');
        $mail->addAddress($recipientEmail); // Recipient's email

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Visit Request Accepted'; // Email subject

        // Generate QR code content
        $qrContent = "
            Guest ID: {$guestDetails['guestID']} <br>
            Guest Name: {$guestDetails['name']} <br>
            Email: {$guestDetails['email']} <br>
            Date Inquired: {$guestDetails['date_inquired']} <br>
            Expiry Date: {$guestDetails['expiry_date']} <br>
            Status: {$guestDetails['status']} <br>
        ";

        // Generate QR code URL
        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode($qrContent);

        // Create HTML content with QR code
        $htmlContent = "
            <p>Your visit request with ID $id has been accepted.</p>
            
            <p>For your convenience, kindly save this QR code to present at the gate for seamless access during your visit.</p>

            <p>Please find below the details:</p>
            
            <ul>
                <li>Guest ID: {$guestDetails['guestID']}</li>
                <li>Guest Name: {$guestDetails['name']}</li>
                <li>Email: {$guestDetails['email']}</li>
                <li>Date Inquired: {$guestDetails['date_inquired']}</li>
                <li>Expiry Date: {$guestDetails['expiry_date']}</li>
                <li>Status: {$guestDetails['status']}</li>
            </ul>
            <img src='$qrCodeUrl' alt='QR Code'>
            
            <p>Thank you!</p>
        ";

        // Set email body
        $mail->Body = $htmlContent;

        // Send email
        $mail->send();
        echo "<script>alert('Email sent successfully!');</script>";
    } catch (Exception $e) {
        echo "<script>alert('Email could not be sent. Error: {$mail->ErrorInfo}');</script>";
    }
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Keep track of post values
    $id = $_POST['id'];
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $date = $_POST['date'];
    $time = $_POST['Time'];
    $status = $_POST['status'];
    $address = $_POST['address']; 
    $contact = $_POST['contact'];
    $duration = $_POST['duration']; 
    

    $expiryDate = date('Y-m-d', strtotime("+$duration days"));

   
    $sql = "UPDATE visit_history
            SET v_lname=?, v_fname=?, Date=?, Time=?, expireDate=?, Status=?
            WHERE guestID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $lname, $fname, $date, $time, $expiryDate, $status, $id);
    $stmt->execute();
    
  
    if ($stmt->errno) {
        echo "Error: " . $stmt->error;
    } else {
       
        if ($status === "Accept") {
            $recipientEmail = $_POST['recipient_email'];
            $guestDetails = array(
                'guestID' => $id,
                'name' => $fname . ' ' . $lname,
                'email' => $_POST['recipient_email'],
                'date_inquired' => $date,
                'expiry_date' => $expiryDate,
                'status' => $status
            );
            sendConfirmationEmail($recipientEmail, $id, $guestDetails);
        }
        
        // Redirect
        header("Location: b-v-data.php");
        exit();
    }

    $stmt->close();
}
?>
