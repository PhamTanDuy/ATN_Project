<!DOCTYPE html>
<html>

<head>
  <title>ATN Toys</title>
  <link rel="icon" type="image/x-icon" href="Images/atlassian.svg">
  <script src="https://kit.fontawesome.com/54f0cb7e4a.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="">
  <link rel="stylesheet" href="Images/styles.css">
</head>

<body>
  <?php
  include('connect.php');
  $get_products = "SELECT * FROM products";
  $get_categories = "SELECT * FROM category";
  $products = mysqli_query($conn, $get_products);
  $categories = [];

  //fetch category data and store in the $categories array
  $category = mysqli_query($conn, $get_categories);
  if ($category) {
    while ($row = mysqli_fetch_assoc($category)) {
      $categories[$row['id']] = $row['cate_name'];
    }
  }
  ?>
  <!--menubar-->
  <!-- prodduct page -->

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <div class="logo">
        <img src="Images/Logo.jpg" alt="ATN Toys Logo" width="80" height="55">
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./Index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#products">Products</a>
          </li>
          <a class="nav-link" href="#video">Video</a>
          <a class="nav-link" href="#location">Locations</a></li>
          <a class="nav-link" href="#contact">Contact</a></li>
          <a class="nav-link" href="Create.php">New</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <section id="introduction">
    <div class="container">
      <h2>Welcome to ATN Toys</h2>
      <p>Discover a world of fun and imagination with our wide range of toys for teenagers.
        With shops located in various provinces across Vietnam, we are committed to reaching every corner of the country,
        ensuring that teenagers have access to the latest and most engaging toys.
        At ATN Toys, we believe in the power of play and its positive impact on child development.
        That's why we carefully curate our collection, offering toys that promote learning, exploration, and fun.
      </p>
      <a href="#products" class="btn">Explore Our Toys</a>
    </div>
  </section>

  <section id="video">
    <div class="#">
      <h3 class="content">LEGO 90th Anniversary | We are all builders</h3>
      <div class="media-container">
        <div class="video-container">
          <video controls>
            <source src="Videos/LEGO_Video.mp4" type="video/mp4">
          </video>
        </div>
        <div class="image-container">
          <img src="Images/video.jpg" alt="video">
        </div>
      </div>
    </div>
  </section>

  <section id="products">
    <div class="#">
      <h3 class="content">Our Products</h3>
      <p >Explore our wide selection of toys designed for teenagers:</p>
      <div class="product-grid">
        <div class="product-card">

          <div class="container-fluid text-center mt-2 ">
            <div class="row">
              <!-- lg la laptop banh ra 2 cot, md la ...banh ra 5 cot , sm la dien thoai banh ra 12 cot -->

              <?php foreach ($products as $product) {
              ?>
                <div class="col-sm-12 col-md-5 col-lg-2">
                  <div class="card" style=" margin-top: 12px; ">
                    <img src="<?php echo $product['thumbnail']; ?>" class="card-img-top" alt="<?php echo $product['prod_name']; ?>" height="150px">
                    <div class="card-body">
                      <h5 class="card-title "><?php echo $product['prod_name']; ?></h5>
                      <div class="d-flex justify-content-between align-items-center">
                        <p class="price text-primary fs-4"><?php echo $product['price']; ?></p>
                        <p class="text-secondary fs-5">
                          <span class="badge bg-secondary "><?php echo $categories[$product['category_id']]; ?>

                          </span>
                        </p>
                      </div>
                      <a href="./Update.php/<?php echo $product["id"]; ?>" class="btn btn-primary w-100">Update</a>
                      <button type="button" class="btn btn-danger mt-2 w-100" data-bs-toggle="modal" data-bs-target="#<?php echo $product["id"] ?>">
                        Delete
                      </button>

                    </div>
                  </div>
                </div>
                <!-- modal -->
                <div class="modal fade" id="<?php echo $product["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure to delete ?
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Once you delete, it will be removed from database
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, keep
                          it</button>
                        <button type="button" class="btn btn-danger">
                          <a href="index.php?delete_product_id=<?php echo $product["id"]; ?>" class="text-white text-decoration-none">
                            Yes, delete it
                          </a>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              <?php }  ?>

            </div>
          </div>
        </div>
        <!-- Add more product cards as needed -->
      </div>
    </div>
  </section>

  <section id="location">
    <div class="#">
      <h3 class="content">Our Locations</h3>
      <div class="location-card">
        <h4>Ha Noi</h4>
        <p>9 Le Duan Street, Hoan Kiem District</p>
      </div>
      <div class="location-card">
        <h4>Da Nang</h4>
        <p>88 Hoa Thuan Tay Street, Hai Chau District</p>
      </div>
      <div class="location-card">
        <h4>Ho Chi Minh City</h4>
        <p>26 Nguyen Xi Street, Binh Thanh District</p>
      </div>
      <div class="location-card">
        <h4>Can Tho</h4>
        <p>18 An Khanh Street, Ninh Kieu District</p>
      </div>
      <!-- Add more location cards as needed -->
    </div>
  </section>

  <section id="contact">
    <div class="container">
      <h3>Contact Us</h3>
      <p>We would love to hear from you. Reach out to us with any questions, feedback, or inquiries:</p>
      <form>
        <input type="text" placeholder="Your Name" required>
        <input type="email" placeholder="Your Email" required>
        <textarea placeholder="Your Message" rows="5" required></textarea>
        <button type="submit" class="btn">Send Message</button>
      </form>
    </div>
  </section>


  <section class="container">
    <p><b>Follow ATN Toys</b></p>
    <a href="https://facebook.com">
      <img src="https://i.ibb.co/LrVMXNR/social-fb.png" alt="Facebook">
    </a>
    <a href="https://linkedin.com">
      <img src="https://i.ibb.co/b30HMhR/social-linkedin.png" alt="Linkedin">
    </a>
  </section>

  <footer>
    <div class="container">
      <div class="footer-grid">
        <div class="footer-column">
          <h4>About Us</h4>
          <p>ATN Toys is a leading Vietnamese company dedicated to providing high-quality toys to teenagers across Vietnam. Our mission is to bring joy and inspiration through play.</p>
        </div>
        <div class="footer-column">
          <h4>Contact Us</h4>
          <ul class="footer-contact">
            <li><i class="fa fa-map-marker"></i> Dinh Bo Linh Street, Binh Thanh District, Ho Chi Minh City</li>
            <li><i class="fa fa-phone"></i> +0393253467</li>
            <li><i class="fa fa-envelope"></i> duypham@atntoys.com</li>
          </ul>
        </div>
        <div class="footer-column">
          <h4>Quick Links</h4>
          <ul class="footer-links">
            <li><a href="index.php">Home</a></li> -
            <li><a href="#products">Products</a></li> -
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div>
      </div>
      <p class="footer-text">&copy; 2023 ATN Toys. All rights reserved by PhamTanDuy.</p>
    </div>
  </footer>

</body>

</html>
<?php
if (isset($_GET['delete_product_id'])) {
  $product_id = $_GET['delete_product_id'];
  $delete_product = "delete from products where id='$product_id'";
  $execute = mysqli_query($conn, $delete_product);

  if ($execute) {
    echo "<script> window.open('Index.php','_self')</script>";
  }
}
?>