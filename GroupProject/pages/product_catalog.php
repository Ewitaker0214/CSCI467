<?PHP
  session_start();
  $username = 'student';
  $password = 'student';
  $connected1 = false;
  try { // if something goes wrong, an exception is thrown
    $dsn = "mysql:host=blitz.cs.niu.edu;dbname=csci467";
    $pdo_legacy = new PDO($dsn, $username, $password, array('port' => '3306'));
    $connected1 = true;
  }
  catch(PDOexception $e) { // handle that exception
    echo "Connection to database failed: " . $e->getMessage();
  }

  $username = 'z1845428';
  $password = '2000Jan13';
  $connected2 = false;
  try { // if something goes wrong, an exception is thrown
    $dsn = "mysql:host=courses;dbname=z1845428";
    $pdo = new PDO($dsn, $username, $password);
    $connected2 = true;
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
      echo "<script>window.location=\"./product_catalog.php#shopping_cart\"</script>";
    }
    else if ($quantity == 0)
    {
      echo "<script>window.location=\"./product_catalog.php#shopping_cart\"</script>";
    }
    else
    {
      if(isset($_SESSION["shopping_cart"]))
      {
        $shopping_cart_number = array_column($_SESSION["shopping_cart"], "item_number");
        if(!in_array($_POST["number"], $shopping_cart_number))
        {
          $count = count($_SESSION["shopping_cart"]);
          $shopping_cart = array(
            "item_number" => $_POST["number"],
            "item_description" => $_POST["description"],
            "item_price" => $_POST["price"],
            "item_quantity" => $quantity
          );
          $_SESSION["shopping_cart"][$count] = $shopping_cart;
        }
        else
        {
          echo "<script>alert(\"Item Already Added\")</script>";
          echo "<script>window.location=\"./product_catalog.php#shopping_cart\"</script>";
        }
      }
      else
      {
        $shopping_cart = array(
          "item_number" => $_POST["number"],
          "item_description" => $_POST["description"],
          "item_price" => $_POST["price"],
          "item_quantity" => $quantity
        );
        $_SESSION["shopping_cart"][0] = $shopping_cart;
      }
    }
  }

  if(isset($_GET["action"]))
{
  if($_GET["action"] == "delete")
  {
    foreach ($_SESSION["shopping_cart"] as $items => $values)
    {
      if($values["item_number"] == $_GET["number"])
      {
        unset($_SESSION["shopping_cart"][$items]);
        echo "<script>alert(\"Item Removed\")</script>";
        echo "<script>window.location=\"./product_catalog.php#shopping_cart\"</script>";
      }
    }
  }
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
  <a href="../index.php"><h1>Home</h1></a>
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
        <th>On Hand</th>
        <th colspan=2>Add to Shopping Cart</th>
      </tr>
      <?php
      if($connected1)
      {
        $rs1 = $pdo_legacy->query("SELECT number, description, price, pictureURL FROM parts;");
        $rows1 = $rs1->fetchAll(PDO::FETCH_ASSOC);

        $rs2 = $pdo->query("SELECT part_number, description, in_stock FROM Products;");
        print_r($rs2);
        $rows2 = $rs2->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows1 as $row1)
        {
      ?>
      <form method="POST" action="./product_catalog.php?action=add#shopping_cart">
        <tr>
          <td># <?php echo $row1["number"]; ?></td>
          <input type="hidden" name="number" value="<?php echo $row1["number"]; ?>"/>
          <td><img src="<?php echo $row1["pictureURL"]; ?>" alt="Image of <?php echo $row1["description"]; ?>"/></td>
          <td><?php echo $row1["description"]; ?></td>
          <input type="hidden" name="description" value="<?php echo $row1["description"]; ?>"/>
          <td>$<?php echo $row1["price"]; ?></td>
          <input type="hidden" name="price" value="<?php echo $row1["price"]; ?>"/>
          <td><?php foreach ( $rows2 as $row2 ) {if(row2["part_number"] == row1["number"] && row2["description"] == row1["description"]) echo $row2["in_stock"];} ?></td>
          <td><input type="text" name="quantity" value=0 /></td>
          <td><input type="submit" name="add_to_cart" value="Add to Cart"/></td>
        </tr>
        </form>
        <?php
      }
    }
         ?>
        </table>
    </div>
    <br/>
    <a id="shopping_cart"><h3>Shopping Cart</h3></a>
    <span style="color:red"><?php echo $quantity_error; ?></span>
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
        if(!empty($_SESSION["shopping_cart"]))
        {
          $total = 0;
          foreach($_SESSION["shopping_cart"] as $items => $values)
          {
            $total += number_format($values["item_quantity"] * $values["item_price"], 2);
        ?>
          <tr>
            <td># <?php echo $values["item_number"]; ?></td>
            <td><?php echo $values["item_description"]; ?></td>
            <td>$<?php echo $values["item_price"]; ?></td>
            <td><?php echo $values["item_quantity"]; ?></td>
            <td><a href="product_catalog.php?action=delete&number=<?php echo $values["item_number"]; ?>#shopping_cart">Remove</a></td>
          </tr>
          <?php
          }
        ?>
        <tr>
          <td colspan=2 >Total: </td>
          <input type="text" name="amount" value="<?php echo $total; ?>"hidden/>
          <td>$<?php echo $total; ?></td>
          <td colspan=2 ><input type="submit" name="complete_order" value="Complete Order"/></td>
        </tr>
        <?php
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

</html>
