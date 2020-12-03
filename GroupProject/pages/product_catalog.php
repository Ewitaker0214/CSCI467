<?PHP
  $username = 'student';
  $password = 'student';
  $connected = false;
  try { // if something goes wrong, an exception is thrown
    $dsn = "mysql:host=blitz.cs.niu.edu;dbname=csci467";
    $pdo_legacy = new PDO($dsn, $username, $password, array('port' => '3306'));
    $connected = true;
  }
  catch(PDOexception $e) { // handle that exception
    echo "Connection to database failed: " . $e->getMessage();
  }

  $quantity_error = "";

  if(isset($_POST["add_to_cart"]))
  {
    $quantity = $_POST["quantity"];
    if($quantity < 0)
    {
      $quantity_error = "Error, invalid quantity selected!";
    } else
    {
      if(isset($_SESSION["shopping_cart"]))
      {

      }
      else
      {
        $shopping_cart = array(
          "item_number" => $_POST["number"],
          "item_description" => $_POST["description"],
          "item_price" => $_POST["price"],
          "item_quantity" => $quantity
        );
      }
    }
    echo "<script>alert(\"HELLO WORLD\")</script";
  }
?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Product System | Product Catalog</title>
  <!--<link rel="stylesheet" href="../styles.css">-->
  <!--<link rel="stylesheet" href="../slideshow.css"/>-->
</head>

<header>
  <a href="../index.html"><h1>Home</h1></a>
</header>

<body>
  <main id="">
    <h3 class="">Catalog</h3>
    <div class="">
      <table border=1 cellspaces=1 id="">
      <tr>
        <th>Product Number</th>
        <th>Image</th>
        <th>Description</th>
        <th>Price</th>
        <!--<th>Available Quantity</th>-->
      </tr>
      <?php
      if($connected)
      {
        $rs = $pdo_legacy->query("SELECT number, description, price, pictureURL FROM parts;");
        $rows = $rs->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row)
        {
      ?>
      <form method="POST" action="./product_catalog.php?action=add">
        <tr class="">
          <td><?php echo $row["number"]; ?></td>
          <input type="hidden" name="number" value="<?php echo $row["number"]; ?>"/>
          <td><img src="<?php echo $row["pictureURL"]; ?>" alt="Image of <?php echo $row["description"]; ?>"/></td>
          <td><?php echo $row["description"]; ?></td>
          <input type="hidden" name="description" value="<?php echo $row["description"]; ?>"/>
          <td><?php echo $row["price"]; ?></td>
          <input type="hidden" name="price" value="<?php echo $row["price"]; ?>"/>
          <td><input type="text" name="quantity" value=0 /><span style="color:red"><?php echo $quantity_error; ?></span></td>
          <td><input type="submit" name="add_to_cart" value="add_to_cart"/></td>
        </tr>
        </form>
        <?php
      }
    }
         ?>
        </table>
    </div>
    <br/>
    <div class="">
      <form method="POST" action="./order.php">
        <table border=1 cellspaces=1 id="">
        <tr>
          <th>Product Number</th>
          <th>Description</th>
          <th>Price</th>
          <th>Quantity</th>
        </tr>
        <?php
        if(!is_null($shopping_cart))
        {
          foreach ($shopping_cart as $item)
          {
        ?>
          <tr class="">
            <td><?php echo $item["number"]; ?></td>
            <td><?php echo $item["description"]; ?></td>
            <td><?php echo $item["price"]; ?></tr>
          <?php
          }
        }
          ?>
          </table>
      </form>
    </select>
  </form>
    </div>
  </main>
</body>

<footer>
  <p>Created by Group9A for NIU CSCI467 Group Project &copy; 12/04/2020</p>
</footer>
<!--<script>
/*var selectBox = document.getElementById("order_selection");
var selectedValue;
var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var items = document.getElementsByClassName("item");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }

  slides[slideIndex-1].style.display = "block";
}

// Thumbnail image controls
function currentSlide() {
  selectedValue = selectBox.options[selectBox.selectedIndex].value;
  for(let i = 0; i <= selectBox.options.length - 1; i++) {
    console.log(i);
    if (selectBox.options[i].value == selectedValue) showSlides(slideIndex = i);
  }
}*/
</script>-->
</html>
