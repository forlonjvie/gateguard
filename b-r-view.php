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

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

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
            background-image: linear-gradient(-45deg, #EAD8C0 0%, #EAD8C0 100%);
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
            z-index: 1;
            border-right: 1px solid;
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
        .sidebar a.active,
        .sidebar a:hover {
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
            .sidebar a:hover {
                width: 200px;
                background: inherit;
            }
            .sidebar a:hover span {
                opacity: 1;
                visibility: visible;
            }
        }
        
        .sidebar > .sidebar a.active,
        .sidebar > a:hover:nth-child(even) {
            --accent-color: #A79277;
            --gradient-color: #D1BB9E;
        }
        .sidebar a.active,
        .sidebar > a:hover:nth-child(odd) {
            --accent-color: #EAD8C0;
            --gradient-color: #D1BB9E;
        }

        /* .frame {
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
        } */

        /* content style */
        .content{
            margin-left: 300px;
            margin-top: -720px;
            margin: auto;
            position: relative;
        }
        .add-res{
            margin-left: 800px;
        }
        .card{
            width: 1200px;
            height: 650px;
            margin-top: -50px;
            border: 2px solid;
            box-shadow: 2px 3px 10px rgb(22, 22, 23);
        }
        .card-header{
            background-color: rgb(247, 239, 203);
            border-bottom: 2px solid;
        }
        table thead tr td{
            text-align: center;
        }
        table tbody tr td{
            text-align: center;
        }
        /* content style end */
    </style>

</head>
<body>
    <input type="checkbox" id="check">
        <label for="check" style="z-index: 1;">
            <i class="fas fa-bars" id="btn"></i>
            <i class="fas fa-times" id="cancel"></i>
        </label>
    <div class="sidebar" id="bar">
        <header><b>Menu</b></header>
        <a href="b-index.php">
            <i class="fas fa-qrcode"></i>
            <span>Profile</span>
        </a>
        <a href="b-v-data.php">
            <i class="fa fa-folder"></i>
            <span>Visitor Request</span>
        </a>
        <a href="#" class="active">
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

    <!-- for content
    <div class="frame">
        <p> Responsive </p>
        <h2>SIDE BAR</h2>
        <p>in Pure CSS</p>
    </div>
    for content end -->

    <!-- content -->
    <div class="content">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #28a745;"><b>Visit History View</b>
                                <!-- <a href="add-res.php" type="button" class="btn btn-success add-res">Add Resident</a> -->
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="product-table">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                        
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">First Name</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Last Name</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date inquare</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date validity</th>
                                        <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th> -->
                                        <th class="text-secondary opacity-7">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
$select_products = $conn->prepare("SELECT * FROM visit_history WHERE house_Num = ?");
$select_products->bind_param("s", $house_number); // Binding the parameter
$select_products->execute();
$result = $select_products->get_result();

if ($result->num_rows > 0) {
    while ($fetch_products = $result->fetch_assoc()) {
        // Your code to display visit history data
        ?>
        <tr>
            <td class="align-middle text-center"><?= $fetch_products['guestID']; ?></td>
            
            <td class="align-middle text-center"><?= $fetch_products['v_fname']; ?></td>
            <td class="align-middle text-center"><?= $fetch_products['v_lname']; ?></td>
            <td class="align-middle text-center"><?= $fetch_products['Date']; ?></td>
            <td class="align-middle text-center"><?= $fetch_products['expireDate']; ?></td>
            <td class="align-middle text-center"><?= $fetch_products['Status']; ?></td>
            <!-- <td class="align-middle text-center">
                <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="Product Image" width="100" height="100">
            </td> -->
            <!-- <td>
                <a href="edit-res.php?id=<?= $fetch_products['ID']; ?>" class="fas fa-eye"></a>
            </td> -->
        </tr>
        <?php
    }
} else {
    echo '<tr><td colspan="7">No Residence</td></tr>';
}
?>

                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content end -->

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

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

        $(document).ready(function () {
            $('#product-table').DataTable({
                responsive: {
                    details: {
                        display: DataTable.Responsive.display.modal({
                            header: function (row) {
                                var data = row.data();
                                return 'Details for ' + data[0] + ' ' + data[1];
                            }
                        }),
                        renderer: DataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                }
            });
        });
    </script>
</body>
</html>


