<?php
session_start();
ob_start();
include_once '../classes/Users.php';
include_once '../assets/database.php';

if(isset($_POST['login']) && ($_POST['login'])){
    $id = $_POST['userid'];
    $pass = $_POST['password'];
    
    $result = getUserInfo($conn, $id);
    $data = $result->fetch_assoc();
    $checkID = $result->num_rows;
    
    if($checkID == 1){
        
        $checkPass = password_verify($pass, $data['password']);
        if($checkPass){ 
            if($data['role'] == 1){
                $_SESSION['role'] = $data['role'];
                $_SESSION['idAdmin'] = $data['userID'];
                $_SESSION['passwordAdmin'] = $data['password'];
                $_SESSION['nameAdmin'] = $data['fullname'];
                $_SESSION['phoneAdmin'] = $data['phone'];
                $_SESSION['addressAdmin'] = $data['address'];
                $_SESSION['emailAdmin'] = $data['email'];
                $_SESSION['birthdayAdmin'] = $data['birthday'];
                $_SESSION['genderAdmin'] = $data['gender'];
                header('location: home.php');
            }
        }
    } else {
                $txt_error = "ID or password does not exist.";
            }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>

        <!-- favicon -->
        <link rel="shortcut icon" type="image/png" href="../assets/images/icon-logo.png">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">   
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
        <style>
            .alert{
            position: fixed; 
            top:25px;
            right:25px;
        }
        </style>
    </head>
    <body>
        <div class="mt-5 d-flex justify-content-around">
            <form action="" method="POST">
                <div class="container text-center ">
                       <div style="width:100%; font-size:15px">
                            <p class="alert-danger">
                        </div>
                    <table>
                        <thead>
                            <tr>
                                <th colspan="2"><h1 class="mt-3 fs-1 fw-bold" >LOGIN ACCOUNT</h1></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                                <td><p class="mt-4 fs-2 ">
                                <i class="bi bi-person-circle"></i> UserID:</p> 
                                </td>
                                <td><input type="search" placeholder="Enter UserID" style="width:300px; height:35px" name="userid" required class="form-control shadow-none fs-3"  ></td>
                            </tr>
                            <tr>
                                <td><p class="fs-2 mt-4" style="margin-left:20px">
                                <i class="bi bi-lock"></i>  Password: </p>
                                </td> 
                                <td> <input type="password" placeholder="Enter Password" style="width:300px; height:35px;" name="password"  required class="form-control shadow-none fs-3"  ></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="title-login">
                                    <input type="submit" class="btn btn-outline-dark shadow-none me-lg-3 mt-2 me-3 fs-4"  style="margin-left:-100px"  value="LOGIN" name="login" style=""/>
                                    <input type="reset" class="btn btn-outline-dark shadow-none me-lg-3 mt-2 me-3 fs-4" value="RESET" name="reset" id="btn-reset"/>
                                </td>
                            </tr>
                            <?php 
                            if(isset($txt_error) && ($txt_error != "")){
                                echo "<tr>
                                        <td></td>
                                        <td>
                                            <font color = 'red'>$txt_error</font>
                                        </td>
                                    </tr>";
                            }?>
                        </tbody>
                    </table>
                        
                </div>
            </form>
        </div>
    </body>
</html>
