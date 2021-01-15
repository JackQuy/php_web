<?php
session_start();
if(isset($_GET['id'])) {
    // echo $_GET['id'];
    // echo "<pre>";
    // print_r($_SESSION['cart'][$_GET['id']]);
    unset($_SESSION['cart'][$_GET['id']]);
   
    
}
header("Location: ../cart.php?id=10");