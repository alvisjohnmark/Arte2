<!-- <?php session_start(); ?> -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="./css/index.css" rel="stylesheet" />
  <link href="./css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <title>Arte crafts</title>
</head>

<body>
  <header id="header">
    <div class="brand-name">
      <a href="./index.php">
        <span>Arte</span>
        <span>crafts</span>
      </a>
    </div>
    <navbar class="nav">
      <ul>
        <li><a href="./products/paper.php">About</a></li>
        <li><a href="#">Contact</a></li>
        <li>
          <a href="./pages/wishlist.php"><i class="fa fa-heart" aria-hidden="true"></i></a>
        </li>
        <li>
          <a href="./forms/login.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
        </li>
        <li>
          <!-- <div class="tooltip"> -->
          <a href="./pages/cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <span>0</span>
          </a>
          <!-- <span class="tooltiptext">No items in the cart</span>
          </div> -->
        </li>
      </ul>
    </navbar>
  </header>

  <main>
    <section class="main-content">
      <div class="container">
        <h1>Locally-sourced Stationaries and Handcrafts</h1>
        <div class="image-holder">
          <img src="./assets/images/10 Ways to Self-Care During Quarantine - Society19 - Copy.jfif"
            alt="notebook aesthetic" />
        </div>
      </div>
    </section>
    <!--PRODUCTS SECTION-->
    <section class="products" id="products">
      <div class="container">
        <h2>OUR PRODUCTS</h2>
        <div class="items">
          <div class="item">
            <a href="./products/papers.php">
              <div class="image">
                <img src="./assets/images/PRP.png" alt="" />
              </div>
            </a>
            <div class="text">
              <p>Paper</p>
            </div>
          </div>
          <div class="item">
            <div class="image">
              <img src="./assets/images/Personalised-Journal-Notebook-Custom-Name-Journal-Custom-Etsy-Copy.png"
                alt="" />
            </div>
            <div class="text">
              <p>Recycled Notebooks</p>
            </div>
          </div>
          <div class="item">
            <div class="image">
              <img
                src="./assets/images/pencil-case_-cottagecore_-pencil-pouch_-pencil-case-aesthetic_-cottage-core_-estuches-lapices-tela_-.png"
                alt="" />
            </div>
            <div class="text">
              <p>Canvas Pencil Case and Pouches</p>
            </div>
          </div>
          <div class="item">
            <div class="image">
              <img src="./assets/images/Pretty-Stationery-Items.png" alt="" />
            </div>
            <div class="text">
              <p>Stationary and Calligraphy Pens</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--SERVICES-->
    <section class="services" id="services">
      <div class="container">
        <h2>OUR SERVICES</h2>
        <div class="items">
          <div class="item">
            <div class="image">
              <img src="./assets/images/Dark Academia Stationary Kit Letter Writing Dark Academia - Etsy - Copy.png"
                alt="" />
            </div>
            <div class="text">
              <p>Letter Writing Service</p>
            </div>
          </div>
          <div class="item">
            <div class="image">
              <img src="./assets/images/Personalised-Journal-Notebook-Custom-Name-Journal-Custom-Etsy-Copy.png"
                alt="" />
            </div>
            <div class="text">
              <p>Personalize Your Purchase</p>
            </div>
          </div>
          <div class="item">
            <div class="image">
              <img
                src="./assets/images/pencil-case_-cottagecore_-pencil-pouch_-pencil-case-aesthetic_-cottage-core_-estuches-lapices-tela_-.png"
                alt="" />
            </div>
            <div class="text">
              <p>Pack and Shift as Gift</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer>
    asd
    <?php

    if (isset($_SESSION["customerID"])) {
      echo $_SESSION["customerID"];
    } else {
      echo "Po";
    }

    ?>
  </footer>
  <!-- <script src="https://code.iconify.design/iconify-icon/1.0.5/iconify-icon.min.js"></script> -->
  <script src="./js/animation.js"></script>
</body>

</html>