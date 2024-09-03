<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Navigation Bar</title>
    <style type="text/css">
        * {
            text-decoration: none;
            box-sizing: border-box;
        }

        body {
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url(bg.jpg) no-repeat;
            background-size: cover;
            background-position: center;
            margin: 0;
            font-family: calibri;
        }

        .navbar {
            background: rgb(11, 105, 2);
            padding-right: 15px;
            padding-left: 15px;
        }

        .navdiv {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo a {
            font-size: 35px;
            font-weight: 600;
            color: white;
        }

        li {
            list-style: none;
            display: inline-block;
        }

        li a {
            color: white;
            font-size: 18px;
            font-weight: bold;
            margin-right: 25px;
        }

        button {
            background-color: black;
            color: white;
            margin-left: 10px;
            border-radius: 10px;
            padding: 10px;
            width: 90px;
        }

        button a {
            color: white;
            font-weight: bold;
            font-size: 15px;
        }

        /* Style for circular student records */
        .student-record {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 250px;
            height: 240px;
            background-color: rgba(250, 44, 8, 0.941); /* Transparent white background */
            border-radius: 50%; /* Circular shape */
            margin: 20px auto; /* Center horizontally and add space from top */
            font-size: 20px;
            font-weight: bold;
            color: black;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navdiv">
            <div class="logo"><a href="#">LBRCECSM</a></div>
            <ul>
                <li><a href="view.php">View Records</a></li>
                <li><a href="records.php">Add Records</a></li>
                <li><a href="#">About</a></li>
                <?php
                if(isset($_SESSION["username"]))
                {
                    ?><li><a href="#"><?php echo "Welcome ".$_SESSION["username"]?></a></li>
                    <li><a href="logout.php"><button>Logout</button></a></li>
                <?php
                }
                else
                {
                    ?>
                    <button><a href="signin.html">SignIn</a></button>
                    <?php
                }
                
                ?>
                
            </ul>
        </div>
    </nav>

    <!-- Circular student record management -->
    <div class="student-record">
        <h2>Student Record Management</h2>
    </div>
</body>
</html>
