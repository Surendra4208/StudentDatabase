<?php
session_start();

// Check if session is empty
if (empty($_SESSION)) {
    // Redirect user to login page
    echo '<script>alert("You have not Logged In...Login first."); window.location.href = "signin.html";</script>';
    
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Page</title>

   <!-- Font Awesome CDN link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- Custom CSS file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      /* Your custom styles here */

      body {
         min-height: 100vh;
         margin: 0;
         font-family: calibri;
         background: url(bg.jpg) no-repeat center center fixed;
         background-size: cover;
      }

      .navbar {
         background: rgba(11, 105, 2, 0.9); /* Transparent background with opacity */
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
      .btn {
   display: inline-block;
   background-color: var(--green);
   color: var(--white);
   padding: 10px 20px;
   border-radius: 5px;
   text-decoration: none;
   font-size: 18px;
   margin-right: 10px;
   transition: background-color 0.3s ease;
}

.btn i {
   margin-right: 5px;
}

.btn:hover {
   background-color: #218c74;
}

      .product-display {
         width: 80%;
         margin: 20px auto; /* Center the table horizontally with some top margin */
         background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
         padding: 20px; /* Add some padding for better visibility */
      }

      .product-display-table {
         width: 100%;
         border-collapse: collapse;
      }

      .product-display-table th,
      .product-display-table td {
         padding: 12px;
         border: 1px solid #ddd;
         text-align: center;
      }
      .product-display .product-display-table th {
    padding: 1.5rem; /* Increase padding for better spacing */
    font-size: 1.3rem; /* Increase font size for table headings */
}
      .product-display-table th {
         background-color: #f2f2f2;
      }

      .product-display-table img {
         max-width: 100px;
         height: auto;
         display: block;
         margin: 0 auto;
      }
   </style>
</head>
<body>
   <?php

   $servername = "localhost"; // Change this to your MySQL server hostname
   $username = "root"; // Change this to your MySQL username
   $password = ""; // Change this to your MySQL password
   $database = "student"; // Change this to your MySQL database name
   $conn = new mysqli($servername, $username, $password, $database);

   // Check connection
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }

   $select = mysqli_query($conn, "SELECT * FROM records");
   if(isset($_GET['Delete'])){
      $Re = $_GET['Delete'];
      // Added single quotes around $Re to make it a string in the query
      mysqli_query($conn, "DELETE FROM records WHERE Reg = '$Re'");
      // Redirect after deletion
      header('location:view.php');
      exit(); // Added exit after header to stop further execution
   };
   ?>
   <nav class="navbar">
        <div class="navdiv">
            <div class="logo"><a href="#">LBRCECSM</a></div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="records.php">Add Records</a></li>
                <li><a href="#">About</a></li>
                <?php
                if(!isset($_SESSION['username']))
                {

                    ?>
                    <button><a href="signin.html">SignIn</a></button>
                    <?php
                }
                ?>
            </ul>
        </div>
    </nav>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
            <tr>
               <th>Name</th>
               <th>Regd No</th>
               <th>Email</th>
               <th>Mobile</th>
               <th>Gender</th>
               <th>Student Image</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            <?php while ($row = mysqli_fetch_assoc($select)) { ?>
               <tr>
                  <td><?php echo $row['Name']; ?></td>
                  <td><?php echo $row['Reg']; ?></td>
                  <td><?php echo $row['Email']; ?></td>
                  <td><?php echo $row['Mobile']; ?></td>
                  <td><?php echo $row['Gender']; ?></td>
                  <td><img src="<?php echo $row['Image']; ?>" alt="Student Image"></td>
                  <td>
               <a href="update.php?Edit=<?php echo $row['Reg']; ?>" class="btn"> <i class="fas fa-trash"></i> Edit </a>
               <a href="view.php?Delete=<?php echo $row['Reg']; ?>" class="btn"> <i class="fas fa-trash"></i> Delete </a>
            </td>
               </tr>
            <?php } ?>
         </tbody>
      </table>
   </div>
</body>
</html>
