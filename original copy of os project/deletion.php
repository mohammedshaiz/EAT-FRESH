<?php
session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con,'login_register_pure_coding');


  
if(!$con){
    die("Connection failed : ".mysqli_connect_error());
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $id = $_POST['id'];
    $quantity = $_POST['quantitys'];
$sql = "DELETE FROM cart  WHERE id=''";

if(mysqli_query($con,$sql)){
    echo "Record deleted successfully";
}
else{
    echo"Error deleting record:".mysqli_error($con);
}

mysqli_close($con);
?>