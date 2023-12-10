<?php
session_start();
ob_start();
include_once './classes/Product.php';
include_once './classes/Users.php';
include_once './assets/database.php';
$product = new Product();

//Add to Favorites
if (isset($_GET['action']) && $_GET['action'] == "addFavorites") {
    $id = $_GET['id'];
    if (isset($_SESSION['email']) && ($_SESSION['email'] != "")) {
        if (isset($_SESSION['favorites'][$id])) {
            // echo '****Added to favorites****';
        } else {
            $row = $product->findProductsbyID($conn, $id);
            if (isset($row['productID'])) {
                $_SESSION['favorites'][$row['productID']] = array("name" => $row['productName'], "price" => $row['unitPrice'], "category" => $row['categoryID'], "stock" => $row['unitsInStock'], "image" => $row['imageURL']);
            } else {
                $message = "This product id is invalid.";
            }
        }
    } else {

        echo '';
    }
}

if (isset($_GET['proID'])) {
    if (isset($_SESSION['id'])) {
        $userID = $_SESSION['id'];
        $proID = intval($_GET['proID']);
        $quantity = $_GET['quantity'];
        $name = $_GET['proName'];
        $price = (double) ($_GET['price']);
        $image = $_GET['image'];
        if (isset($_SESSION['cart'][$proID])) {
            $_SESSION['cart'][$proID]['quantity']++;  
            Header("location: index.php");      
        } else {
        $_SESSION['cart'][$proID] = array(
                "name" => $name, 
                "price" => $price, 
                "quantity" => $quantity, 
                "image" => $image
            ); 
            Header("location: index.php");
        }
    } else {
        Header("location: ./client/login.php");
    }
}

