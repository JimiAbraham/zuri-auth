<?php  


session_start();

$username = $password = "";

$db = mysqli_connect('localhost', 'root', '', 'zuri');





if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
 echo '<script type="text/javascript">
    
    alert( "Pls enter correct username abeg!");
</script>';

 echo "<script>setTimeout(\"location.href = 'login.php';\",1000);</script>";
  }
  if (empty($password)) {
   echo '<script type="text/javascript">
    
    alert( "Una don forget password? Enter password abeg!");
</script>';

 echo "<script>setTimeout(\"location.href = 'login.php';\",1000);</script>";
  }

 
   
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['username'] = $username;
      // $_SESSION['id'] = $id;
      
      $_SESSION['success'] = "You are now logged in";
      header('location: dashboard.php');
    }else {
      echo '<script type="text/javascript">
    
    alert("You are a hoodloom, pls go away");
</script>';
 echo "<script>setTimeout(\"location.href = 'login.php';\",1500);</script>";
     // echo "Error: " . $query  . "<br>" . mysqli_error($db);
    }
  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Zuri Task</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
    font-family: 'Varela Round', sans-serif;
}
.modal-login {      
    color: #636363;
    width: 350px;
}
.modal-login .modal-content {
    padding: 20px;
    border-radius: 5px;
    border: none;
}
.modal-login .modal-header {
    border-bottom: none;   
    position: relative;
    justify-content: center;
}
.modal-login h4 {
    text-align: center;
    font-size: 26px;
    margin: 30px 0 -15px;
}
.modal-login .form-control:focus {
    border-color: #70c5c0;
}
.modal-login .form-control, .modal-login .btn {
    min-height: 40px;
    border-radius: 3px; 
}
.modal-login .close {
    position: absolute;
    top: -5px;
    right: -5px;
}   
.modal-login .modal-footer {
    background: #ecf0f1;
    border-color: #dee4e7;
    text-align: center;
    justify-content: center;
    margin: 0 -20px -20px;
    border-radius: 5px;
    font-size: 13px;
}
.modal-login .modal-footer a {
    color: #999;
}       
.modal-login .avatar {
    position: absolute;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: -70px;
    width: 95px;
    height: 95px;
    border-radius: 50%;
    z-index: 9;
    background: #60c7c1;
    padding: 15px;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.modal-login .avatar img {
    width: 100%;
}
.modal-login.modal-dialog {
    margin-top: 80px;
}
.modal-login .btn, .modal-login .btn:active {
    color: #fff;
    border-radius: 4px;
    background: #60c7c1 !important;
    text-decoration: none;
    transition: all 0.4s;
    line-height: normal;
    border: none;
}
.modal-login .btn:hover, .modal-login .btn:focus {
    background: #45aba6 !important;
    outline: none;
}
.trigger-btn {
    display: inline-block;
    margin: 100px auto;
}
</style>
</head>
<body>
<div class="text-center">
    <!-- Button HTML (to Trigger Modal) -->
    <a href="#myModal" class="trigger-btn" data-toggle="modal">Welcome to our security post, let us authenticate you! click here</a>
</div>

<!-- Modal HTML -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="modal-header">
                <div class="avatar">
                    <img src="pic.png" alt="Avatar">
                </div>              
                <h4 class="modal-title">Task: Login Gate</h4>   
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" required="required">     
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required="required"> 
                    </div>        
                    <div class="form-group">
                        <button type="submit"  name="login" class="btn btn-primary btn-lg btn-block login-btn">Login</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>     
</body>
</html>