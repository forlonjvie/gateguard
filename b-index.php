<?php
session_start();
include 'connection.php';
// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
    // Access the House_Number from the session
    $house_number = $_SESSION['house_number'];

    // Now you can use $house_number as an identifier for further processing
} else {
    // Redirect the user to the login page if not logged in
    header('location: login.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>HOME OWNER</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            text-decoration: none;
        }
        :root {
            --accent-color: #fff;
            --gradient-color: #fbfbfb;
        }
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100vw;
            height: 100vh;
            background-image: linear-gradient(-45deg, #e3eefe 0%, #efddfb 100%);
        }
        .sidebar a,
        .content a {
            text-decoration: none;
        }
        .sidebar {
            position: fixed;
            width: 240px;
            left: -240px;
            height: 100%;
            background-color: #fff;
            transition: all 0.5s ease;
        }
        .sidebar header {
            font-size: 28px;
            color: #353535;
            line-height: 70px;
            text-align: center;
            background-color: #fff;
            user-select: none;
            font-family: "Lato", sans-serif;
        }
        .sidebar a {
            display: block;
            height: 65px;
            width: 100%;
            color: #353535;
            line-height: 65px;
            padding-left: 30px;
            box-sizing: border-box;
            border-left: 5px solid transparent;
            font-family: "Lato", sans-serif;
            transition: all 0.5s ease;
        }
        a.active,
        a:hover {
            border-left: 5px solid var(--accent-color);
            color: #fff;
            background: linear-gradient(
            to left,
            var(--accent-color),
            var(--gradient-color)
            );
        }
        .sidebar a i {
            font-size: 23px;
            margin-right: 16px;
        }
        .sidebar a span {
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        #check {
            display: none;
        }
        label #btn,
        label #cancel {
            position: absolute;
            left: 5px;
            cursor: pointer;
            color: #846D62;
            border-radius: 5px;
            margin: 15px 30px;
            font-size: 29px;
            background-color: #F7EFEF;
            box-shadow: inset 2px 2px 2px 0px rgba(255, 255, 255, 0.5),
            inset -7px -7px 10px 0px rgba(0, 0, 0, 0.1),
            3.5px 3.5px 20px 0px rgba(0, 0, 0, 0.1), 2px 2px 5px 0px rgba(0, 0, 0, 0.1);
            height: 45px;
            width: 45px;
            text-align: center;
            text-shadow: 2px 2px 3px rgba(255, 255, 255, 0.5);
            line-height: 45px;
            transition: all 0.5s ease;
        }
        label #cancel {
            opacity: 0;
            visibility: hidden;
        }
        #check:checked ~ .sidebar {
            left: 0;
        }
        #check:checked ~ label #btn {
            margin-left: 245px;
            opacity: 0;
            visibility: hidden;
        }
        #check:checked ~ label #cancel {
            margin-left: 245px;
            opacity: 1;
            visibility: visible;
        }
        @media (max-width: 860px) {
            .sidebar {
            height: auto;
            width: 70px;
            left: 0;
            margin: 100px 0;
            }
            header,
            #btn,
            #cancel {
            display: none;
            }
            span {
            position: absolute;
            margin-left: 23px;
            opacity: 0;
            visibility: hidden;
            }
            .sidebar a {
            height: 60px;
            }
            .sidebar a i {
            margin-left: -10px;
            }
            a:hover {
            width: 200px;
            background: inherit;
            }
            .sidebar a:hover span {
            opacity: 1;
            visibility: visible;
            }
        }
        
        .sidebar > a.active,
        .sidebar > a:hover:nth-child(even) {
            --accent-color: #A79277;
            --gradient-color: #D1BB9E;
        }
        .sidebar a.active,
        .sidebar > a:hover:nth-child(odd) {
            --accent-color: #EAD8C0;
            --gradient-color: #D1BB9E;
        }
        
        .frame {
            width: 50%;
            height: 30%;
            margin: auto;
            text-align: center;
        }
        
        h2 {
            position: relative;
            text-align: center;
            color: #353535;
            font-size: 60px;
            font-family: "Lato", sans-serif;
            margin: 0;
            color: #a759f5;
        }
        
        p {
            font-family: "Lato", sans-serif;
            font-weight: 300;
            text-align: center;
            font-size: 30px;
            color: #d6adff;
            margin: 0;
        }
    </style>

</head>
<body>
    <input type="checkbox" id="check">
        <label for="check">
            <i class="fas fa-bars" id="btn"></i>
            <i class="fas fa-times" id="cancel"></i>
        </label>
    <div class="sidebar">
        <header><b>Menu</b></header>
        <a href="#" class="active">
            <i class="fas fa-qrcode"></i>
            <span>Profile</span>
        </a>
        <a href="b-v-data.php">
            <i class="fa fa-folder"></i>
            <span>Visitor Request</span>
        </a>
        <a href="b-r-view.php">
            <i class="fas fa-stream"></i>
            <span>Visit History</span>
        </a>
        <a href="#">
            <i class="fas fa-calendar"></i>
            <span>Events</span>
        </a>
        <a href="#">
            <i class="far fa-question-circle"></i>
            <span>About</span>
        </a>
        <a href="#">
            <i class="fas fa-sliders-h"></i>
            <span>Services</span>
        </a>
        <a href="#">
            <i class="far fa-envelope"></i>
            <span>Contact</span>
        </a>
    </div>

    <!-- for content -->
    <div class="frame">
        <p> Responsive </p>
        <h2>SIDE BAR HOME OWNER PROFILE</h2>
        <p>in Pure CSS</p>
    </div>
    <!-- for content end-->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var sidebarLinks = document.querySelectorAll('.sidebar a');
            sidebarLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    var checkbox = document.getElementById('check');
                    checkbox.checked = false; // Uncheck the checkbox to close the sidebar
                    toggleSidebar(); // Call the toggleSidebar function to close the sidebar smoothly
                });
            });
        });

        function toggleSidebar() {
            var checkbox = document.getElementById('check');
            checkbox.checked = !checkbox.checked;
            setTimeout(function() {
                var sidebar = document.querySelector('.sidebar');
                var sidebarWidth = sidebar.offsetWidth;
                if (checkbox.checked) {
                    sidebar.style.left = '0';
                } else {
                    sidebar.style.left = '-' + sidebarWidth + 'px';
                }
            }, 500); // Adjust the delay time as needed
        }
    </script>
</body>
</html>
