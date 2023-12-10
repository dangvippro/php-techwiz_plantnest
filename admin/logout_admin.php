<?php
session_start();
if(isset($_SESSION['role']) && isset($_SESSION['idAdmin']) && isset($_SESSION['emailAdmin']) && isset($_SESSION['nameAdmin']) && isset($_SESSION['addressAdmin']) && isset($_SESSION['phoneAdmin']) && isset($_SESSION['passwordAdmin']) && isset($_SESSION['genderAdmin']) && isset($_SESSION['birthdayAdmin'])){
    unset($_SESSION['role']);
    unset($_SESSION['idAdmin']);
    unset($_SESSION['emailAdmin']);
    unset($_SESSION['nameAdmin']);
    unset($_SESSION['addressAdmin']);
    unset($_SESSION['phoneAdmin']);
    unset($_SESSION['passwordAdmin']);
    unset($_SESSION['birthdayAdmin']);
    unset($_SESSION['genderAdmin']);
}
header('location: login_admin.php');

