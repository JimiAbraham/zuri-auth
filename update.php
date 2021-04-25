<?php

  session_start(); 

  $update = $_GET["id"];

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

if(isset($_POST['update'])){

$c1 = mysqli_real_escape_string($db, $_POST['c1']);
$c2 = mysqli_real_escape_string($db, $_POST['c2']);







$sql = "UPDATE course SET course1 = '$c1', course2 = '$c2'  WHERE id=".$_GET["id"];


if (mysqli_query($db, $sql)) {
echo '<script type="text/javascript">
    
    alert("Update was successful!!");
</script>';
 echo "<script>setTimeout(\"location.href = 'dashboard.php';\",1500);</script>";

 } else {
  echo '<script type="text/javascript">
    
    alert( "Something went wrong, please check internet!");
</script>';
 echo "<script>setTimeout(\"location.href = 'dashbaord.php';\",1500);</script>";
     echo "Error: " . $sql . "<br>" . mysqli_error($db);
 }


}






?>



<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update course</h4>
      </div>
      <div class="modal-body">
	<form class="form-horizontal" action="" method="post">

		<?php

		// $sql = "SELECT * FROM course WHERE id =".$_GET["id"];

$sql = "SELECT * FROM course WHERE id = '$update'";

if($result = mysqli_query($db, $sql)){
    if(mysqli_num_rows($result) > 0){



              while($row = mysqli_fetch_array($result)){
            echo'
  <div class="form-group">
    <label class="control-label col-sm-2" for="">Course 1:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="c1" value="'.$row['course1'].'">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="">Course 2</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="c2" value="'.$row['course2'].'">
    </div>
  </div>';
  
}  
  echo'<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="update" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>';

}

}?>

</body>
</html>