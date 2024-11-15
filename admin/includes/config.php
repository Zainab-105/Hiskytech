<?php
include ('connection.php');
session_start();
if(isset($_SESSION['adminid'])){

    $aid=$_SESSION['adminid'];
    $udata=mysqli_query($conn,"SELECT * from admin where aid='$aid'");
    $data=mysqli_fetch_array($udata);

}else{
    header('location:login.php');
}
?>