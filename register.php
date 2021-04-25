<?php 


$username = $password  = $email = ""; //becuase ut flagg me error


// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'zuri');



if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

// $pass = md5($password);
 
  $sql_u = "SELECT * FROM users WHERE username='$username' OR email ='$email'";
  $res_u = mysqli_query($db, $sql_u);

   if (mysqli_num_rows($res_u) > 0) {

echo '<script type="text/javascript">
    
    alert("Omooo...cant use this details to register!");
</script>';
 echo "<script>setTimeout(\"location.href = 'register.php';\",3500);</script>";



    }

  else{

    $query = "INSERT INTO users (username, email, password) 
          VALUES('$username', '$email', '$password')";
    mysqli_query($db, $query);


    if($query){
  echo '<script type="text/javascript">
    
    alert( "Registration was successful, pls login now!");
</script>';

 echo "<script>setTimeout(\"location.href = 'login.php';\",1000);</script>";

    }else{
      echo '<script type="text/javascript">
    
    alert("Yawa don gas, reg no complete");
</script>';
 echo "<script>setTimeout(\"location.href = 'register.php';\",1500);</script>";
     echo "Error: " . $query  . "<br>" . mysqli_error($db);
    // $_SESSION['username'] = $username;
    // $_SESSION['success'] = "You are now logged in";
    // header('location: register.php');
  }
}
}






?>
<!DOCTYPE html>
<html>
<head>
  <title>Register  into Zuri</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="">
  	
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password">
  	</div>
  	
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>