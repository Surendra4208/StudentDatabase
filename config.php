<?php
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

// Fetch images from the database
$sql = "SELECT * FROM records";
$result = $conn->query($sql);

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
   <!-- Your CSS styles -->
</head>
<body>

<div class="container">
   <!-- Display images from the database -->
   <?php if ($result->num_rows > 0) : ?>
      <div class="product-display">
         <table class="product-display-table">
            <thead>
               <tr>
                  <th>Student Image</th>
                  <!-- Add other table headers as needed -->
               </tr>
            </thead>
            <tbody>
               <?php while ($row = $result->fetch_assoc()) : ?>
                  <tr>
                     <td><img src="<?php echo $row['Image']; ?>" height="100" alt="Student Image"></td>
                     <!-- Add other table data as needed -->
                  </tr>
               <?php endwhile; ?>
            </tbody>
         </table>
      </div>
   <?php else : ?>
      <p>No images found.</p>
   <?php endif; ?>
</div>

</body>
</html>
