<?php 
session_start();
ob_start();
include_once '../classes/Product.php';
include_once '../classes/Users.php';
include_once '../classes/UserQueries.php';
include_once '../assets/database.php';
$product = new Product();
$user = new UserQueries();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact us</title>

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
                                        <li><a class="dropdown-item fs-4" href="flowering.php">Flowering</a></li>
                                        <li><a class="dropdown-item fs-4" href="nonFlowering.php">Non-flowering</a></li>
                                        <li><a class="dropdown-item fs-4" href="medicinal.php">Medicinal</a></li>
                                        <li><a class="dropdown-item fs-4" href="indoor.php">Indoor</a></li>
                                        <li><a class="dropdown-item fs-4" href="outdoor.php">Outdoor</a></li>
                                        <li><a class="dropdown-item fs-4" href="pots.php">Pots</a></li>
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
                        <a href="cart.php">
                            <button type="button" class="btn btn-outline-success shadow-none me-lg-3 me-3 fs-2" data-bs-toggle="modal" data-bs-target="#registermodal">
                            <i class="bi bi-cart2"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </nav>


        <!-- Contact -->
     <div class="my-5 px-1">
       <h2 class="fw-bold h-font text-center">CONTACT US</h2>
     </div>

     <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 mb-5 px-3 ">

          <div class="bg-white rounded shadow p-3 ">
           <iframe class="w-100 rounded mb-4" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15076.895920873054!2d72.83196972644954!3d19.141670564195152!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b63aceef0c69%3A0x2aa80cf2287dfa3b!2sJogeshwari%20West%2C%20Mumbai%2C%20Maharashtra%20400047!5e0!3m2!1sen!2sin!4v1621609263469!5m2!1sen!2sin" loading="lazy"></iframe>
             <h5 class="mt-2 fs-2">Call us</h5>
             <a href="tel: +095784843" class="d-inline-block mb-2 text-decoration-none text-dark fs-2">
                <i class="bi bi-telephone-fill fs-2"></i>+095784843
             </a>
             <h5 class="mt-2 fs-2">Address</h5>
             <a href="tel: +095784843" class="d-inline-block mb-2 text-decoration-none text-dark fs-2">
                <i class="bi bi-geo-alt-fill fs-2"></i>NinhKieu,canTho
             </a>
              <h5 class="mt-2 fs-2">Email</h5>
              <a href="mailto: plantnest@gmail.com"  class="d-inline-block mb-2 text-decoration-none text-dark fs-2">
                <i class="bi bi-envelope-fill fs-2" ></i> plantnest@gmail.com
              </a>

              <h5 class="mt-4 fs-2">Follow us</h5>
                <a href="" class="d-inline-block  text-dark fs-5 me-2">
                  <i class="bi bi-facebook me-1 fs-2"></i> 
                </a>
                <a href="" class="d-inline-block  text-dark fs-5">
                  <i class="bi bi-instagram me-1 fs-2"></i> 
                </a>

          </div>
    </div>
        <?php 
        //Create
        if(isset($_POST['send'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            
            if($user->insertFeedback($conn, $name, $email, $message)){
                
                // echo "Thanks for your feedback!";
            } else {
                echo "Can't feedback." . $conn->error;
            }
        }
        ?>

     <div class="col-lg-6 col-md-6 mb-5 px-4">
          <div class="bg-white rounded shadow p-4 ">
              <form action="" method="POST">
                <h5 class="fs-1">Have you any question?</h5>
                <p style="font-size: 15px;">PlantNest hopes that the sincerity and understanding of customers' needs will bring you the best products, become a sustainable bridge that brings a harmonious connection between PlantNest and customers!</p>
                <div class="mt-3">
                    <label class="form-label fs-2" style="font-weight:500;">Name</label>
                    <input name="name" required type="text" class="form-control shadow-none fs-3 "  >
                </div>
                <div class="mt-3">
                    <label class="form-label fs-2" style="font-weight:500;">Email</label>
                    <input name="email" required type="email" class="form-control shadow-none fs-3"  >
                </div>
                <div class="mt-3">
                    <label class="form-label fs-2" style="font-weight:500;">Message</label>
                    <textarea name="message" required class="form-control shadow-none fs-3"  rows="6" style="resize:none;"></textarea>
                </div>
               <button type="submit" name="send" class=" text-white rounded custom-bg mt-5 px-4 p-2 fs-3">Send</button>
            </form>
          </div>
    </div>
      

 <!-- Footer -->
 <footer
          class="text-center text-lg-start text-dark bg-light "
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