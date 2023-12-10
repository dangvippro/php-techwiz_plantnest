<?php
session_start();
ob_start();
if (isset($_SESSION['role']) && ($_SESSION['role'] == 0)) {
    include_once '../classes/Product.php';
    include_once '../classes/Users.php';
    include_once '../assets/database.php';
    $product = new Product();
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Person Account</title>

        <!-- favicon -->
        <link rel="shortcut icon" type="image/png" href="../assets/images/icon-logo.png">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    </head>

    <body>

        <!-- header section starts  -->

        <nav class="navbar navbar-expand-lg navbar-light bg-light px-lg-5 py-lg-4 shadow-sm sticky-top">
            <div class="container-fluid">
                <div><a class="navbar-brand p-4 me-5 fw-bold fs-3 h-font" href="../index.php"><img src="../assets/images/logo/logo.svg" style="width:180px;" alt="Logo"></a></div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-3 fs-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-success me-2" aria-current="page" href="../index.php">Home</a>
                        </li>

                        <nav class="">
                            <div class="container-fluid">
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                                    <ul class="navbar-nav">
                                        <li class="nav-item dropdown">
                                            <a class="nav-link text-success dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Product
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                                                <li><a class="dropdown-item fs-4" href="flowering.php">Flowering</a></li>
                                                <li><a class="dropdown-item fs-4" href="nonFlowering.php">Non-flowering</a></li>
                                                <li><a class="dropdown-item fs-4" href="medicinal.php">Medicinal</a></li>
                                                <li><a class="dropdown-item fs-4" href="indoor.php">Indoor</a></li>
                                                <li><a class="dropdown-item fs-4" href="outdoor.php">Outdoor</a></li>
                                                <li><a class="dropdown-item fs-4" href="pots.php">Pots</a></li>
                                                <li><a class="dropdown-item fs-4" href="pesticides.php">Pesticides</a></li>
                                                <li><a class="dropdown-item fs-4" href="succulents.php">Succulents</a></li>
                                                <li><a class="dropdown-item fs-4" href="gardenTools.php">Garden Tools</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>

                        <li class="nav-item">
                            <a class="nav-link active text-success me-2" href="aboutus.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-success me-2" href="contactus.php">Contact Us</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <?php
                        if (isset($_SESSION['name']) && ($_SESSION['name'] != "")) { ?>
                            <a href="manageAccount.php">
                                <div class="dropdown">
                                    <a class="btn btn-outline-success shadow-none me-lg-3 me-3 fs-2" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo $_SESSION['name']; ?> <i class="bi bi-caret-down-fill"></i>
                                    </a>
                                    <ul class="dropdown-menu mt-2" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item fs-3 " href="manageOrders.php">Your Orders</a></li>
                                        <li><a class="dropdown-item fs-3 " href="review.php">Review</a></li>

                                    </ul>
                                </div>
                            </a>
                            <a href="logout.php">
                                <button type="button" class="btn btn-outline-success shadow-none me-lg-3 me-3 fs-2" data-bs-toggle="modal" data-bs-target="#registermodal">
                                    Logout
                                </button>
                            </a>
                            <a href="favorites.php">
                                <button type="button" class="btn btn-outline-success shadow-none me-lg-3 me-3 fs-2" data-bs-toggle="modal" data-bs-target="#registermodal">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </a>
                        <?php } else { ?>
                            <a href="login.php">
                                <button type="button" class="btn btn-outline-success shadow-none me-lg-3 me-3 fs-2" data-bs-toggle="modal" data-bs-target="#loginmodal">
                                    Login
                                </button>
                            </a>
                            <a href="register.php">
                                <button type="button" class="btn btn-outline-success shadow-none me-lg-3 me-3 fs-2" data-bs-toggle="modal" data-bs-target="#registermodal">
                                    Register
                                </button>
                            </a>
                        <?php } ?>
                        <a href="cart.php"><button type="button" class="btn btn-outline-success shadow-none me-lg-3 me-3 fs-2" data-bs-toggle="modal" data-bs-target="#registermodal">
                                <i class="bi bi-cart2"></i>
                            </button></a>
                    </div>
                </div>
            </div>
        </nav>
        <!--header section end-->

        <?php
        //Update
        if (isset($_GET['action']) && ($_GET['action'] == 'editAccount')) {
            if (isset($_POST['updateAccount'])) {
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
        }
        //Delete
        if (isset($_GET['action']) && ($_GET['action'] == 'removeAccount')) {
            $deleteOrder_row = deleteAccountOrder($conn, $_GET['id']);
            if ($deleteOrder_row) {
                $deleteReview = deleteAccountReview($conn, $_GET['id']);
                if ($deleteReview) {
                    $result = deleteAccount($conn, $_GET['id']);
                    if ($result) {
                        echo "Delete account " . $_GET['id'] . " successfully!";
                        header('location: logout.php');
                    }
                }
            } else {
                echo "Can't delete " . $_GET['id'];
            }
        }
        //Change password
        if (isset($_GET['action']) && ($_GET['action'] == 'changePassword')) {
            if (isset($_POST['changePass'])) {
                $id = $_GET['id'];
                $oldPassword = $_POST['oldPassword'];
                $newPassword = $_POST['newPassword'];
                $confirmPassword = $_POST['confirmPassword'];

                $getPassword = getUserInfo($conn, $id);
                $row = $getPassword->fetch_assoc();
                $currentPassword = $row['password'];
                $checkPass = password_verify($oldPassword, $currentPassword);
                $newPass = password_hash($newPassword, PASSWORD_DEFAULT);
                if (!$checkPass) {
                    $txt_error = "<div class='text-center text-danger fs-3'> <strong>Invalid old pasword.</strong></div>";
                } else if ($confirmPassword != $newPassword) {
                    $txt_confirm_error = "<div class='text-center text-danger fs-3'><strong>Confirm password does not match.<strong></div>";
                } else {
                    if (updatePassword($conn, $id, $newPass)) {
                        echo '<div class="text-center text-success fs-3" "><i class="fas fa-check"></i><strong> Change password successfully!</strong></div>';
                    } else {
                        echo '<div class="text-center text-danger fs-3">strong>Change password failed!</strong></div>';
                    }
                }
            }
        }
        ?>

        <div id="shopping-cart">
            <!-- form edit -->
            <?php if (isset($_GET['action']) && ($_GET['action'] == "editAccount")) { ?>
                <div class="form-edit">
                    <form method="POST">
                        <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                            <h1 class="top-50 start-50 text-center">Account</h1>
                            <?php
                            if (isset($_SESSION['email']) && ($_SESSION['email'] != "")) {
                                $accountID = $_SESSION['id'];
                                $result = getUserInfo($conn, $accountID);
                                if ($result->num_rows == 1) {
                                    while ($row = $result->fetch_assoc()) {
                            ?>
                                        <table class="position-absolute top-50 start-50 translate-middle" style="margin-bottom:50px">
                                            <tbody>
                                                <tr>
                                                    <td><span class="fs-4 fw-bold p-4">User ID</span></td>
                                                    <td>
                                                        <input class="fs-2" type="text" name="id" value="<?php echo $row['userID']; ?>" readonly required />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span class="fs-4 fw-bold p-4">Fullname: </span></td>
                                                    <td><input class="fs-2" type="text" name="name" value="<?php echo $row['fullname']; ?>" required /></td>
                                                </tr>
                                                <tr>
                                                    <td><span class="fs-4 fw-bold p-4">Gender:</span> </td>
                                                    <td class="fs-2">
                                                        <input type="radio" name="gender" value="female" checked />Female
                                                        <input type="radio" name="gender" value="male" />Male
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span class="fs-4 fw-bold p-4">Birthday: </span></td>
                                                    <td><input class="fs-2" type="text" name="birthday" value="<?php echo $row['birthday']; ?>" required /></td>
                                                </tr>
                                                <tr>
                                                    <td><span class="fs-4 fw-bold p-4">Phone: </span></td>
                                                    <td><input class="fs-2" type="text" name="phone" value="<?php echo $row['phone']; ?>" required /></td>
                                                </tr>
                                                <tr>
                                                    <td><span class="fs-4 fw-bold p-4">Email: </span></td>
                                                    <td><input class="fs-2" type="text" name="email" value="<?php echo $row['email']; ?>" required /></td>
                                                </tr>
                                                <tr>
                                                    <td><span class="fs-4 fw-bold p-4">Address: </span></td>
                                                    <td><input class="fs-2" type="text" name="address" value="<?php echo $row['address']; ?>" required /></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <div class="mt-2">
                                                            <input class="btn btn-success btn-sm w-10 rounded-3 border border-3" style="font-size: 16px;" type="submit" name="updateAccount" value="Update" />
                                                            <a href="manageAccount.php" class="btn btn-success btn-sm w-10 rounded-3 border border-3" style="font-size: 16px;">Account information</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                    <?php
                                    }
                                }
                            }
                                    ?>
                                            </tbody>
                                        </table>
                        </div>
                    </form>
                    </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
                <?php } ?>
                <!-- end form edit -->

                <!--form change password-->
                <?php if (isset($_GET['action']) && ($_GET['action'] == "changePassword")) { ?>
                    <div class="form-edit">
                        <form method="POST">
                            <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                                <h5 class="mb-3 fw-bold fs-2"></br></br></h5>

                                <h1 class="top-50 start-50 text-center ">ChangePassword</h1>
                                <table class="position-absolute top-50 start-50 translate-middle" style="margin-bottom:50px">
                                    <tr>
                                        <td>
                                            <div class="fs-4 fw-bold p-4 ">Old password:</div>
                                        </td>
                                        <td>
                                            <input class="fs-3 " type="password" name="oldPassword" value="" placeholder="Enter your password" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="fs-4 fw-bold p-4 ">New password: </div>
                                        </td>
                                        <td>
                                            <input class="fs-3 " type="password" name="newPassword" value="" placeholder="Enter new password" required />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="fs-4 fw-bold p-4  ">Confirm new password: </div>
                                        </td>
                                        <td><input class="fs-3 " type="password" name="confirmPassword" value="" placeholder="Confirm new password" required /></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="mt-4 " style="margin-left:45px">
                                                <input class="btn btn-success btn-sm w-10 rounded-3 border border-3" style="font-size: 16px;" type="submit" name="changePass" value="Submit" />
                                                <input class="btn btn-success btn-sm w-10 rounded-3 border border-3" style="font-size: 16px;" type="reset" value="Reset" />
                                                <a href="manageAccount.php" class="btn btn-success btn-sm w-10 rounded-3 border border-3" style="font-size: 16px;">Account information</a>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <?php
                                if (isset($txt_error) && ($txt_error != "")) {
                                    echo "<font color = 'red'>$txt_error</font>";
                                }
                                ?>
                                <?php
                                if (isset($txt_confirm_error) && ($txt_confirm_error != "")) {
                                    echo "<font color = 'red'>$txt_confirm_error</font>";
                                }
                                ?>
                        </form>
                    </div></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>

                <?php } ?>
                <!-- end form change password -->

                <!-- display account information -->
                <?php
                if (isset($_SESSION['email']) && ($_SESSION['email'] != "") && !isset($_GET['action'])) {
                    $accountID = $_SESSION['id'];
                    $result = getUserInfo($conn, $accountID);
                    if ($result->num_rows > 0) {
                ?>

                        <div>
                            <div class="bg-white p-3 p-md-4 rounded shadow-sm d-flex justify-content-center flex-column align-items-center">
                                <div>
                                    <h1 class="text-center">Account Information</h1>
                                </div>
                                <div>
                                    <table class="table table-borderless" style="width: 50%; margin:30px 0px 50px 400px;">
                                        <tbody>
                                            <?php while ($row = $result->fetch_assoc()) { ?>
                                                <tr class="w-100">
                                                    <td style="width: 250px;"><span class="fs-4 fw-bold p-4">User ID</span></td>
                                                    <td class="fs-2" style="width: 500px;"><?php echo $row['userID']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><span class="fs-4 fw-bold p-4 ">Fullname</span></td>
                                                    <td class="fs-2"><?php echo $row['fullname']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><span class="fs-4 fw-bold p-4 ">Gender</span></td>
                                                    <td class="fs-2"><?php echo $row['gender']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><span class="fs-4 fw-bold p-4">Birthday</span></td>
                                                    <td class="fs-2"><?php echo $row['birthday']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><span class="fs-4 fw-bold p-4">Phone number</span></td>
                                                    <td class="fs-2"><?php echo $row['phone']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><span class="fs-4 fw-bold p-4">Email</span></td>
                                                    <td class="fs-2"><?php echo $row['email']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><span class="fs-4 fw-bold p-4">Address</span></td>
                                                    <td class="fs-2"><?php echo $row['address']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <div class="mt-2" style="margin-left: 20px;">
                                                            <a class="mt-2 btn btn-success btn-sm w-10 rounded-3 border border-3" style="font-size: 18px;" href="?action=editAccount&id=<?php echo $row['userID']; ?>">
                                                                Edit
                                                            </a>
                                                            <a class="mt-2 btn btn-success btn-sm w-10 rounded-3 border border-3" style="font-size: 18px;" href="?action=removeAccount&id=<?php echo $row['userID']; ?>">
                                                                Delete Account
                                                            </a>
                                                            <a class="mt-2 btn btn-success btn-sm w-10 rounded-3 border border-3" style="font-size: 18px;" href="?action=changePassword&id=<?php echo $row['userID']; ?>">
                                                                Change password
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                </div></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>



        <?php }
                } ?>
        </div>
        <!-- Footer -->
        <footer class="text-center text-lg-start text-dark bg-light mt-4" style="background-color: #ECEFF1">

            <!-- Section: Links  -->
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Content -->
                            <h6 class="text-uppercase fw-bold fs-1 text-success">PLANTNEST</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 150px; background-color: #000; height: 3px" />
                            <p style="font-size:18px">
                                Web design to sell bonsai, plantnest can be considered as a display channel,
                                displaying products related to ornamental plants,
                                so that people who are interested in these items can refer to and choose beautiful products,
                                agree with them.
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold fs-1 text-success">Products</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 150px; background-color: #000; height: 3px" />
                            <p>
                                <a href="nonFlowering.php" class="text-dark fs-3 text-decoration-none">Non-Flowering</a>
                            </p>
                            <p>
                                <a href="medicinal.php" class="text-dark fs-3 text-decoration-none">Medicinal</a>
                            </p>
                            <p>
                                <a href="indoor.php" class="text-dark fs-3 text-decoration-none">Indoor</a>
                            </p>
                            <p>
                                <a href="outdoor.php" class="text-dark fs-3 text-decoration-none">Outdoor</a>
                            </p>
                            <p>
                                <a href="pots.php" class="text-dark fs-3 text-decoration-none">Pots</a>
                            </p>
                            <p>
                                <a href="pesticides.php" class="text-dark fs-3 text-decoration-none">Pesticides</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold fs-1 text-success"> links</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 80px; background-color: #000; height: 3px" />
                            <p>
                                <a href="../index.php" class="text-dark fs-3 text-decoration-none">Home</a>
                            </p>
                            <p>
                                <a href="product.php" class="text-dark fs-3 text-decoration-none">Product</a>
                            </p>
                            <p>
                                <a href="aboutus.php" class="text-dark fs-3 text-decoration-none">About us</a>
                            </p>
                            <p>
                                <a href="contactus.php" class="text-dark fs-3 text-decoration-none">Contact us</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold fs-1 text-success">Contact</h6>
                            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 120px; background-color: #000; height: 3px" />
                            <p class="fs-3"><i class="fas fa-home mr-3 text-dark fs-1 text-decoration-none"></i> Ly Tu Trong,Can Tho,Viet Nam</p>
                            <p class="fs-3"><i class="fas fa-envelope mr-3 text-dark fs-1 text-decoration-none"></i> plantnest@gmail.com</p>
                            <p class="fs-3"><i class="fas fa-phone mr-3 text-dark fs-1 text-decoration-none"></i> 09 345 678 32</p>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </div>
            </section>
            <!-- Section: Links  -->


        </footer>
        <!-- Footer -->
        </div>
        <!-- End of .container -->

        </div>
        <!-- End of .container -->



        <a href="#home" class="scroll-top fas fa-angle-up"></a>


















        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

        <!-- custom js file link  -->
        <script src="js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

        <script>
            var swiper = new Swiper(".swiper-container", {
                spaceBetween: 30,
                effect: "fade",
            });
        </script>
    </body>

    </html>

<?php
} else {
    header('location: login.php');
}
?>