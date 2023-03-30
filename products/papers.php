<?php echo "" ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="../css/style.css" rel="stylesheet" />
  <link href="../css/products.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

  <title>Arte crafts</title>
</head>

<body>
  <header id="header">
    <div class="brand-name">
      <a href="../index.php">
        <span>Arte</span>
        <span>crafts</span>
      </a>
    </div>
    <navbar class="nav">
      <ul>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li>
          <a href="../pages/wishlist.php"><i class="fa fa-heart" aria-hidden="true"></i></a>
        </li>
        <li>
          <a href="#"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
        </li>
        <li>
          <div class="tooltip">
            <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
              <span>0</span>
            </a>
            <span class="tooltiptext">No items in the cart</span>
          </div>
        </li>
      </ul>
    </navbar>
  </header>
  <main>
    <section class="paper">
      <div class="container">
        <div class="outer-paper-products">
          <ul>
            <a href="../index.php#products">
              <li>Products</li>
            </a>
            <span>❯</span>
            <li><b>Paper</b></li>
          </ul>
          <div class="inner-outer-products">

            <div class="card-container"></div>

          </div>
        </div>
      </div>
      </div>
    </section>
  </main>
  <footer></footer>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script>

    $(document).ready(async function () {
      $.ajax({
        method: "GET",
        url: "../server/item/getAll.php?kind=1",
        success: async function (response) {
          let result = await JSON.parse(response)
          result.data ? setElements(result) : console.log("No Items");
        },
        error: function (xhr, status, error) {
          console.error(xhr, status, error);
        }
      })
    });

    function setElements(params) {

      params.data.forEach(item => {
        let name = item["name"];
        let price = item["price"];
        let image = item["img"];
        let itemID = item["itemID"];
        let src = `../assets/images/${image}`
        $("section .inner-outer-products .card-container").append(
          $(`<a href="./papers/paper.php?itemID=${itemID}"><div class="card">
                <div class="image-holder">
                    <img src=${src} loading="lazy">
                </div>
                <div class="detail">
                    <p>${name}</p>
                    <p></p>
                    <p>₱${price}.00</p>
                </div>
            </div></a>`));
      })


    }
  </script>

  <script src="../js/animation.js"></script>
</body>

</html>