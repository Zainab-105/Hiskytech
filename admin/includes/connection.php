<?php
$server='localhost';
$username='root';
$password='';
$db='hiskytech';
$conn=mysqli_connect($server,$username,$password,$db);
if($conn){
    echo '';
}else{
    echo 'Error'.mysqli_error();
}
?>