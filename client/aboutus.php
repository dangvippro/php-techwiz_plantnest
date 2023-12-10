<?php 
session_start();
ob_start();
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
        <title>About us</title>

        <!-- favicon -->
        <link rel="shortcut icon" type="image/png" href="../assets/images/icon-logo.png">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">   
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
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
                                        <li><a class="dropdown-item  fs-4" href="flowering.php">Flowering</a></li>
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
                        if(isset($_SESSION['name']) && ($_SESSION['name']!="")){ ?>
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


        <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center fs-1">ABOUT US</h2>
        </div>
    <div class="container">
      <div class="row justify-content-between align-items-center">
        <div class="col-lg-6 col-md-5 mb-4">
           <h3 class="mb-3 fw-bold fs-1">About the site</h3>
           <p class="fs-4 fw-light">
           Plantnest.com is a website specializing in providing desktop plants, ornamental plants, aquatic plants, garden tools
           In order to widely promote to all customers, we have chosen the store business model and focused on combining online business, creating maximum convenience for customers across the country.
           Stop improving service quality, focus on finding new varieties of plants, giving customers the most comfort and convenience in purchasing at the website.
           </p>
        </div>
        <div class="col-lg-4 col-md-3 mb-4 order-lg-2 order-md-1 order-2">
            <img src="../assets/images/plant-about.jpg" width="450px" class="w-70">
        </div> 
      </div>
    </div></br>

    <div class="container">
      <div class="row justify-content-between align-items-center">
        <div class="col-lg-6 col-md-5 order-2">
           <h3 class="mb-3 fw-bold fs-1">Our Mission:</h3>
           <p class="fs-3 fw-light">
           The purpose of Selling Beautiful Bonsai is to create a fresh atmosphere, to bring a green color to your room, so that you always feel comfortable but also create an elegant pleasure that can help you. reduce stress and create a clean air in your room and finally for the common purpose of protecting nature - protecting the environment.
           </p>
        </div>
        <div class="col-lg-4 col-md-3 mb-4 order-lg-1 order-md-2 order-1">
            <img src="../assets/images/plant1-about.jpg" width="450px" class="w-70">
        </div> 
      </div>
    </div>







        <div class="my-5 px-4">
            <h2 class="fw-bold h-font text-center fs-1">SUPPORT</h2>
        </div>
        <div>
        <section class="icons-container" id="introduce">
            <div class="icon">
                <img src="../assets/images/icon1.png" alt="">
                <div class="content">
                    <h3>Free shipping</h3>
                    <p>Free shipping on order</p>
                </div>
            </div>
            <div class="icon">
                <img src="../assets/images/icon2.png" alt="">
                <div class="content">
                    <h3>100% Money Back</h3>
                    <p>You’ve 30 days to Return</p>
                </div>
            </div>
            <div class="icon">
                <img src="../assets/images/icon3.png" alt="">
                <div class="content">
                    <h3>Payment Secure</h3>
                    <p>100% secure payment</p>
                </div>
            </div>
            <div class="icon">
                <img src="../assets/images/icon4.png" alt="">
                <div class="content">
                    <h3>Support 24/7</h3>
                    <p>Contact us anytime</p>
                </div>
            </div>

        </section>
        </div>
       

        <!-- Footer -->
     <footer
          class="text-center text-lg-start text-dark bg-light"
          style="background-color: #ECEFF1"
          >
   
    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold fs-1 text-success">PLANTNEST</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 150px; background-color: #000; height: 3px"
                />
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
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 150px; background-color: #000; height: 3px"
                />
            <p>
              <a href="flowering.php" class="text-dark fs-3 text-decoration-none">Flowering</a>
            </p>
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
              <a href="pesticides.php" class="text-dark fs-3 text-decoration-none">Pesticides</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold fs-1 text-success"> links</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 80px; background-color: #000; height: 3px"
                />
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
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 120px; background-color: #000; height: 3px"
                />
            <p class="fs-3"><i class="fas fa-home mr-3 text-dark fs-1 text-decoration-none"></i> Ly Tu Trong,Can Tho,Viet Nam</p>
            <p class="fs-3"><i class="fas fa-envelope mr-3 text-dark fs-1 text-decoration-none"></i>  plantnest@gmail.com</p>
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