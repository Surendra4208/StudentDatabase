<?php
session_start();

// Check if session is empty
if (empty($_SESSION)) {
    // Redirect user to login page
    echo '<script>alert("You have not Logged In...Login first."); window.location.href = "signin.html";</script>';
    
    exit;
}
// Establish database connection
$servername = "localhost"; // Change this to your MySQL server hostname
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "student"; // Change this to your MySQL database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_product"])) {
    // Retrieve form data
    $Name = $_POST["Name"];
    $Reg = $_POST["Reg"];
    $Email = $_POST["Email"];
    $Mobile = $_POST["Mobile"];
    $Gender = $_POST["Gender"];
    
    // File upload handling
    $target_dir = "uploads/"; // Directory where uploaded images will be saved
    $target_file = $target_dir . basename($_FILES["Image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["Image"]["tmp_name"]);
    if($check !== false) {
        // Move uploaded file to target directory
        if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
            // Prepare and bind parameters
            $stmt = $conn->prepare("INSERT INTO records (Name, Reg, Email, Mobile, Gender, Image) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssiss", $Name, $Reg, $Email, $Mobile, $Gender, $target_file);
    
            // Execute the statement
            if ($stmt->execute()) {
                // Insert successful
                $message = "Student $Name record added successfully.";
            } else {
                // Insert failed
                $message = "Error: " . $stmt->error;
            }
    
            // Close statement
            $stmt->close();
        } else {
            // Error in uploading file
            $message = "Error uploading file.";
        }
    } else {
        // File is not an image
        $message = "File is not an image.";
    }
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
<style>@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

:root{
   --green:#27ae60;
   --black:#333;
   --white:#fff;
   --bg-color:#eee;
   --box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
   --border:.1rem solid var(--black);
}
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

body{
    
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url(bg.jpg) no-repeat;
    background-size: cover;
    background-position: center;
  }
.gg{
    font-size:2.0em;
}

*{
   font-family: 'Poppins', sans-serif;
   margin:0; padding:0;
   box-sizing: border-box;
   outline: none; border:none;
   text-decoration: none;
   text-transform: capitalize;
}

html{
   font-size: 62.5%;
   overflow-x: hidden;
}

.btn{
   display: block;
   width: 100%;
   cursor: pointer;
   border-radius: .5rem;
   margin-top: 1rem;
   font-size: 1.7rem;
   padding:1rem 3rem;
   background: var(--green);
   color:var(--white);
   text-align: center;
}

.btn:hover{
   background: var(--black);
}

.message{
   display: block;
   background: var(--bg-color);
   padding:1.5rem 1rem;
   font-size: 2rem;
   color:var(--black);
   margin-bottom: 2rem;
   text-align: center;
}

.container{
   max-width: 1200px;
   padding:2rem;
   margin:0 auto;
}

.admin-product-form-container.centered{
   display: flex;
   align-items: center;
   justify-content: center;
   min-height: 100vh;
   
}

.admin-product-form-container form{
   max-width: 50rem;
   margin:0 auto;
   padding:2rem;
   border-radius: .5rem;
   background: var(--bg-color);
}

.admin-product-form-container form h3{
   text-transform: uppercase;
   color:var(--black);
   margin-bottom: 1rem;
   text-align: center;
   font-size: 2.5rem;
}

.admin-product-form-container form .box{
   width: 100%;
   border-radius: .5rem;
   padding:1.2rem 1.5rem;
   font-size: 1.7rem;
   margin:1rem 0;
   background: var(--white);
   text-transform: none;
}

.product-display{
   margin:2rem 0;
}

.product-display .product-display-table{
   width: 100%;
   text-align: center;
}

.product-display .product-display-table thead{
   background: var(--bg-color);
}

.product-display .product-display-table th{
   padding:1rem;
   font-size: 2rem;
}


.product-display .product-display-table td{
   padding:1rem;
   font-size: 2rem;
   border-bottom: var(--border);
}

.product-display .product-display-table .btn:first-child{
   margin-top: 0;
}

.product-display .product-display-table .btn:last-child{
   background: crimson;
}

.product-display .product-display-table .btn:last-child:hover{
   background: var(--black);
}









@media (max-width:991px){

   html{
      font-size: 55%;
   }

}

@media (max-width:768px){

   .product-display{
      overflow-y:scroll;
   }

   .product-display .product-display-table{
      width: 80rem;
   }

}

@media (max-width:450px){

   html{
      font-size: 50%;
   }

}
</style>
</head>
<body>


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
    <?php
if(isset($message)){
   if(is_array($message) || is_object($message)) {
      foreach($message as $msg){
         echo '<span class="message">'.$msg.'</span>';
      }
   } else {
      echo '<span class="message">'.$message.'</span>';
   }
}

?>

<div class="container">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add student record</h3>
         <input type="text" placeholder="Enter Student name" name="Name" class="box" required>
         <input type="text" placeholder="Enter Student Regd No" name="Reg" class="box" required>
         <input type="email" placeholder="Enter Email" name="Email" class="box" required>
         <input type="number" placeholder="Enter Mobile Number" name="Mobile" class="box" required>
         <div class="gg">
         <label for="gender">Gender : </label>
         <input type="radio" name="Gender" value="male"> Male
         <input type="radio" name="Gender" value="female"> Female
         </div>
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="Image" class="box">
         <input type="submit" class="btn" name="add_product" value="Add Record">
      </form>

   </div>

  

</div>


</body>
</html>