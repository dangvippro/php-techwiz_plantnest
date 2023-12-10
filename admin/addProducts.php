<?php 
session_start();
ob_start();
if(isset($_SESSION['role']) && ($_SESSION['role'] == 1)){
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/admins.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="">
    <title>Manage Product</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="../assets/images/icon-logo.png">
</head>

<body>
    <?php

//    add product
    if (isset($_POST['addProduct'])) {
        $productName = $_POST["productName"];
        $unitPrice = $_POST["unitPrice"];
        $height = $_POST["height"];
        $uses = $_POST["uses"];
        $growthHabits = $_POST["growthHabits"];
        $light = $_POST["light"];
        $water = $_POST["water"];
        $categoryID = $_POST["categoryID"];
        $imageURL = $_POST["imageURL"];
        $unitsInStock = $_POST["unitsInStock"];

        if ($product->add($conn, $productName, $unitPrice, $height, $uses, $growthHabits, $light, $water, $imageURL, $unitsInStock, $categoryID)) {
            echo "New Record add Successfully!";
            header("location: manageProduct.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $query = "SELECT * FROM categories";
    $result = mysqli_query($conn, $query);
    
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
        <div class="body-container" style="width: 100%;">
            <div class="body-container__welcome">
                <h2 style="margin-bottom: 1rem;">Product's Information</h2>
                <div>
                    <img src="../assets/images/logo/logo.png" class="img-fluid" alt="logo" style="width: 250px;">
                </div>
            </div>
            <div class="body-container-form">
                <form method="post">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Product Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="productName" name="productName" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Unit Price</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="unitPrice" name="unitPrice" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Height</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="height" name="height" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Uses</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="uses" name="uses">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Growth Habits</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="growthHabits" name="growthHabits">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Light</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="light" name="light">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Water</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="water" name="water">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Category ID</label>
                        <div class="col-sm-10">
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="categoryID" id="categoryID">
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <option value="<?php echo $row['categoryID'] ?>"><?php echo $row['categoryName']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Image URL</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="imageURL" name="imageURL" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Units In Stock</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="unitsInStock" name="unitsInStock">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10" style="margin-top: 20px;">
                            <button type="submit" class="btn btn-outline-dark" data-toggle="button" aria-pressed="false" name="addProduct"><i class="fa-solid fa-plus"></i> Add</button>
                            <button type="reset" class="btn btn-outline-dark" data-toggle="button" aria-pressed="false"><i class="fa-solid fa-rotate-right"></i> Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php } else {
     header('location: login_admin.php');
}