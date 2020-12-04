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


?>

<header>
  <a href="../index.html">
    <h1>Home</h1>
  </a>
</header>

<body>
  <main id="">
    <div>
    <form method="POST" action="./product_catalog.php?action=add#shopping_cart">
        <label for="name">Name: </label>
        <input type="text" name="name" value="<?php echo $name; ?>" required/><span style="color:red">* <?php echo $ErrName; ?></span>
        <label for="email">Email: </label>
        <input type="text" name="email" value="<?php echo $email; ?>" required/><span style="color:red">* <?php echo $ErrEmail; ?></span>
        <label for="address">Address: </label>
        <input type="text" name="address" value="<?php echo $address; ?>"/>
        <input type="submit" name="submit" value="Submit"/>
      </form>
    </div>
  </main>
</body>

<footer>
  <p>Created by Group9A for NIU CSCI467 Group Project &copy; 12/04/2020</p>
</footer>

</html>
