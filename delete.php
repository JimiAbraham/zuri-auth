

<?php
$db = mysqli_connect('localhost', 'root', '', 'zuri');



$sql = "DELETE FROM course WHERE id=".$_GET["id"];


if (mysqli_query($db, $sql)) {
echo '<script type="text/javascript">
    
    alert("Deleted successful!!");
</script>';
 echo "<script>setTimeout(\"location.href = 'dashboard.php';\",1500);</script>";

 } else {
  echo '<script type="text/javascript">
    
    alert( "Something went wrong, please check internet!");
</script>';
 echo "<script>setTimeout(\"location.href = 'dashboard.php';\",1500);</script>";
     echo "Error: " . $sql . "<br>" . mysqli_error($db);
 }





?>