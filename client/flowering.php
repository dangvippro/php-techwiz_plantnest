<?php
session_start();
ob_start();
include_once '../classes/Product.php';
include_once '../classes/Users.php';
include_once '../assets/database.php';
$product = new Product();

if (isset($_GET['proID'])) {
    if (isset($_SESSION['id'])) {
        $userID = $_SESSION['id'];
        $proID = intval($_GET['proID']);
        $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
        $name = $_GET['proName'];
        $price = (float) ($_GET['price']);
        $image = $_GET['image'];
        if (isset($_SESSION['cart'][$proID])) {
            $_SESSION['cart'][$proID]['quantity']++;
            Header("location: flowering.php");
        } else {
            $_SESSION['cart'][$proID] = array(
                "name" => $name,
                "price" => $price,
                "quantity" => $quantity,
                "image" => $image
            );
            Header("location: flowering.php");
        }
    } else {
        Header("location: login.php");
    }
}
?>
<?php
//Add to Favorites
if (isset($_GET['action']) && $_GET['action'] == "addFavorites") {
    $id = $_GET['id'];
    if (isset($_SESSION['email']) && ($_SESSION['email'] != "")) {
        if (isset($_SESSION['favorites'][$id])) {
            echo '****Added to favorites****';
        } else {
            $row = $product->findProductsbyID($conn, $id);
            if (isset($row['productID'])) {
                $_SESSION['favorites'][$row['productID']] = array("name" => $row['productName'], "price" => $row['unitPrice'], "category" => $row['categoryID'], "stock" => $row['unitsInStock'], "image" => $row['imageURL']);
            } else {
                $message = "This product id is invalid.";
            }
        }
    } else {
        echo 'You must be logged in to add to favorites!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flowering Plants</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="../assets/images/icon-logo.png">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>

    <?php
    if (isset($_SESSION['favorites'])) {
        $total_quantity = 0;
        $total_price = 0;
    }
    ?>

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
                                        <a class="nav-link dropdown-toggle text-success" href="" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Product
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                                            <li><a class="dropdown-item active  fs-4" style="background-color: #198754" href="flowering.php">Flowering</a></li>
                                            <li><a class="dropdown-item fs-4" href="nonFlowering.php">Non-Flowering</a></li>
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
                        <a class="nav-link me-2 text-success" href="aboutus.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2 text-success" href="contactus.php">Contact Us</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <?php
                    if (isset($_SESSION['name']) && ($_SESSION['name'] != "")) { ?>
                        <a href="manageAccount.php">
                            <button type="button" class="btn btn-outline-success shadow-none me-lg-3 me-3 fs-2" data-bs-toggle="modal" data-bs-target="#registermodal">
                                <?php echo $_SESSION['name']; ?>
                            </button>
                        </a>
                        <a href="logout.php">
                            <button type="button" class="btn btn-outline-success shadow-none me-lg-3 me-3 fs-2" data-bs-toggle="modal" data-bs-target="#registermodal">
                                Logout
                            </button>
                        </a>
                        <a href="favorites.php"><button type="button" class="btn btn-outline-success shadow-none me-lg-3 me-3 fs-2" data-bs-toggle="modal" data-bs-target="#registermodal">
                                <i class="fas fa-heart"></i>
                            </button></a>
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

    <!-- product section starts  -->

    <section class="product" id="product">

        <h2 class="heading fw-bold">Flowering plants</h2>
        <a href="" class="text-secondary text-decoration-none fs-3 ">Home</a>
        <span class="text-secondary fs-3"> > </span>
        <a href="flowering.php" class="text-secondary text-decoration-none fs-3">Flowering</a>
        <!--find flowering plants-->
        <form class="d-flex" action="" method="POST">
            <input class="form-control me-3 border-2 fs-2 mt-3" style="height:40px;" type="search" name="keyword" placeholder="Search" aria-label="Search">
            <input class="btn btn-outline-success fs-3 mt-3" style="width:80px;height:40px" type="submit" name="findProduct" value="Search">
        </form><br>
        <hr>
        <?php
        if (isset($_POST['findProduct'])) {
            $name = $_POST['keyword'];
            $listProduct = $product->findProducts($conn, $name, 1);
        ?>
            <div class="container">
                <div class="row product-lists">
                    <?php foreach ($listProduct as $row) { ?>
                        <div class="col-md-3 mt-3">
                            <form method="GET">
                                <div class="card">
                                    <a href="productdetails.php?action=singleproduct&id=<?php echo $row['productID'] ?>&caID=<?php echo $row['categoryID'] ?>"><img src="<?php echo "../" . $row['imageURL'] ?>" width="100%" height="270px" alt="alt" /></a>

                                    <div class="card-body">
                                        <h3><a class="text-decoration-none text-dark fs-2 mt-2 fw-bold" href="productdetails.php?action=singleproduct&id=<?php echo $row['productID'] ?>&caID=<?php echo $row['categoryID'] ?>"><?php echo $row['productName'] ?></a></h3>
                                        <div class="quantity">
                                            <span class="fs-2"> Quantity :
                                                <input style="background-color: #fff;" type="number" min="1" max="100" value="1" name="quantity">
                                                <input type="hidden" name="proID" value="<?php echo $row['productID']; ?>">
                                                <input type="hidden" name="proName" value="<?php echo $row['productName']; ?>">
                                                <input type="hidden" name="price" value="<?php echo $row['unitPrice'] ?>">
                                                <input type="hidden" name="image" value="<?php echo $row['imageURL'] ?>">

                                            </span>
                                        </div>
                                        <div class="price fs-2 mt-2"><?php echo "$" . $row['unitPrice'] ?></div>
                                        <button type="submit" class="btn btn-outline-success shadow-none mt-2 fs-4 fs-2 " ?>" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                        <a class="text-decoration-none btn btn-outline-success shadow-none mt-2 fs-4 fs-2 " href="flowering.php?action=addFavorites&id=<?php echo $row['productID'] ?>" class="cart-btn"><i class="fas fa-heart"></i> Add to Favorites</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <!--display flowering plants-->
        <?php
        if (!isset($_POST['findProduct'])) {
        ?>
            <div class="product-section mt-150 mb-150">
                <?php
                $result = $product->showFlowering($conn);
                if ($result->num_rows > 0) {
                ?>
                    <div class="container">
                        <div class="row product-lists">
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <div class="col-md-3 mt-3">
                                    <form method="GET">
                                        <div class="card">
                                            <a href="productdetails.php?action=singleproduct&id=<?php echo $row['productID'] ?>&caID=<?php echo $row['categoryID'] ?>"><img src="<?php echo "../" . $row['imageURL'] ?>" width="100%" height="270px" alt="alt" /></a>

                                            <div class="card-body">
                                                <h3><a class="text-decoration-none text-dark fs-2 mt-2 fw-bold" href="productdetails.php?action=singleproduct&id=<?php echo $row['productID'] ?>&caID=<?php echo $row['categoryID'] ?>"><?php echo $row['productName'] ?></a></h3>
                                                <div class="quantity">
                                                    <span class="fs-2"> Quantity :
                                                        <input style="background-color: #fff;" type="number" min="1" max="100" value="1" name="quantity">
                                                        <input type="hidden" name="proID" value="<?php echo $row['productID']; ?>">
                                                        <input type="hidden" name="proName" value="<?php echo $row['productName']; ?>">
                                                        <input type="hidden" name="price" value="<?php echo $row['unitPrice'] ?>">
                                                        <input type="hidden" name="image" value="<?php echo $row['imageURL'] ?>">

                                                    </span>
                                                </div>
                                                <div class="price fs-2 mt-2"><?php echo "$" . $row['unitPrice'] ?> </div>
                                                <button type="submit" class="btn btn-outline-success shadow-none mt-2 fs-4 fs-2" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                                <a class="text-decoration-none btn btn-outline-success shadow-none mt-2 fs-4 fs-2 " href="flowering.php?action=addFavorites&id=<?php echo $row['productID'] ?>" class="cart-btn"><i class="fas fa-heart"></i> Add to Favorites</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php
                } else {
                    echo '0 result.';
                }
                $conn->close();
                ?>
            </div>
    </section>


<?php } ?>


<!-- Footer -->
<footer class="text-center text-lg-start text-dark bg-light" style="background-color: #ECEFF1">

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