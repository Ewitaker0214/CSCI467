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

  $ErrName = $ErrEmail = "";
  $name = $email = $address ="";

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(empty($_POST["name"]))
    {
      $ErrName = "Name is required";
      if(!preg_match("/^[a-zA-Z-' ]*$/", $name))
      {
        $ErrName = "Only letters and whitespace allowed"
        echo "<script>window.location=\"product_catalog/php#shopping_cart\"</script>";
      }
    }
    if (empty($_POST["email"]))
    {
    $ErrEmail = "Email is required";
  }
  else
  {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      $ErrEmail = "Invalid email format";
    }
  }

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
    <span style="color:red">* required field ?></span>
    <form method="POST" action="./product_catalog.php?action=add#shopping_cart">
        <label for="card_number">Card Number: </label>
        <input type="text" name="card_number" value="" required/>
        <label for="expiration_date">Expiration Date: </label>
        <input type="text" name="expiration_date" value="" required/>
        <input type="submit" name="submit" value="Submit"/>
      </form>
    </div>
  </main>
</body>

<footer>
  <p>Created by Group9A for NIU CSCI467 Group Project &copy; 12/04/2020</p>
</footer>

</html>
