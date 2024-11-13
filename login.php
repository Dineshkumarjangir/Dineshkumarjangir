<?php
/*session_start();

$con = new mysqli('localhost', 'root', '', 'shoping_database');
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   
    $email = $_POST['email'];
    $password = $_POST['password'];
 

    if (!empty($email) && !empty($password) && !is_numeric($email)) {
        // Using prepared statements to prevent SQL injection
       /*  $query = "select * from signup where email ='$email' limit 1";
        $result = mysqli_query($con ,$query);

        if ($result) {
           
    if($result && mysqli_num_rows($result) > 0){
      $user_data = mysqli_fetch_assoc($result);

      if($user_data['password'] == $password){
        header("location :chatgptwebpage.php ");
       die;
      }
      }
    }
    echo "<script type='text/javascript'>alert('wrong username or password');</script>";
}
else {
  echo "<script type='text/javascript'>alert('wrong username or password');</script>";
}
 }*/
/* $stmt = $con->prepare("SELECT * FROM signup WHERE email = '$email' LIMIT 1");
        $stmt->bind_param("", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user_data = $result->fetch_assoc();

            // Verifying the password (assuming it's hashed)
            if (password_verify($password, $user_data['password'])) {
             $_SESSION['email'] = $user_data['email'];
                header("Location: chatgptwebpage.php");
                exit;
              } else {
                echo "<script type='text/javascript'>alert('Wrong username or password');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Wrong username or password');</script>";
        }

        $stmt->close();
    } else {
        echo "<script type='text/javascript'>alert('Please fill in all fields correctly');</script>";
    }
}

$con->close();
*/

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoping_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
if ($_SERVER['REQUEST_METHOD'] == "POST") {
   
  $email = $_POST['email'];
  $password = $_POST['password']; 

// Prepare and bind
$stmt = $conn->prepare("SELECT * FROM signup WHERE email = '$email' AND password = '$password' ");
$stmt->bind_param("ss", $email, $password);

// Execute the statement
$stmt->execute();

// Store the result
$stmt->store_result();

// Check if a matching record was found
if ($stmt->num_rows > 0) {
    $_SESSION['email'] = $email;
    echo "Login successful. Welcome, " . $email . "!";
    // Redirect to a new page or dashboard
    // header("Location: dashboard.php");
    header("Location: chatgptwebpage.php");
} else {
    echo "Invalid email or password.";
}

// Close the statement and connection
$stmt->close();
$conn->close();

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>  <meta charset="UTF-8">
    <meta name="viewport"content="width=device_width, inital-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet"href="signup.css">
</head>
<body style="background-color:dimgrey;" >
 <div class="login">
  <h1>Login</h1>
 <form>
  
  <labele>E-mail</labele>
  <input type="email" name="email" required>
  <labele>Password</labele>
  <input type="password" name="password" required>
 
 
<input type="submit" name="" value="submit">

 </form>
 <p>if you don't have an account -- <a href="signup.php">SignUp here</a></p>
 </div>   
</body>
</html>
