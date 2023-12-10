<?php 
session_start();
ob_start();
if(isset($_SESSION['role']) && ($_SESSION['role'] == 1)){
include_once '../classes/UserQueries.php';
include_once '../assets/database.php';
$user = new UserQueries();
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
        <title>View Feedback</title>
        <!-- favicon -->
        <link rel="shortcut icon" type="image/png" href="../assets/images/icon-logo.png">
    </head>
    <body>
        <?php

        $result = $user->showAllFeedback($conn);

        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $result = $user->findFeedback($conn, $search);
        }

        if(isset($_GET['action']) && $_GET['action'] == "deleteFeedback"){
            $userNo = $_GET['userNo'];
            $delete = $user->deleteFeedback($conn, $userNo);
            if($delete){
                echo '<div style="margin: 1% 0%;"><i class="fas fa-check-circle"></i><strong> Delete successfully!</strong></div>';
                header('location: userQueries.php');
            } else {
                echo '<div>Delete failed!</div>';
            }
        }
        ?>
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
            <div class="body-container" style="width: 90%;">
                <div class="body-container-nav">
                    <div class="body-container-refresh">
                        <a type="button" class="btn btn-outline-dark" href="userQueries.php">
                            <i class="fa-solid fa-arrows-rotate"></i> Refresh
                        </a>
                    </div>
                </div>
                <table class="table table-bordered body-container-table">
                    <thead>
                        <th>No</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Feedback date</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row["userNo"] ?></td>
                            <td><?php echo $row["username"] ?></td>
                            <td><?php echo $row["email"] ?></td>
                            <td><?php echo $row["message"] ?></td>
                            <td><?php echo $row["dateFeedback"] ?></td>
                            <td style="text-align: center;">
                                <a class="body-container-delete" href="?action=deleteFeedback&userNo=<?php echo $row["userNo"] ?>">
                                    <i class="fa-solid fa-trash" style="color: #000000;"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>

</html>
<?php } else {
     header('location: login_admin.php');
} ?>