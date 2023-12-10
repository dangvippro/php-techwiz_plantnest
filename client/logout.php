<?php 
session_start();

if(isset($_SESSION['role']) && isset($_SESSION['id']) && isset($_SESSION['email'])){
    unset($_SESSION['role']);
    unset($_SESSION['id']);
    unset($_SESSION['email']);
    unset($_SESSION['phone']);
    unset($_SESSION['password']);
    unset($_SESSION['comment']);
    unset($_SESSION['address']);
    unset($_SESSION['name']);
}
if(isset($_SESSION['favorites'])){
   unset($_SESSION['favorites']);
}
if(isset($_SESSION['cart'])){
    unset($_SESSION['cart']);
}
header('location: ../index.php');
