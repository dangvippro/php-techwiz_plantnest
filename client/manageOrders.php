<?php
session_start();
ob_start();
if (isset($_SESSION['role']) && ($_SESSION['role'] == 0)) {
    include_once '../classes/Product.php';
    include_once '../classes/Users.php';
    include_once '../classes/Orders.php';
    include_once '../assets/database.php';
    $order = new Orders();
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Person Account</title>

        <!-- favicon -->
        <script src="https://kit.fontawesome.com/77d3671eb6.js" crossorigin="anonymous"></script>
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
                                        <?php echo $_SESSION['name']; ?><i class="bi bi-caret-down-fill"></i>
                                    </a>
                                    <ul class="dropdown-menu mt-2" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item active fs-3 "style="background-color: #198754" href="manageOrders.php">Your Orders</a></li>
                                        <li><a class="dropdown-item fs-3 " href="review.php">Review</a></li>

                                    </ul>
                                </div>
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
        <!--header section end-->

        <!-- information products -->
        <?php 
        if (isset($_SESSION['name']) && ($_SESSION['name'] != "")) {
        $result = $order->showUserOrder($conn, $_SESSION['id']);
        }
        ?>
        <section class="h-100" style="background-color: #eee; font-size: 16px;">
            <div class="container h-100 py-5">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <a href="manageAccount.php" class="text-secondary text-decoration-none fs-2 mt-3"><font color="#198754">My Account</font></a><span class="text-secondary text-decoration-none fs-2 mt-3"> / Your Orders</span>
                            </div>
                        </div>

                        <div class="card rounded-3 mb-4">
                            <div class="card-body p-4">
                                <div class="row d-flex justify-content-between align-items-center">
                                    <table class="table table-bordered body-container-table">
                                        <thead>
                                            <th>Products name</th>
                                            <th>Unit price</th>
                                            <th>Quantity</th>
                                            <th>Total amount</th>
                                            <th>Status</th>
                                            <th>Order date</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row["productName"] ?></td>
                                                <td><?php echo "$".$row["unitPrice"] ?></td>
                                                <td><?php echo $row["quantity"] ?></td>
                                                <td><?php echo "$".$row["unitPrice"]*$row["quantity"] ?></td>
                                                <td><?php echo $row["status"] ?></td>
                                                <td><?php echo $row["orderDate"] ?></td>
                                            </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>




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