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

  $card_num = $expire_date = "";

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(isset($_POST["submit"]))
    {
      if(empty($_POST["card_number"]))
      {
        $card_num = $_POST["card_number"];
        if(!preg_match("/^[0-9]{16,16}$/", $card_num))
        {
        echo "<script>alert(\"Invalid Card Number\")</script>";
        echo "<script>window.location=\"order.php\"</script>";
        }
      }
      if(empty($_POST["expiration_date"]))
      {
        $expire_date = $_POST["expiration_date"];
        if(!preg_match("/^[0-12]\"[0-28]$/", $expire_date))
        {
        echo "<script>alert(\"Invalid Expiration Date\")</script>";
        echo "<script>window.location=\"order.php\"</script>";
        }
      }
    }
    else
    {
      if(empty($_POST["name"]))
      {
        $ErrName = "Name is required";
        echo "<script>window.location=\"order.php\"</script>";
      }
      else
      {
        $name = $_POST["name"];
        if(!preg_match("/^[a-zA-Z-' ]*$/", $name))
        {
        $ErrName = "Only letters and whitespace allowed"
        echo "<script>window.location=\"order.php\"</script>";
        }
      }
      if (empty($_POST["email"]))
      {
        $ErrEmail = "Email is required";
      }
      else
      {
        $email = $_POST["email"];
    // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL))
      {
      $ErrEmail = "Invalid email format";
      echo "<script>window.location=\"order.php\"</script>";
      }
      if (empty($_POST["address"]))
      {
        $ErrEmail = "Email is required";
      }
      
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
    <form method="POST" action="./order.php?action=add">
        <label for="name">Name: </label>
        <input type="text" name="name" value="<?php echo $name; ?>" required/><span style="color:red">* <?php echo $ErrName; ?></span>
        <label for="email">Email: </label>
        <input type="text" name="email" value="<?php echo $email; ?>" required/><span style="color:red">* <?php echo $ErrEmail; ?></span>
        <label for="address">Address: </label>
        <input type="text" name="address" value="<?php echo $address; ?>" required/><span style="color:red">* <?php echo $ErrAddress; ?></span>
        <input type="submit" name="continue" value="Continue"/>
          <label for="card_number">Card Number: </label>
          <input type="text" name="card_number" value="" required disabled/>
          <label for="expiration_date">Expiration Date: </label>
          <input type="text" name="expiration_date" value="" required disabled/>
          <input type="submit" name="submit" value="Submit" disabled/>
        </form>
    </div>
  </main>
</body>

<footer>
  <p>Created by Group9A for NIU CSCI467 Group Project &copy; 12/04/2020</p>
</footer>

</html>
