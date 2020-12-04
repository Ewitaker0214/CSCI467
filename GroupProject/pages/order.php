<!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Product System - Product Catalog</title>
  <!--<link rel="stylesheet" href="../styles.css">-->
</head>

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

  $username = 'z1845428';
  $password = '2000Jan13';
  $connected = false;
  try { // if something goes wrong, an exception is thrown
    $dsn = "mysql:host=courses;dbname=z1845428";
    $pdo = new PDO($dsn, $username, $password);
    $connected = true;
  }
  catch(PDOexception $e) { // handle that exception
    echo "Connection to database failed: " . $e->getMessage();
  }

  $rs = $pdo_legacy->query("DESCRIBE parts;");
  print_r($rs->fetchALL(PDO::FETCH_ASSOC));
?>

<header>
  <a href="../index.html">
    <h1>Home</h1>
  </a>
</header>

<body>
  <main id="">
    </div>
    <form method="POST" action="./product_catalog.php?action=add#shopping_cart">
      <tr>
        <td># <?php echo $row["number"]; ?></td>
        <input type="hidden" name="number" value="<?php echo $row["number"]; ?>"/>
        <td><img src="<?php echo $row["pictureURL"]; ?>" alt="Image of <?php echo $row["description"]; ?>"/></td>
        <td><?php echo $row["description"]; ?></td>
        <input type="hidden" name="description" value="<?php echo $row["description"]; ?>"/>
        <td>$<?php echo $row["price"]; ?></td>
        <input type="hidden" name="price" value="<?php echo $row["price"]; ?>"/>
        <td><input type="text" name="quantity" value=0 /></td>
        <td><input type="submit" name="add_to_cart" value="Add to Cart"/></td>
      </tr>
      </form>
  </main>
</body>

<footer>
  <p>Created by the Wuhan Clan for NIU CSCI466 Group Project &copy; 4/20/2020</p>
</footer>

</html>
