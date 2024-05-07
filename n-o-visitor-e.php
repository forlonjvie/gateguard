<?php
require 'connection.php';


$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}


$conn = new PDO("mysql:host=localhost;dbname=townhomes", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


try {
    $sql = "SELECT * FROM visit_history WHERE visitID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


$conn = null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Visits Request</title>
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
        /* Full-width input fields */
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
            height: 600px;
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
        /* .unresizable {
            resize: none;
        } */
        .int{
            /* margin-top: -400px;
            margin-left: 470px; */
        }
        .pasa{
            padding-top: 50px;
            display: flex;
            width: 1200px;
        }
        /* .btn-vid{
            margin-top: -200px;
            margin-left: 120px;
        } */
    </style>
</head>
<body>  
    <div>
        <img src="img/body/footer-bg-2.png" alt="..." style="height: 720px; width: 1518px;">
        <form class="sig-form" action="ostat.php?id=<?php echo $id?>" method="post">
            <div class="container">
                <h1 style="color: #1E771E;">Visit Request Details</h1>
                <img src="<?= $data['Image']; ?>" alt="Visitor Image" width="100" height="100">

                <label for="id"><b>ID</b></label>
                <div class="row gap-2">
                    <input class="col g-col-6" type="hidden" placeholder="ID : *********" name="guestID" value="<?php echo $data['visitID']; ?>" readonly>
                    <input class="col g-col-6" name="id" type="text" placeholder="" value="<?php echo $data['guestID']; ?>" readonly>
                </div>
                <div class="row gap-2">
                    <input class="col g-col-6" type="hidden" placeholder="Email" name="recipient_email" value="<?php echo $data['email']; ?>" readonly>
                </div>
               
                <label for="name"><b>Name</b></label>
                <div class="row gap-2">
                    <input class="col g-col-6" style="margin-right: 50px;" type="text" placeholder="First Name" name="fname" value="<?php echo $data['v_fname']; ?>" readonly>
                    <input class="col g-col-6" type="text" placeholder="Last Name" name="lname" value="<?php echo $data['v_lname']; ?>" readonly>
                </div>

                <label for="date"><b>Date & Time</b></label>
                <div class="row gap-2">
                    <input class="col g-col-6" style="margin-right: 50px;" type="text" placeholder="mm/dd/yyyy" name="date" value="<?php echo $data['Date']; ?>" readonly>
                    <input class="col g-col-6" type="text" placeholder="00:00:00" name="Time" value="<?php echo $data['Time']; ?>" readonly>
                </div>

                <label class="control-label">Status</label>
                <div class="controls">
                    <label for="duration"><b>Visitation Duration (Days)</b></label>
                    <input class="col g-col-6" type="number" placeholder="Enter duration (max 3 days)" name="duration" value="1" min="1" max="3" step="1" pattern="\d*" oninput="this.value = Math.min(this.value, 3)" required>
                    <select name="status" required onchange="disableNoResponse(this)">
                        <option value="No response" <?php if($data['Status'] == 'No response') echo 'selected'; ?>>No response</option>
                        <option value="Accept" <?php if($data['Status'] == 'Accept') echo 'selected'; ?>>Accept</option>
                        <option value="Deny" <?php if($data['Status'] == 'Deny') echo 'selected'; ?>>Deny</option>
                    </select>
                </div>

                <div class="pasa">
                    <button type="submit" name="but" class="btn btn-success suc-btn row" style="margin-right: 60px;">Save</button>
                    <a href="b-v-data.php" class="btn btn-danger suc-btn row" style="margin-left: 30px;">Cancel</a>
                </div>
            </div>
            <br>
        </form>
    </div>

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

    <script>
        function disableNoResponse(select) {
            var options = select.options;
            for (var i = 0; i < options.length; i++) {
                if (options[i].value === "No response") {
                    options[i].disabled = true;
                }
            }
        }
    </script>
</body>

</html>