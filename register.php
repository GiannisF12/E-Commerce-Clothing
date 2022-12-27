<?php 
include 'includes/functions.php';
session_start();
$warning = "";

if (isset($_SESSION['username'])) 
{
  header("Location: index.php");
}

if (isset($_POST['submit'])) 
{
  $username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

  /*
  Password requirements
  Must be a minimum of 8 characters
  Must contain at least 1 number
  Must contain at least one uppercase character
  Must contain at least one lowercase character
  */
  $pattern = '#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#';
  if (preg_match($pattern, $_POST['password'] ))
  {
    if ($password == $cpassword) 
    {
      $sql = "SELECT * FROM users WHERE email='$email'";
      $result = mysqli_query($conn, $sql);
      if (!$result->num_rows > 0) 
      {
        $sql = "INSERT INTO users (username, email, password , access) VALUES ('$username', '$email', '$password', 'Member')";
        $result = mysqli_query($conn, $sql);
        if ($result) 
        {
          echo "<script>alert('Wow! Register Completed.')</script>";
          $username = "";
          $email = "";
          $_POST['password'] = "";
          $_POST['cpassword'] = "";
        } 
        else 
        {
          echo "<script>alert('Woops! Something Wrong Went.')</script>";
        }
      } 
      else 
      {
        echo "<script>alert('Woops! Email Already Exists.')</script>";
      }
    }

    else 
    {
      echo "Password Not Matched";
    }
  } 
  else 
  {
    $warning = "Must be a minimum of 8 characters<br>
    Must contain at least 1 number<br>
    Must contain at least one uppercase character<br>
    Must contain at least one lowercase character";
  }

}
?>


<!DOCTYPE html>
<html>
  <head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!--Styles CSS-->
    <link rel="stylesheet" href="css/login-register.css">
  </head>

  <body>
      <div id="frmRegistration">
        <h2>Register</h2>
        <form class="form-horizontal" action="" method="POST">
          <div class="form-group">
            <label class="control-label col-sm-2" for="lastname">Username:</label>
            <div class="col-sm-6">
              <input type="text" name="username" class="form-control"  placeholder="Enter Username"  required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-6">
              <input type="email" name="email" class="form-control"  placeholder="Enter email"  required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Password:</label>
            <div class="col-sm-6"> 
              <input type="password" name="password" class="form-control" placeholder="Enter password"  required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Password:</label>
            <div class="col-sm-6"> 
              <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password"  required>
            </div>
          </div>
          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" name="submit" class="btn btn-primary">Register</button>
            </div>
          </div>
          <p class="login-register-text">Have an account? <a href="login.php">Login Here</a>.</p>
          <br>
          <div class="login-register-text">
            <?php echo $warning; ?>
          </div>
        </form>
      </div>




  </body>
</html>