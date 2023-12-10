<?php 
session_start();
ob_start();
if(isset($_SESSION['role']) && ($_SESSION['role'] == 1)){
include_once '../classes/Users.php';
include_once '../assets/database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/admins.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="">
    <title>Manage Account</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="../assets/images/icon-logo.png">
</head>

<body>
    <nav class="navbar header sticky-top">
        <div class="header-left">
            <div class="navbar-brand">
                <a href="./home.php">
                    <img src="../assets/images/logo/logo.png" alt="logo" class="img-fluid header-brand">
                </a>
            </div>
        </div>

        <div class="dropdown header-right" style="margin-right: 60px;">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Account
            </button>
            <?php if(isset($_SESSION['emailAdmin']) && ($_SESSION['emailAdmin'])){ ?>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="manageAccountAdmin.php"><?php echo $_SESSION['emailAdmin']; ?></a></li>
                <li><a class="dropdown-item" href="logout_admin.php">Logout</a></li>
            </ul>
            <?php } else { ?>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="login_admin.php">Login</a></li>
            </ul>
            <?php } ?>
        </div>
    </nav>
    <div id="body">
        <div id="menu-nav" style="display: block;" class="menu-manage">
            <ul class="menu-nav__list" style="list-style: none;">
                <li class="menu-nav__item">
                    <a href="./home.php" class="menu-nav__link">
                        <div>
                            <i class="fa-solid fa-house" style="margin-right: 6px;"></i>
                            Admin HomePage
                        </div>
                    </a>
                </li>
                <li class="menu-nav__item">
                    <a href="./manageProduct.php" class="menu-nav__link">
                        <div>
                            <i class="fa-solid fa-bars-progress" style="margin-right: 6px;"></i>
                            Manage Products
                        </div>
                    </a>
                </li>
                <li class="nav-item menu-nav__item">
                    <a href="./manageCategory.php" class="menu-nav__link">
                        <div>
                            <i class="fa-regular fa-rectangle-list" style="margin-right: 6px;"></i>
                            Manage Categories
                        </div>
                    </a>
                </li>
                <li class="menu-nav__item">
                    <a href="home.php" class="menu-nav__link nav-link dropdown-toggle" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div>
                            <i class="fa-solid fa-cart-shopping" style="margin-right: 6px;"></i>
                            Manage Orders
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item fs-7" href="manageOrders.php">View Orders</a></li>
                        <li><a class="dropdown-item fs-7" href="confirmationOrder.php">Order confirmation</a></li>
                        <li><a class="dropdown-item fs-7" href="ordered.php">Order confirmed</a></li>
                    </ul>
                </li>
                <li class="menu-nav__item">
                    <a href="controlUserAccount.php" class="menu-nav__link">
                        <div>
                            <i class="fa-solid fa-bars-progress" style="margin-right: 6px;"></i>
                            Control User Accounts
                        </div>
                    </a>
                </li>
                <li class="menu-nav__item">
                    <a href="./userQueries.php" class="menu-nav__link">
                        <div>
                            <i class="fa-solid fa-comments" style="margin-right: 6px;"></i>
                            View Feedback
                        </div>
                    </a>
                </li>
                <li class="menu-nav__item">
                    <a href="./userReview.php" class="menu-nav__link">
                        <div>
                            <i class="fa-solid fa-star" style="margin-right: 6px;"></i>
                            View Reviews
                        </div>
                    </a>
                </li>
                <li class="menu-nav__item">
                    <a href="home.php" class="menu-nav__link nav-link dropdown-toggle" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div>
                            <i class="fa-solid fa-boxes-stacked" style="margin-right: 6px;"></i>
                            Availability
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-light side" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item fs-7" href="availability.php?action=flowering"><i class="fa-solid fa-spa"></i> Flowering</a></li>
                        <li><a class="dropdown-item fs-7" href="availability.php?action=nonFlowering"><i class="fa-brands fa-pagelines"></i> Non-flowering</a></li>
                        <li><a class="dropdown-item fs-7" href="availability.php?action=indoor"><i class="fa-solid fa-umbrella"></i> Indoor</a></li>
                        <li><a class="dropdown-item fs-7" href="availability.php?action=outdoor"><i class="fa-solid fa-sun"></i> Outdoor</a></li>
                        <li><a class="dropdown-item fs-7" href="availability.php?action=succulents"><i class="fa-solid fa-seedling"></i> Succulents</a></li>
                        <li><a class="dropdown-item fs-7" href="availability.php?action=medicinal"><i class="fa-solid fa-prescription-bottle-medical"></i> Medicinal</a></li>
                        <li><a class="dropdown-item fs-7" href="availability.php?action=pots"><i class="fa-solid fa-glass-water"></i> Pots</a></li>
                        <li><a class="dropdown-item fs-7" href="availability.php?action=gardenTools"><i class="fa-solid fa-trowel"></i> Garden tools</a></li>
                        <li><a class="dropdown-item fs-7" href="availability.php?action=pesticides"><i class="fa-solid fa-flask-vial"></i> Pesticides</a></li>
                    </ul>
                </li>
                <li class="menu-nav__item">
                    <a href="soldQuantity.php" class="menu-nav__link">
                        <div>
                            <i class="fa-solid fa-cart-flatbed" style="margin-right: 6px;"></i>
                            Sold Quantity
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        
        
        
        <div class="body-container" style="width: 100%;">
            <div class="body-container__welcome">
                <h3 style="margin-bottom: 1rem;">ACCOUNT INFORMATION</h3>
                <div>
                    <img src="../assets/images/logo/logo.png" class="img-fluid" alt="logo" style="width: 250px;">
                </div>
            </div>
            <?php 
//            Update account
            if(isset($_POST['updateAccount'])){
                $id = $_POST['id'];
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $birthday = $_POST['birthday'];
                $gender = $_POST['gender'];
                if (updateAccount($conn, $id, $name, $phone, $email, $address, $birthday, $gender)) {
                    echo '<div class="text-center text-success fs-3" style="margin: 1% 0%;"><i class="fas fa-check-circle"></i><strong> Update account information successfully!</strong></div>';
                } else {
                    echo '<div class="text-center text-danger">Update account information failed!</div>';
                }
            }
            //Change password
            if (isset($_GET['action']) && ($_GET['action'] == 'changePassword')) {
                if (isset($_POST['changePass'])) {
                    $id = $_GET['idAccount'];
                    $oldPassword = $_POST['oldPassword'];
                    $newPassword = $_POST['newPassword'];
                    $confirmPassword = $_POST['confirmPassword'];

                    $getPassword = getUserInfo($conn, $id);
                    $row = $getPassword->fetch_assoc();
                    $currentPassword = $row['password'];
    //                echo $currentPassword;
                    $checkPass = password_verify($oldPassword, $currentPassword);
                    $newPass = password_hash($newPassword, PASSWORD_DEFAULT);
    //                var_dump($checkPass);
                    if(!$checkPass){
                        $txt_error = "<div class='text-center text-danger fs-3'> <strong>Invalid old pasword.</strong></div>";
                    } else if ($confirmPassword != $newPassword){
                        $txt_confirm_error = "<div class='text-center text-danger fs-3'><strong>Confirm password does not match.<strong></div>";
                    } else {
                        if(updatePassword($conn, $id, $newPass)){
                            echo '<div class="text-center text-success fs-3" "><i class="fas fa-check"></i><strong> Change password successfully!</strong></div>';
                        } else {
                            echo '<div class="text-center text-danger fs-3">strong>Change password failed!</strong></div>';
                        }
                    }
                }
            }
            ?>
            <!--form change password-->
            <?php if (isset($_GET['action']) && ($_GET['action'] == "changePassword")) { ?>
                <div class="form-edit">
                    <form method="POST">
                    <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                        <h5 class="mb-3 fw-bold fs-2"></br></br></h5>
                    
                        <h1 class="top-30 start-30 text-center fs-2" style="margin-top:-90px;">Change Password</h1>
                        <table class="" style="margin-bottom:50px; margin-left: 300px;">
                                <tr>
                                    <td><div class="fs-4 fw-bold p-4 ">Old password:</div> </td>
                                    <td>
                                        <input class="fs-3 " type="password" name="oldPassword" value="" placeholder="Enter your password"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><div class="fs-4 fw-bold p-4 ">New password: </div></td>
                                    <td>
                                        <input class="fs-3 " type="password" name="newPassword" value="" placeholder="Enter new password" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><div class="fs-4 fw-bold p-4  ">Confirm new password: </div></td>
                                    <td><input class="fs-3 " type="password" name="confirmPassword" value="" placeholder="Confirm new password" required/></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="mt-4 " style="margin-left:150px">
                                            <input class="btn btn-outline-dark" style="font-size: 16px;" type="submit" name="changePass" value="Submit" />
                                            <input class="btn btn-outline-dark" style="font-size: 16px;" type="reset" value="Reset" />
                                            <a href="manageAccountAdmin.php" class="btn btn-outline-dark" style="font-size: 16px;">Account information</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php 
                        if(isset($txt_error) && ($txt_error != "")){
                            echo "<font color = 'red'>$txt_error</font>";
                        }
                        ?>
                        <?php 
                        if(isset($txt_confirm_error) && ($txt_confirm_error != "")){
                            echo "<font color = 'red'>$txt_confirm_error</font>";
                        }
                        ?>
                    </form>
                </div></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>

            <?php } ?>
            <!-- end form change password -->
            
            <div class="body-container-form">
                <form method="post" style="margin: 0px 150px 0px 150px;">
                    <?php
                    if(isset($_SESSION['emailAdmin']) && ($_SESSION['emailAdmin']!="")){
                        $ID = $_SESSION['idAdmin'];
                        $result = getUserInfo($conn, $ID);
                        if ($result->num_rows == 1) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label fs-5" style="width: 15%;">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control fs-5" id="id" name="id" value="<?php echo $row["userID"] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row" style="margin-top: 10px;">
                        <label class="col-sm-2 col-form-label fs-5" style="width: 15%;">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control fs-5" id="name" name="name" value="<?php echo $row["fullname"] ?>">
                        </div>
                    </div>
                    <div class="form-group row" style="margin-top: 10px;">
                        <label class="col-sm-2 col-form-label fs-5" style="width: 15%;">Gender</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control fs-5" id="gender" name="gender" value="<?php echo $row["gender"] ?>">
                        </div>
                    </div>
                    <div class="form-group row" style="margin-top: 10px;">
                        <label class="col-sm-2 col-form-label fs-5" style="width: 15%;">Birthday</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control fs-5" id="birthday" name="birthday" value="<?php echo $row["birthday"] ?>">
                        </div>
                    </div>
                    <div class="form-group row" style="margin-top: 10px;">
                        <label class="col-sm-2 col-form-label fs-5" style="width: 15%;">Phone number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control fs-5" id="phone" name="phone" value="<?php echo $row["phone"] ?>">
                        </div>
                    </div>
                    <div class="form-group row" style="margin-top: 10px;">
                        <label class="col-sm-2 col-form-label fs-5" style="width: 15%;">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control fs-5" id="email" name="email" value="<?php echo $row["email"] ?>">
                        </div>
                    </div>
                    <div class="form-group row" style="margin-top: 10px;">
                        <label class="col-sm-2 col-form-label fs-5" style="width: 15%;">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control fs-5" id="address" name="address" value="<?php echo $row["address"] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" style="width: 15%;"></label>
                        <div class="col-sm-10" style="margin-top: 20px;">
                            <input class="btn btn-outline-dark" style="font-size: 16px;" type="submit" name="updateAccount" value="Update"/>
                            <a href="?action=changePassword&idAccount=<?php echo $row["userID"]; ?>" class="btn btn-outline-dark"><i class="fa-solid fa-pen-to-square" style="color: #000;"></i> Change Password</a>
                            <button type="reset" class="btn btn-outline-dark" data-toggle="button" aria-pressed="false"><i class="fa-solid fa-rotate-right"></i> Reset</button>
                        </div>
                    </div>
                    <?php 
                            }
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php } else {
     header('location: login_admin.php');
} ?>