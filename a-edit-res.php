<?php
require 'connection.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

$mysqli = new mysqli("localhost", "root", "", "townhomes");


if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$sql = "SELECT * FROM residence WHERE ID = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$data = $result->fetch_assoc();


$stmt->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>

    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        .ac{
            margin-left: 460px;
        }
        .lg{
            color: #1E771E;
            padding-left: 10px;
            text-decoration: none;
        }
        input[type=text], input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #C9C9C9;
        }
        input[type=text]:focus, input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }
        .password-toggle {
            position: relative;
        }
        .password-toggle input[type="password"] {
            padding-right: 30px;
        }
        .password-toggle .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .suc-btn{
            width: 100%;
        }
        .container {
            width: 1500px;
            height: 650px;
            border: 1px solid #ccc;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            box-shadow: 2px 3px 10px rgb(22, 22, 23);
        }
        .sig-form{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 100%;
            text-decoration: none;
            padding: 10px 20px;
        }
        .full-width {
            width: 360px;
        }
        .pasa{
            padding-top: 17px;
            display: flex;
            width: 1200px;
        }
        .bg-img{
            height: 729px;
            width: 1550px;
        }
    </style>
</head>
<body>
        <div>
            <img src="img/body/bg-river.jpg" alt="..." class="bg-img">
            <form action="a-edit-import.php?id=<?php echo $id?>" class="sig-form" method="post">
                <div class="container">
                    <h1 style="color: #1E771E;"><b>Modify Resident Details</b></h1>

                    <label for="id"><b>ID</b></label>
                    <div class="row gap-2">
                        <div class="col g-col-6">
                            <input type="hidden" placeholder="ID : *******" name="guestID" value="<?php echo $data['ID']; ?>" readonly>
                            <input name="id" type="text" placeholder="" value="<?php echo $data['ID']; ?>">
                        </div>
                    </div>

                    <label for="name"><b>Name</b></label>
                    <div class="row gap-2">
                        <div class="col g-col-6">
                            <input style="margin-right: 50px;" type="text" placeholder="" name="fname" value="<?php echo $data['First_Name']; ?>">
                        </div>
                        <div class="col g-col-6">
                            <input type="text" placeholder="" name="lname" value="<?php echo $data['Last_Name']; ?>">
                        </div>
                    </div>

                    <label for="address"><b>Address</b></label>
                    <div class="row gap-2">
                        <div class="col g-col-6">
                            <input style="margin-right: 50px;" type="text" placeholder="House Number" name="House_num" value="<?php echo $data['House_Number']; ?>">
                        </div>
                        <div class="col g-col-6">
                            <input type="text" placeholder="Block" name="block" value="<?php echo $data['Block']; ?>">
                        </div>
                    </div>

                    <label for="contact"><b>Contact</b></label>
                    <div class="row gap-2">
                        <div class="col g-col-6">
                            <input style="margin-right: 50px;" type="text" placeholder="Email" name="email" value="<?php echo $data['Email']; ?>">
                        </div>
                        <div class="col g-col-6">
                            <input type="text" placeholder="Last Name" name="contact" value="<?php echo $data['Contact']; ?>">
                        </div>
                    </div>

                    <div class="pasa">
                        <div class="col g-col-6">
                            <button type="submit" class="btn btn-success suc-btn row" style="margin-right: 60px;">Save</button>
                        </div>
                        <div class="col g-col-6">
                            <a href="a-r-view.php" class="btn btn-danger suc-btn row" style="margin-left: 30px;">Cancel</a>
                        </div>
                    </div>
                </div>
                <br>
            </form>
        </div>
</body>
</html>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var icon = document.querySelector(".toggle-password");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.textContent = "🔒";
            } else {
                passwordInput.type = "password";
                icon.textContent = "👁️";
            }
        }

        // script for camera
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const captureButton = document.getElementById('capture');
        const ctx = canvas.getContext('2d');

        // Get user media
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                console.error('Error accessing webcam:', err);
            });

        // Capture image
        captureButton.addEventListener('click', () => {
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            document.getElementById('imageData').value = canvas.toDataURL();
        });

        // Capture image
        captureButton.addEventListener('click', () => {
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            document.getElementById('imageData').value = canvas.toDataURL();

            // Hide video and capture button
            document.getElementById('video-container').style.display = 'none';
            document.getElementById('canvas-container').style.display = 'block'; // Show canvas
            document.getElementById('canvas').style.display = 'block'; // Show canvas
            captureButton.style.display = 'none';
        });
    </script>