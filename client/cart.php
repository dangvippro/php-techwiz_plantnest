<?php
    session_start();
    ob_start();
    require_once "../assets/database.php";

    $id;
    if (!isset($_SESSION['id'])) {
        Header("location: login.php");
    }

    if (isset($_SESSION['cart'])) {
        $total_quantity = 0;
        $total_amount = 0;
    }

    if (isset($_POST['proID']) && isset($_POST['quantity'])) {
        $newQuantity = $_POST['quantity'];
        $proID = $_POST['proID'];   
        if ($newQuantity!="") {
            $_SESSION['cart'][$proID]['quantity'] = $newQuantity;
        }
    }

    if (isset($_GET['action']) && $_GET['action']=="remove") {
        foreach ($_SESSION["cart"] as $key => $value) {
            if ($_GET["id"] == $key)
                unset($_SESSION["cart"][$key]);
            if (empty($_SESSION["cart"]))
                unset($_SESSION["cart"]);
        }
        Header("location:cart.php");
    }

    if (isset($_GET['action']) && $_GET['action'] == "empty") {
        unset($_SESSION["cart"]);
        Header("location:cart.php");
    }

    if(isset($_POST['userlogin']) && ($_POST['userlogin'])){
        $id = $_POST['id'];
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
        <link rel="shortcut icon" type="image/png" href="../assets/images/icon-logo.png">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/cart.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">   
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
        <style>
            *{
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
                                    <a class="nav-link dropdown-toggle text-success" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Product
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-light text-success" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item fs-4" href="flowering.php">Flowering</a></li>
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
                        if(isset($_SESSION['email']) && ($_SESSION['email']!="")){ ?>
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
                             <div><i class="bi bi-cart2 "></i></div>
                              
                           </button></a>
                    </div>
                </div>
            </div>
        </nav>

        <section class="h-100" style="background-color: #f8f8f8; font-size: 16px;">
            <div class="container h-100 pt-5">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12">
                        <?php if (isset($_SESSION['cart'])) {?>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-normal mb-0 text-black">Your Cart</h3>
                        <div href="" class="text-danger" style="border-radius: 3px; padding: 4px;">
                            <a onclick="return delete_func();" href="?action=empty" class="text-decoration-none btn btn-outline-success shadow-none mt-2 fs-4 fs-2 "><i class="bi bi-trash"></i> Delele All</a>
                        </div>
                        </div>

                        <div class="card rounded-3 mb-4">
                            <div class="card-body p-4">
                                <div class="row d-flex justify-content-between align-items-center">
                                    <div class="col-md-2 col-2">Product</div>

                                    <div class="col-md-10 col-10">
                                        <div class="row">
                                            <div class="col-md-4 col-12"></div>
                                            <div class="col-md-2 col-3">Price</div>
                                            <div class="col-md-2 col-3 d-flex">Quantity</div>
                                            <div class="col-md-2 col-3">Total</div>
                                            <div class="col-md-2 col-3 text-end">Actions</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card rounded-3 mb-4">
                        <?php
                            foreach ($_SESSION['cart'] as $item => $value) {
                                $item_price = $value["quantity"] * $value["price"];
                        ?>
                            <div class="card-body p-4">
                                <div class="row d-flex justify-content-between align-items-center">
                                    <div class="col-md-2 col-2">
                                        <img src="../<?php echo $value['image']; ?>"
                                        class="img-fluid rounded-3" alt="Cotton T-shirt" style="width: 60px;">
                                    </div>

                                    <div class="col-md-10 col-10">
                                        <div class="row">
                                            <div class="col-md-4 col-12">
                                                <p class="lead fw-normal"><?php echo $value['name']; ?></p>    
                                            </div>
                                            <div class="col-md-2 col-3">
                                                <h5 class="mb-0">$<?php echo $value['price']; ?></h5>
                                            </div>
                                            <div class="col-md-2 col-3 d-flex">
                                                <form method="post" class="d-flex">
                                                    <button type="submit" class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                    <i class="fas fa-minus"></i>
                                                    </button>

                                                    <input type="hidden" name="proID" value="<?php echo $item; ?>">

                                                    <input min="1" name="quantity" value="<?php echo $value['quantity']; ?>" type="number"
                                                    class="form-control form-control-sm" style="font-size: 1rem; min-width: 20px; max-width: 40px" onblur="this.parentNode.submit()" onkeydown="if(event.keyCode === 13) { event.preventDefault(); this.parentNode.submit()} " />

                                                    <button type="submit" class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                    <i class="fas fa-plus"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-md-2 col-3">
                                                <h5 class="mb-0">$<?php echo $item_price; ?></h5>
                                            </div>
                                            <div class="col-md-2 col-3 text-end">
                                                <a onclick="return delete_func();" href="?action=remove&id=<?php echo $item; ?>">
                                                    <button type="button" class="btn-close"></button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            $total_quantity += $value["quantity"];
                            $total_amount += $value["quantity"] * $value["price"];
                            }
                        ?>
                        </div>


                        <div class="order_total">
                            <div class="order_total_content" style="text-align: right;">
                                <div class="order_total_title">Order Total:</div>
                                <div class="order_total_amount">$<?php echo $total_amount; ?></div>
                            </div>
                        </div>
                        <div class="cart_buttons"> 
                            <a href="../index.php"><button type="button" class="text-decoration-none btn btn-lg btn-outline-success shadow-none mt-2 fs-2"><i class="bi bi-basket2"></i> Continue Shopping</button></a>
                            <a href="?action=placeOrder" class="text-decoration-none btn btn-lg btn-outline-success shadow-none mt-2 fs-2 ms-2"><i class="bi bi-paypal"></i> Place Order</a>
                        </div>

                        <?php 
                        } else {
                            echo '<div class="d-flex justify-content-center"><img src="../assets/images/empty-cart.jpg" class="img-fluid" style="width: 480px;"></div><div class="d-flex justify-content-center" style="margin-top: 90px;"><a href="../index.php"><button type="button" class="btn btn-lg btn-danger">RETURN TO HOME</button></a></div>';
                        }
                        
                        
                        
                        //save orders
                        if (isset($_GET['action']) && $_GET['action']=="placeOrder") {
                            $id = $_SESSION['id'];
                            $orderQuery = "INSERT INTO orders(userID, totalAmount) VALUES ('$id', $total_amount)";
                            $test = $conn->query($orderQuery);
                            echo $test;

                            $orderID = $conn->insert_id;
                            foreach ($_SESSION['cart'] as $item => $value) {
                                $oPrice = $value['price'];
                                $oQty = $value['quantity'];
                                $orderDetailQuery = "INSERT INTO orderdetails(orderID, productID, quantity, price) VALUES ($orderID, $item, $oQty, $oPrice)";
                                $conn->query($orderDetailQuery);
                            }
                            echo 'Succesfully!';
                            Header("location: ?action=empty");
                        }
                        ?>
                        
                    </div>
                </div>
                
            </div>
        </section>

        <!-- footer -->
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

            function delete_func() {
                var conf = confirm("Do you want to delete?");
                return conf;
           }
        </script>
    </body>
</html>