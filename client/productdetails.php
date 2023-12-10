<?php
session_start();
include_once '../classes/Product.php';
include_once '../assets/database.php';
$product = new Product();

if (isset($_GET['action']) && $_GET['action'] == "singleproduct") {
    $action = $_GET['action'];
    $id = $_GET['id'];
    $caID = $_GET['caID'];

    $thisPage = "location: productdetails.php?action=" . $action . "&id=" . $id . "&caID=" . $caID;
    $_SESSION['singleproductPage'] = $thisPage;
}

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
            Header($_SESSION['singleproductPage']);
        } else {
            $_SESSION['cart'][$proID] = array(
                "name" => $name,
                "price" => $price,
                "quantity" => $quantity,
                "image" => $image
            );
            Header($_SESSION['singleproductPage']);
        }
    } else {
        Header("location: login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product details</title>

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
                                        <a class="nav-link text-success active dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Product
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                                            <li><a class="dropdown-item active fs-4" href="flowering.php">Flowering</a></li>
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


        <div class="container">
            <div class="row">

                <div class="col-12 my-5 mb-4 px-4">
                    <h2 class="heading fw-bold">Product Details</h2>
                    <div style="font-size:14px;">
                        <a href="" class="text-secondary text-decoration-none">HOME</a>
                        <span class="text-secondary"> > </span>
                        <?php
                        if (isset($_GET['action']) && $_GET['action'] == "singleproduct") {
                            $categoryID = $_GET['caID'];
                            if ($categoryID == 1) {
                                echo '<a href="flowering.php" class="text-secondary text-decoration-none">FLOWERING PLANTS</a>';
                            } else if ($categoryID == 2) {
                                echo '<a href="nonFlowering.php" class="text-secondary text-decoration-none">NON-FLOWERING PLANTS</a>';
                            } else if ($categoryID == 3) {
                                echo '<a href="indoor.php" class="text-secondary text-decoration-none">INDOOR PLANTS</a>';
                            } else if ($categoryID == 4) {
                                echo '<a href="outdoor.php" class="text-secondary text-decoration-none">OUTDOOR PLANTS</a>';
                            } else if ($categoryID == 5) {
                                echo '<a href="succulents.php" class="text-secondary text-decoration-none">SUCCULENTS</a>';
                            } else if ($categoryID == 6) {
                                echo '<a href="medicinal.php" class="text-secondary text-decoration-none">MEDICINAL PLANTS</a>';
                            } else if ($categoryID == 7) {
                                echo '<a href="pots.php" class="text-secondary text-decoration-none">POTS</a>';
                            } else if ($categoryID == 8) {
                                echo '<a href="gardenTools.php" class="text-secondary text-decoration-none">GARDEN TOOLS</a>';
                            }
                        }
                        ?>

                    </div>
                </div>

                <?php
                if (isset($_GET['action']) && $_GET['action'] == "singleproduct") {
                    $result = $product->productDetails($conn, $_GET['id']);
                    if ($result->num_rows > 0) {
                ?>
                        <div class="single-product   mt-150 mb-150">
                            <div class="container ">
                                <div class="row ">
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                        <div class="col-md-5 ">
                                            <div class="single-product-img ">
                                                <img class="shadow w-100" src="<?php echo "../" . $row['imageURL'] ?>" alt="imageProduct">
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-12 px-4 position-absolute top-50 start-50">
                                            <div class="card mb-4 border-0 shadow rounded-3">
                                                <div class="card-body">
                                                    <form method="get">
                                                        <p class="fs-1 mt-3 fw-bold"><?php echo $row['productName'] ?></p>
                                                        <p style="font-size: 20px; color: #000;"></span><?php echo "$" . $row['unitPrice'] ?></p>
                                                        <div class="quantity d-flex" style="font-size: 20px;">
                                                            <span> Quantity : </span>
                                                            <button type="button" class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                                <i class="fas fa-minus"></i>
                                                            </button>

                                                            <input type="hidden" name="proID" value="<?php echo $row['productID']; ?>">
                                                            <input type="hidden" name="proName" value="<?php echo $row['productName']; ?>">
                                                            <input type="hidden" name="price" value="<?php echo $row['unitPrice'] ?>">
                                                            <input type="hidden" name="image" value="<?php echo $row['imageURL'] ?>">

                                                            <input min="1" name="quantity" value="1" type="number" class="form-control form-control-sm fs-5" style="font-size: 1rem; min-width: 20px; max-width: 40px" onblur="this.parentNode.submit()" onkeydown="if(event.keyCode === 13) { event.preventDefault(); this.parentNode.submit()} " />

                                                            <button type="button" class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div><br>
                                                        <div class="single-product-form">
                                                            <p style="color: #000; font-size: 20px;"> <strong>Categories: </strong><?php echo $row['categoryID'] . ", " . $row['categoryName'] ?></p>
                                                            <button type="submit" class="btn btn-outline-success shadow-none mt-2 fs-4 fs-2 w-100" style="font-size: 20px;"><i class="fas fa-shopping-cart"></i> Add to Cart</button><br><br>
                                                            <input type="hidden" name="token" value="<?php echo $row['categoryName'] ?>" />
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- end single product -->
                        <!-- product description -->
                        <div class=" col-12 mt-4 px-4">
                            <div class="mb-5">
                                <h5 class="fw-bold fs-1 mt-4 ">Description</h5>
                                <p>
                                <div class="content">
                                    <p class="mt-5" style="font-size: 16px; text-transform: none;"><strong>Growth habits: </strong><?php echo $row['growthHabits'] ?></p>
                                    <p style="font-size: 16px; text-transform: none;"><strong>Light: </strong><?php echo $row['light'] ?></p>
                                    <p style="font-size: 16px; text-transform: none;"><strong>Water: </strong><?php echo $row['water'] ?></p>
                                    <p style="font-size: 16px; text-transform: none;"><strong>Uses: </strong><?php echo $row['uses'] ?></p>
                                    <p style="font-size: 16px; text-transform: none;"><strong>Height: </strong><?php echo $row['height'] ?></p>
                                </div>
                                </p>
                            </div>


                <?php
                                    }
                                } else {
                                    echo '0 result.';
                                }
                            }
                ?>
    </section>

    <?php
    if (isset($_GET['action']) && $_GET['action'] == "singleproduct") {
        $result = $product->showRelatedProduct($conn, $_GET['caID']);
        if ($result->num_rows > 0) {
    ?>
            <div class="product-section mt-150 mb-150">
                <div class="container">
                    <div class="row product-lists">
                        <div class="col-lg-8 offset-lg-2 text-center">
                            <div class="section-title">
                                <div style="margin: 0px;" class="text-center">
                                    <h2 class="fw-bold h-font"><span style="color: #000;">Related</span> Products</h2>
                                    <p style="font-size: 15px;">Related products can help you easily find the product you want.</p>
                                </div>
                            </div>
                        </div>

                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <div class="col-lg-3 col-md-6 text-center">
                                <div class="single-product-item shadow mt-5">
                                    <form method="GET">
                                        <input type="hidden" name="proID" value="<?php echo $row['productID'] ?>">
                                        <input type="hidden" name="proName" value="<?php echo $row['productName']; ?>">
                                        <input type="hidden" name="price" value="<?php echo $row['unitPrice'] ?>">
                                        <input type="hidden" name="image" value="<?php echo $row['imageURL'] ?>">
                                        <div class="product-image">
                                            <a href="?action=singleproduct&id=<?php echo $row['productID'] ?>&caID=<?php echo $row['categoryID'] ?>"><img class="img-fluid" src="<?php echo "../" . $row['imageURL'] ?>" alt="imageProduct" style="width:300px; height:300px;"></a>
                                        </div>
                                        <a class="text-decoration-none" href="?action=singleproduct&id=<?php echo $row['productID'] ?>&caID=<?php echo $row['categoryID'] ?>">
                                            <h3 class="fs-2 mt-2 text-dark fw-bold"><?php echo $row['productName'] ?></h3>
                                        </a>
                                        <p class="product-price fs-2 mt-3  text-dark"><?php echo "$" . $row['unitPrice'] ?> </p>
                                        <button type="submit" class="btn btn-outline-success shadow-none mt-2 fs-4 fs-2 w-100"><i class="fas fa-shopping-cart "></i> Add to Cart</button>
                                </div>
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
    <?php
        }
    } ?>



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