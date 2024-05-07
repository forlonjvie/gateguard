<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" sizes="100x100" href="/img/header/logo_edit.jpg">
    <link rel="stylesheet" href="css\style.css">
    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="your-styles.css">
    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>
    <title>Microcontrollers</title>
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        /* visitation form */
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
            margin-top: 20px;
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
        .unresizable {
            resize: none;
        }
        .int{
            margin-top: -350px;
            margin-left: 470px;
        }
        .pasa{
            padding-top: 80px;
            display: flex;
        }
        .btn-vid{
            margin-top: -200px;
            margin-left: 120px;
        }
        .name-in{
            width: 100%;
        }
        .bg-img{
            height: 729px;
            width: 1550px;
        }
        /* visitation form end */
    </style>
</head>
<body>
    
    <div>
        <img src="img/body/bg-river.jpg" alt="..." class="bg-img">
        <form action="visitProcess.php" class="sig-form" method="post">
            <div class="container">
                <h1 style="color: #1E771E;"><b>Visitor Form</b></h1>
                <br>

                <div class="form-row">
                    <label class="name"><b>Capture Image</b></label>
                    <div class="value">
                        <div class="row row-space">
                            <div class="col-2" id="video-container">
                                <video id="video" width="350px" height="200px" autoplay></video>
                            </div>
                            <div class="col-2" id="canvas-container">
                                <canvas id="canvas" width="300px" height="200px" style="border: 1px solid black; display: none; margin-left: 50px;"></canvas>
                            </div>
                            <div class="col-2">
                                <input type="hidden" name="imageData" id="imageData">
                            </div>
                            <div class="btn-vid">
                                <button type="button" class="btn btn-success" id="capture" style="margin-top: 220px; margin-right: 100px">Capture</button>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- <div class="row">
                    <div class="col-md-6">
                        <div class="control-group">
                            <label class="control-label"><b>ID</b></label>
                            <div class="controls">
                                <textarea name="id" id="getUID" placeholder="Please Scan your Card / Key Chain to display ID" rows="1" cols="1" class="full-width unresizable"></textarea>
                            </div>
                        </div>
                    </div>
                </div> -->
                <br>

                <div class="int">

                    <!-- <label for="email"><b>Email</b><span class="ac">Need an account?<span><a href="signup.php" class="lg">Sing up</a></span></span></label>
                    <input type="text" placeholder="Enter Email" name="email" required>

                    <label for="psw"><b>Password</b></label>
                    <div class="password-toggle">
                        <input type="password" placeholder="Enter Password" name="psw" id="password" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility()">👁️</span>
                    </div> -->

                    <label for="name"><b>Address</b></label>
                    <div class="row name-in gap-1">
                        <div class="col g-col-6">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="House Number" name="hnum" required>
                                <button id="searchbt" type="button" class="btn btn-success" style="width: 55px; height: 55px; margin-top: 5px;"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="col g-col-6">
                            <input class="form-control" type="text" placeholder="Resident Surname" name="rlname" required readonly>
                        </div>
                    </div>
                    
                    <label for="name"><b>Name</b></label>
                    <div class="row name-in gap-1">
                        <div class="col g-col-6">
                            <input class="form-control" type="text" placeholder="First Name" name="fname" required>
                        </div>
                        <div class="col g-col-6">
                            <input class="form-control" type="text" placeholder="Last Name" name="lname" required>
                        </div>
                    </div>

                    <label for="name"><b>Contact</b></label>
                    <div class="row name-in gap-1">
                        <div class="col g-col-6">
                            <input class="form-control" type="text" placeholder="Email" name="email" required>
                        </div>
                        <div class="col g-col-6">
                            <input class="form-control" type="text" placeholder="Contact Number" name="contact" required>
                        </div>
                    </div>

                    <div class="pasa row name-in gap-1">
                        <div class="col g-col-6">
                            <button type="submit" class="btn btn-success suc-btn" style="margin-right: 20px;">Send Request</button>
                        </div>
                        <div class="col g-col-6">
                            <a href="index.html" type="submit" class="btn btn-danger suc-btn">Cancel</a>
                        </div>
                    </div>
                </div>

                <br>
            </div>
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


<script>
    $(document).ready(function(){
        $('#searchbt').click(function(event){
            event.preventDefault(); // Prevent the default form submission behavior
            var houseNumber = $('input[name="hnum"]').val(); // Get the house number value
            $.ajax({
                url: 'searchres.php', // PHP script to handle database query
                method: 'POST',
                data: {hnum: houseNumber}, // Send house number as data
                success: function(response){
                    var data = JSON.parse(response); // Parse the response JSON
                    if(data.error) {
                        alert(data.error); // Alert if there's an error
                    } else {
                        $('input[name="rlname"]').val(data.Last_Name); // Fill the surname field
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log error if AJAX request fails
                }
            });
        });
    });
</script>