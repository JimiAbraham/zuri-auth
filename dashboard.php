<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }



  $db = mysqli_connect('localhost', 'root', '', 'zuri');
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
       
        <div class="alert alert-success">
  <strong><?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
          	
          </strong> 
</div>
      </div>
    <?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<div class="well well-lg">Hello,<?php echo $_SESSION['username']; ?>
    		
    		<a href="logout.php" style="color: red; float: right">logout</a>
    	</div>
      
      <p>  </p>
    <?php endif ?>

   
</div>

<div class="container">
  <div class="jumbotron">
    <h1>Welcome to our dashboard!</h1>
    <p>Thank you Zuri and the entire team!.</p>
  </div>
  <p>There are some badass designs on this page, but sorry mentor! You can't see them because you are not wearing a CSS glasses!</p>


</div>
<div class="container">
	<div class="well well-lg">
		This is the real deal!

<br>


<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add a course</button>


</div>

	<h2 style="text-align: center;"></h2>
<div class="well well-lg">Your Courses</div>
<?php 
$user = $_SESSION['username'];

$sql1 = "SELECT * FROM course WHERE userid = '$user'";
if($result1 = mysqli_query($db, $sql1)){
    if(mysqli_num_rows($result1) > 0){
        echo"<div class='table-responsive'>";  
        echo "<table class='table table-bordered'>";
            echo "<tr class='thead-dark table-hover'>";
                echo "<th>S/N</th>";

                 // echo "<th>Name</th>";

                  echo "<th>Course 1</th>";

                    echo "<th>Course 2</th>";
                
                
                
            
            echo "</tr>";
        while($row = mysqli_fetch_array($result1)){
            echo "<tr scope='row'>";
                echo "<td>" . $row['id'] . "</td>";

                 echo "<td>" . $row['course1'] . "</td>";

                   echo "<td>" . $row['course2'] . "</td>";
              
               


 echo '<td><a href="update.php?id='.$row['id'].'">Edit</a></td>';?>

<td><a href="delete.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this item')">Delete</a></td>
     <?php       echo "</tr>";
        }
        echo "</table>";
        echo"</div>";
        // Free result set
        mysqli_free_result($result1);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql1. " . mysqli_error($db);
}


?>
</body>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add a new course</h4>
      </div>
      <div class="modal-body">
       <form class="form-horizontal" action="" method="post">
  <div class="form-group">
    <label class="control-label col-sm-2" for="">Course 1:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="c1" placeholder="Course 1">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="">Course 2</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="c2" placeholder="Course 2">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for=""></label>
    <div class="col-sm-10">
      <input type="hidden" class="form-control" name="uid" value="<?php echo $_SESSION['username'];  ?> " placeholder="Course 2" readonly>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="course" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>







</html>

<?php


if (isset($_POST['course'])) {
  $c1 = mysqli_real_escape_string($db, $_POST['c1']);
  $c2 = mysqli_real_escape_string($db, $_POST['c2']);
  $uid = mysqli_real_escape_string($db, $_POST['uid']);



    $query = "INSERT INTO 	course (course1, course2, userid) 
          VALUES('$c1', '$c2', '$uid')";
    mysqli_query($db, $query);


    if($query){
  echo '<script type="text/javascript">
    
    alert( "Courses added!");
</script>';

 echo "<script>setTimeout(\"location.href = 'dashboard.php';\",1000);</script>";

    }else{
      echo '<script type="text/javascript">
    
    alert("Sorry, you no fit add course, maybe village people!");
</script>';
 echo "<script>setTimeout(\"location.href = 'register.php';\",1500);</script>";
     echo "Error: " . $query  . "<br>" . mysqli_error($db);
    // $_SESSION['username'] = $username;
    // $_SESSION['success'] = "You are now logged in";
    // header('location: register.php');
  }
}



?>