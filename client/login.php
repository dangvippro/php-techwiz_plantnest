<?php 
session_start();
ob_start();
include_once '../classes/Product.php';
include_once '../classes/Users.php';
include_once '../assets/database.php';
$product = new Product();

$error = [];
if(isset($_POST['userlogin']) && ($_POST['userlogin'])){
    $id = $_POST['userid'];
    $password = $_POST['password'];
    
    $result = getUserInfo($conn, $id);
    $data = $result->fetch_assoc();
    $checkID = $result->num_rows;
    
    if($checkID == 1){
        
        $checkPass = password_verify($password, $data['password']);
        
            
        if($checkPass){ 
            if($data['role'] == 1){
                $_SESSION['role'] = $data['role'];
                $_SESSION['idAdmin'] = $data['userID'];
                $_SESSION['passwordAdmin'] = $data['password'];
                $_SESSION['nameAdmin'] = $data['fullname'];
                $_SESSION['phoneAdmin'] = $data['phone'];
                $_SESSION['addressAdmin'] = $data['address'];
                $_SESSION['emailAdmin'] = $data['email'];
                $_SESSION['birthdayAdmin'] = $data['birthday'];
                $_SESSION['genderAdmin'] = $data['gender'];
                header('location: ../admin/home.php');
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
                header('location: ../index.php');
            }
        } else {
            $error['password'] = "<div class='text-danger fs-3'>Password is invalid.</div>";
        }
    } else {
        $error['id'] = "<div class='text-danger fs-3'>ID does not exist</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>

        <!-- favicon -->
        <link rel="shortcut icon" type="image/png" href="../assets/images/icon-logo.png">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">   
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
        <style>
            .alert{
            position: fixed; 
            top:25px;
            right:25px;
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
                                    <a class="nav-link text-success dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                        if(isset($_SESSION['email']) && ($_SESSION['email']!="")){ ?>
                        <a href="manageAccount.php">
                                <button type="button" class="btn btn-outline-success shadow-none me-lg-3 me-3 fs-2" data-bs-toggle="modal" data-bs-target="#registermodal">
                                    <?php echo $_SESSION['email']; ?>
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

       <!-- breadcrumb-section -->
       
        <div class="mt-5 d-flex justify-content-around">
            <form action="" method="POST">
                <div class="container text-center ">
                       <div style="width:100%; font-size:15px">
                            <p class="alert-danger"><?php echo (isset($error['id']))?$error['id']:''; ?></p>
                            <p><?php echo (isset($error['password']))?$error['password']:''; ?></p>
                        </div>
                    <table>
                        <thead>
                            <tr>
                                <th colspan="2"><h1 class="mt-3 fs-1 fw-bold" >LOGIN ACCOUNT</h1></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                                <td><p class="mt-4 fs-2 ">
                                <i class="bi bi-person-circle"></i> UserID:</p> 
                                </td>
                                <td><input type="search" placeholder="Enter UserID" style="width:300px; height:35px" name="userid" required class="form-control shadow-none fs-3"  ></td>
                            </tr>
                            <tr>
                                <td><p class="fs-2 mt-4" style="margin-left:20px">
                                <i class="bi bi-lock"></i>  Password: </p>
                                </td> 
                                <td> <input type="password" placeholder="Enter Password" style="width:300px; height:35px;" name="password"  required class="form-control shadow-none fs-3"  ></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="title-login ">
                                    <input type="submit" class="btn btn-outline-success shadow-none me-lg-3 mt-2 me-3 fs-4"  style="margin-left:-100px"  value="LOGIN" name="userlogin" style=""/>
                                    <input type="reset" class="btn btn-outline-success shadow-none me-lg-3 mt-2 me-3 fs-4" value="RESET" name="reset" id="btn-reset"/>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><p class="fs-4 mt-4" style="margin-left:-140px">No account?<a href="register.php" class="text-decoration-none fs-4"> Register</a></p></td> 
                            </tr>
                        </tbody>
                    </table>
                        
                </div>
            </form>
        </div></br></br></br></br></br></br></br></br>
   

           <!-- Footer -->
  <footer
          class="text-center text-lg-start text-dark bg-light mt-4"
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

        <!-- footer section ends -->

        <!-- scroll top button  -->
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