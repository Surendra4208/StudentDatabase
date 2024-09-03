<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user = $_POST["username"];
    $pass = $_POST["password"];
    
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="student";
    $conn=mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn)
    {
        die("Connection failed:".mysqli_connect_error());
    }

        // Prepare and bind the query
        $sql = "SELECT * FROM login WHERE username ='$user'";
        $result=mysqli_query($conn,$sql);

        // Check if user exists
        if ($result->num_rows >0) {
            $row = $result->fetch_assoc();
            
            // Verify password
            if ($pass == $row["password"]) {
                // Authentication successful, set session variable and redirect to dashboard
                $_SESSION["username"] = $row["username"];
                header("Location: index.php");
                exit; // Ensure script stops execution after redirect
            } else {
                // Password is incorrect
                echo "Incorrect password!";
                header("Location: signin.html");
                exit; // Ensure script stops execution after redirect
            }
        } else {
            // User does not exist
            echo "User not found!";
        }

        // Close statement and connection
        mysqli_close($conn);
    }

?>