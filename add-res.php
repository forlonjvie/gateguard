<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Add Residents</title>
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
            margin-top: -400px;
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
        .form-horizontal{
            margin-top: -675px;
        }
    </style>
</head>
<body>
    
    <div>
        <img src="img/body/footer-bg-2.png" alt="..." style="height: 720px; width: 1518px;">
        <form class="form-horizontal" action="insertres.php" method="post" >
            <div class="container">
                <h1 style="color: #1E771E;">Townhomes HomeOwner Application Form</h1>
                <br>

                <div class="form-row">
                    <label class="name"><b>Capture Image</b></label>
                    <div class="value">
                        <div class="row row-space">
                            <div class="col-2" id="video-container">
                                <video id="video" width="300" height="200" autoplay></video>
                            </div>
                            <div class="col-2" id="canvas-container">
                                <canvas id="canvas" width="300" height="200" style="border: 1px solid black; display: none;"></canvas>
                            </div>
                            <div class="btn-vid">
                                <button type="button" class="btn btn-success" id="capture" style="margin-top: 220px; margin-right: 100px">Capture</button>
                            </div>
                        </div>
                        <input type="hidden" name="imageData" id="imageData">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="control-group">
                            <label class="control-label"><b>ID</b></label>
                            <div class="controls">
                                <textarea name="id" id="getUID" placeholder="Please Scan your Card / Key Chain to display ID" rows="1" cols="1" class="full-width unresizable"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <div class="int">
                    
                    <label for="name"><b>Name</b></label>
                    <div class="row name-in gap-4">
                        <input class="col g-col-6" type="text" placeholder="First Name" name="first_name">
                        <input class="col g-col-6" type="text" placeholder="Last Name" name="last_name">

                    </div>

                    <label for="name"><b>Address</b></label>
                    <div class="row name-in gap-4">
                        <input class="col g-col-6" type="text" placeholder="House Number" name = "housenum">
                        <input class="col g-col-6" type="text" placeholder="Block" name = "block">
                    </div>

                    <label for="name"><b>Contact</b></label>
                    <div class="row name-in gap-4">
    <input class="col g-col-6" type="text" placeholder="Email" name="email">
    <input class="col g-col-6" type="text" placeholder="Please enter a valid 9-digit phone number" name="contact"  maxlength="10">
</div>



                    <div class="pasa">
                        <!-- <a href="#" class="btn btn-success suc-btn" style="margin-right: 20px;">Log In</a> -->
                        <button class="btn btn-success suc-btn" type="submit">Register</button>
                        <a href="n-resident.php" type="submit" class="btn btn-danger suc-btn">Cancel</a>
                    </div>
                </div>

                <br>
            </div>
        </form>
    </div>

</body>

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

</html>