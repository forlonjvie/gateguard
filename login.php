<?php
include 'connection.php';

session_start();

if (isset($_POST['submit'])) {
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = $_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT r.`ID`, r.`Image`, r.`First_Name`, r.`Last_Name`, r.`House_Number`, r.`Block`, r.`Email`, r.`Contact`, a.`id` AS `Account_ID`, a.`name` AS `Account_Name`, a.`password` AS `Account_Password`, a.`role` AS `Account_Role` FROM `residence` AS r JOIN `account` AS a ON r.`Email` = a.`email` WHERE a.`email` = ? AND a.`password` = ?");
   $select_user->bind_param("ss", $email, $pass);
   $select_user->execute();
   $result = $select_user->get_result();
   $row = $result->fetch_assoc();

   if ($result->num_rows > 0) {
      $_SESSION['user_id'] = $row['Account_ID'];
      $_SESSION['house_number'] = $row['House_Number']; // Storing House_Number in session

      if ($row['Account_Role'] === 'admin') {
         header('location: a-index.php');
      } else {
         header('location: b-index.php');
      }
      exit();
   } else {
      $message[] = 'Incorrect username or password!';
   }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>LogIn</title>

    <style>
        nav{
            background-color: rgb(247, 239, 203);
            position: fixed; /* Make the navbar fixed at the top */
            top: 0; /* Set it to the top of the viewport */
            left: 0; /* Set it to the left edge of the viewport */
            width: 100%; /* Make it full width */
            height: 80px;
            border-bottom: 1px solid rgb(40, 39, 39);
            box-shadow: 2px 3px 10px rgb(22, 22, 23);
            z-index: 1000; /* Set a high z-index to ensure it's above other content */
            grid-column: 1/2;
            grid-row: 1/2;
            display: grid;
            grid-template-columns: 300px 1fr;
            grid-template-rows: 80px;
            align-items: center;
        }
        .nav-logo{
            width: 200px;
            height: 50px;
            margin-left: 150px;
        }
        body {font-family: Arial, Helvetica, sans-serif;}
        .ac{
            margin-left: 520px;
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
            background: #f1f1f1;
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
            width: 900px;
            height: 500px;
            border: 1px solid #ccc;
            padding: 70px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
            background-color: white;
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
    </style>
</head>
<body>
    
    <nav>
        <div class="logo">
            <a class="navbar-brand" href="visitor.html">
                <img src="img/nav/ROXACO-removebg-preview-removebg-preview.png" alt="Logo" class="d-inline-block align-text-top nav-logo">
            </a>
        </div>
    </nav>

    <div>
        <img src="img/body/footer-bg-2.png" alt="..." style="height: 720px; width: 1518px;">
        <form action="" class="sig-form" method="POST">
            <div class="container">
                <h1>Log In</h1>
                <br>
                <label for="email"><b>Email</b><span class="ac">Need an account?<span><a href="signup.php" class="lg">Sing up</a></span></span></label>
                <input type="text" placeholder="Enter Email" name="email" required>

                <label for="psw"><b>Password</b></label>
                <div class="password-toggle">
                    <input type="password" placeholder="Enter Password" name="pass" id="password" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility()">👁️</span>
                </div>

                <br>
                <button type="submit" name="submit" class="btn btn-success suc-btn">Log In</button>
            </div>
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
    </script>
</body>
</html>