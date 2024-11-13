<?php
session_start();

$con = new mysqli('localhost','root','','shoping_database');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phoneno = $_POST['phoneno'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    if (!empty($email) && !empty($password) && !is_numeric($email)) {
        // Using prepared statements to prevent SQL injection
        $query = "INSERT INTO signup (fname, lname, phoneno, email, password, address) VALUES (?,?,?,?,?,?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ssisss",$fname,$lname,$phoneno,$email,$password,$address);

        if ($stmt->execute()) {
            echo "<script type='text/javascript'>alert('Successfully Registered');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error: " . $stmt->error . "');</script>";
        }

        $stmt->close();
        
            header('location:chatgptwebpage.php');
          
    } else {
        echo "<script type='text/javascript'>alert('Please enter some valid Information');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
<div class="signup">
    <h1>Sign up</h1>
    <form method="post">
        <label>First Name</label>
        <input type="text" name="fname" required>
        <label>Last Name</label>
        <input type="text" name="lname" required>
        <label>Phone No.</label>
        <input type="text" name="phoneno" required>
        <label>Email</label>
        <input type="email" name="email" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <label>Address</label>
        <input type="text" name="address" required>
    <a href="D:\xampp\htdocs\my web project\chatgptwebpage.html"> <input type="submit" value="Submit"></a> 
    </form>
    <p>If you have an account -- <a href="login.php">Login here</a></p>
</div>
</body>
</html>