$error = [];
if (isset($_POST['userlogin']) && ($_POST['userlogin'])) {
    $id = $_POST['userid'];
    $password = $_POST['password'];

    $result = getUserInfo($conn, $id);
    $data = $result->fetch_assoc();
    $checkID = $result->num_rows;

    if ($checkID == 1) {

        $checkPass = password_verify($password, $data['password']);


        if ($checkPass) {
            if ($data['role'] == 1) {
                $_SESSION['role'] = $data['role'];
                $_SESSION['idAdmin'] = $data['userID'];
                $_SESSION['passwordAdmin'] = $data['password'];
                $_SESSION['nameAdmin'] = $data['fullname'];
                $_SESSION['phoneAdmin'] = $data['phone'];
                $_SESSION['addressAdmin'] = $data['address'];
                $_SESSION['emailAdmin'] = $data['email'];
                $_SESSION['birthdayAdmin'] = $data['birthday'];
                $_SESSION['genderAdmin'] = $data['gender'];
                header('location: admin/manageProduct.php');
            } else {
                $_SESSION['role'] = $data['role'];
                $_SESSION['id'] = $data['userID'];
                $_SESSION['password'] = $data['password'];
                $_SESSION['name'] = $data['fullname'];
                $_SESSION['phone'] = $data['phone'];
                $_SESSION['address'] = $data['address'];
                $_SESSION['gender'] = $data['gender'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['birthday'] = $data['birthday'];
                header('location: index.php');
            }
        } else {
            $error['password'] = "Password is invalid.";
        }
    } else {
        $error['id'] = "ID does exist.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="assets/images/icon-logo.png">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>

    <!-- header section starts  -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light px-lg-5 py-lg-4 shadow-sm sticky-top">
        <div class="container-fluid">
            <div><a class="navbar-brand p-4 me-5 fw-bold fs-3 h-font" href="index.php"><img src="assets/images/logo/logo.svg" style="width:180px;" alt="Logo"></a></div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-3 fs-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-success me-2" aria-current="page" href="index.php">Home</a>
                    </li>
                    <nav class="">
                        <div class="container-fluid">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle text-success" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Product
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-light text-success" aria-labelledby="navbarDarkDropdownMenuLink">
                                            <li><a class="dropdown-item fs-4" href="client/flowering.php">Flowering</a></li>
                                            <li><a class="dropdown-item fs-4" href="client/nonFlowering.php">Non-Flowering</a></li>
                                            <li><a class="dropdown-item fs-4" href="client/medicinal.php">Medicinal</a></li>
                                            <li><a class="dropdown-item fs-4" href="client/indoor.php">Indoor</a></li>
                                            <li><a class="dropdown-item fs-4" href="client/outdoor.php">Outdoor</a></li>
                                            <li><a class="dropdown-item fs-4" href="client/pots.php">Pots</a></li>
                                            <li><a class="dropdown-item fs-4" href="client/pesticides.php">Pesticides</a></li>
                                            <li><a class="dropdown-item fs-4" href="client/succulents.php">Succulents</a></li>
                                            <li><a class="dropdown-item fs-4" href="client/gardenTools.php">Garden Tools</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>

                    <!--                         <li class="nav-item">
                            <a class="nav-link me-2" href="client/product.php">Product</a>
                        </li> -->
                    <li class="nav-item">
                        <a class="nav-link me-2 text-success" href="client/aboutus.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2 text-success" href="client/contactus.php">Contact Us</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <?php
                    if (isset($_SESSION['email']) && ($_SESSION['email'] != "")) { ?>
                        <a href="client/manageAccount.php">
                            <button type="button" class="btn btn-outline-success shadow-none me-lg-3 me-3 fs-2" data-bs-toggle="modal" data-bs-target="#registermodal">
                                <?php echo $_SESSION['name']; ?>
                            </button>
                        </a>
                        <a href="client/logout.php">
                            <button type="button" class="btn btn-outline-success shadow-none me-lg-3 me-3 fs-2" data-bs-toggle="modal" data-bs-target="#registermodal">
                                Logout
                            </button>
                        </a>
                        <a href="client/favorites.php"><button type="button" class="btn btn-outline-success shadow-none me-lg-3 me-3 fs-2" data-bs-toggle="modal" data-bs-target="#registermodal">
                                <i class="fas fa-heart"></i>
                            </button></a>
                    <?php } else { ?>
                        <a href="client/login.php">
                            <button type="button" class="btn btn-outline-success shadow-none me-lg-3 me-3 fs-2" data-bs-toggle="modal" data-bs-target="#loginmodal">
                                Login
                            </button>
                        </a>
                        <a href="client/register.php">
                            <button type="button" class="btn btn-outline-success shadow-none me-lg-3 me-3 fs-2" data-bs-toggle="modal" data-bs-target="#registermodal">
                                Register
                            </button>
                        </a>
                    <?php } ?>
                    <a href="client/cart.php">
                        <button type="button" class="btn btn-outline-success shadow-none me-lg-3 me-3 fs-2" data-bs-toggle="modal" data-bs-target="#registermodal">
                            <div><i class="bi bi-cart2 "></i></div>

                        </button></a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="assets/images/slider1.jpg" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                    <img src="assets/images/slider2.jpg" class="w-100 d-block">
                </div>
            </div>
        </div>
    </div>





    <!-- banner section ends -->

    <!-- category section starts  -->

    <section class="category" id="category">

        <h1 class="heading fw-bold">Shop by Category </h1>

        <div class="box-container">

            <div class="box">
                <img src="assets/images/cat1.jpg" alt="">
                <div class="content">
                    <h3 class="text-decoration-none text-dark fs-2 mt-2 fw-bol">Flowering Plants</h3>
                    <a href="client/flowering.php" class="text-decoration-none btn btn-outline-success shadow-none mt-2 fs-4 fs-2">Shop Now</a>
                </div>
            </div>
            <div class="box">
                <img src="assets/images/cat2.jpg" alt="">
                <div class="content">
                    <h3 class="text-decoration-none text-dark fs-2 mt-2 fw-bol">Non-Flowering</h3>
                    <a href="client/nonFlowering.php" class="text-decoration-none btn btn-outline-success shadow-none mt-2 fs-4 fs-2">Shop Now</a>
                </div>
            </div>
            <div class="box">
                <img src="assets/images/cat3.jpg" alt="">
                <div class="content">
                    <h3 class="text-decoration-none text-dark fs-2 mt-2 fw-bol">Plants for House</h3>
                    <a href="client/indoor.php" class="text-decoration-none btn btn-outline-success shadow-none mt-2 fs-4 fs-2">Shop Now</a>
                </div>
            </div>
            <div class="box">
                <img src="assets/images/product6.jpg" alt="">
                <div class="content">
                    <h3 class="text-decoration-none text-dark fs-2 mt-2 fw-bol">Outdoor Plants</h3>
                    <a href="client/outdoor.php" class="text-decoration-none btn btn-outline-success shadow-none mt-2 fs-4 fs-2">Shop Now</a>
                </div>
            </div>
            <div class="box">
                <img src="assets/images/cat4.jpg" alt="">
                <div class="content">
                    <h3 class="text-decoration-none text-dark fs-2 mt-2 fw-bol">Succulents</h3>
                    <a href="client/succulents.php" class="text-decoration-none btn btn-outline-success shadow-none mt-2 fs-4 fs-2">Shop Now</a>
                </div>
            </div>
            <div class="box">
                <img src="assets/images/product4.jpg" alt="">
                <div class="content">
                    <h3 class="text-decoration-none text-dark fs-2 mt-2 fw-bol">Medicinal</h3>
                    <a href="client/medicinal.php" class="text-decoration-none btn btn-outline-success shadow-none mt-2 fs-4 fs-2">Shop Now</a>
                </div>
            </div>
            <div class="box">
                <img src="assets/images/pot.jpg" alt="">
                <div class="content">
                    <h3 class="text-decoration-none text-dark fs-2 mt-2 fw-bol">Pots</h3>
                    <a href="client/pots.php" class="text-decoration-none btn btn-outline-success shadow-none mt-2 fs-4 fs-2">Shop Now</a>
                </div>
            </div>
            <div class="box">
                <img src="assets/images/tools.jpg" alt="">
                <div class="content">
                    <h3 class="text-decoration-none text-dark fs-2 mt-2 fw-bol">Garden Tools</h3>
                    <a href="client/gardenTools.php" class="text-decoration-none btn btn-outline-success shadow-none mt-2 fs-4 fs-2">Shop Now</a>
                </div>
            </div>
            <div class="box">
                <img src="assets/images/pesticide.jpg" alt="">
                <div class="content">
                    <h3>Pesticides</h3>
                    <a href="client/pesticides.php" class="text-decoration-none btn btn-outline-success shadow-none mt-2 fs-4 fs-2">Shop Now</a>
                </div>
            </div>

        </div>

    </section>

    <!-- category section ends -->

    <!-- product section starts  -->

    <!--display flowering plants-->


    <section class="product" id="product">

        <h1 class="heading fw-bold">New products </h1>

        <div class="box-container">
            <div class="product-section mt-150 mb-150">
                <?php
                $result = $product->showNewProduct($conn);
                if ($result->num_rows > 0) {
                ?>
                    <div class="container">
                        <div class="row product-lists">
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <div class="col-md-3 mt-3">
                                    <form method="GET">
                                        <div class="card">
                                            <a href="client/productdetails.php?action=singleproduct&id=<?php echo $row['productID'] ?>&caID=<?php echo $row['categoryID'] ?>"><img src="<?php echo $row['imageURL'] ?>" width="100%" height="270px" alt="alt" /></a>

                                            <div class="card-body">
                                                <h3><a class="text-decoration-none text-dark fs-2 mt-2 fw-bold" href="client/productdetails.php?action=singleproduct&id=<?php echo $row['productID'] ?>&caID=<?php echo $row['categoryID'] ?>"><?php echo $row['productName'] ?></a></h3>
                                                <div class="quantity">
                                                    <span class="fs-2"> Quantity :
                                                        <input style="background-color: #fff;" type="number" min="1" max="100" value="1" name="quantity">
                                                        <input type="hidden" name="proID" value="<?php echo $row['productID'] ?>">
                                                        <input type="hidden" name="proName" value="<?php echo$row['productName']; ?>">
                                                        <input type="hidden" name="price" value="<?php echo $row['unitPrice'] ?>">
                                                        <input type="hidden" name="image" value="<?php echo $row['imageURL'] ?>">
                                                    </span>
                                                </div>
                                                <div class="price fs-2 mt-2"><?php echo " $" . $row['unitPrice'] ?></div>
                                                <button type="submit" class="btn btn-outline-success shadow-none mt-2 fs-4 fs-2 " href="" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                                <a class="text-decoration-none btn btn-outline-success shadow-none mt-2 fs-4 fs-2 " href="?action=addFavorites&id=<?php echo $row['productID'] ?>" class="cart-btn"><i class="fas fa-heart"></i> Add to Favorites</a>
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
        </div>

    </section>


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
                            <a href="client/flowering.php" class="text-dark fs-3 text-decoration-none">Flowering</a>
                        </p>
                        <p>
                            <a href="client/nonFlowering.php" class="text-dark fs-3 text-decoration-none">Non-Flowering</a>
                        </p>
                        <p>
                            <a href="client/medicinal.php" class="text-dark fs-3 text-decoration-none">Medicinal</a>
                        </p>
                        <p>
                            <a href="client/indoor.php" class="text-dark fs-3 text-decoration-none">Indoor</a>
                        </p>
                        <p>
                            <a href="client/outdoor.php" class="text-dark fs-3 text-decoration-none">Outdoor</a>
                        </p>

                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold fs-1 text-success"> links</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 80px; background-color: #000; height: 3px" />
                        <p>
                            <a href="index.php" class="text-dark fs-3 text-decoration-none">Home</a>
                        </p>
                        <p>
                            <a href="client/product.php" class="text-dark fs-3 text-decoration-none">Product</a>
                        </p>
                        <p>
                            <a href="client/aboutus.php" class="text-dark fs-3 text-decoration-none">About us</a>
                        </p>
                        <p>
                            <a href="client/contactus.php" class="text-dark fs-3 text-decoration-none">Contact us</a>
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


    <!-- scroll top button  -->
    <a href="#home" class="scroll-top fas fa-angle-up"></a>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- custom js file link  -->
    <script src="assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".swiper-container", {
            spaceBetween: 30,
            effect: "fade"
        });
    </script>
</body>

</html>