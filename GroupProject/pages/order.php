<!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Product System - Product Catalog</title>
  <!--<link rel="stylesheet" href="../styles.css">-->
</head>
<script type="text/javascript">
function enable()
{
  let tags = document.getElementsByClassName("card_info");
  for(let i = 0; i < tags.length; ++i)
  {
    tags[i].disabled = false;
  }
  let next = document.getElementsByClassName("name_info")
  next[0].disabled = true;
}

function closeForm(){
  let form = document.getElementById("credit_form");
  form.style.display = "none";
}
</script>
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
  $amount = 0;
  if(isset($_POST["amount"]))
  {
    $_SESSION["amount"] = $_POST["amount"];
  }
  if(isset($_SESSION["amount"]))
  {
    $amount = $_SESSION["amount"];
  }
  $name = $email = $address = "";

  $card_num = $expire_date = "";
  $valid = $complete = false;

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(isset($_POST["submit"]))
    {
      if (isset($taxes))
      {
        $amount *= $taxes;
      }
      else
      {
        $taxes = 0.15;
        $amount = number_format(($amount * $taxes) + $amount, 2);
      }
      if(empty($_POST["card_number"]))
      {
        echo "<script>alert(\"Invalid Card Number\")</script>";
        echo "<script>window.location=\"order.php\"</script>";
      }
      else
      {
        $card_num = $_POST["card_number"];
        if(!preg_match("/^\d{16}|\d{4}[ ]\d{4}[ ]\d{4}[ ]\d{4}$/", $card_num))
        {
          echo "<script>alert(\"Invalid Card Number\")</script>";
          echo "<script>window.location=\"order.php\"</script>";
        }
      }
      if(empty($_POST["expiration_date"]))
      {
        echo "<script>alert(\"Invalid Expiration Date\")</script>";
        echo "<script>window.location=\"order.php\"</script>";
      }
      else
      {
        $expire_date = $_POST["expiration_date"];
        if(!preg_match("/^(0[1-9]|1[0-2])\/[0-9]{4}$/", $expire_date))
        {
        echo "<script>alert(\"Invalid Expiration Date\")</script>";
        echo "<script>window.location=\"order.php\"</script>";
        }
      }
      $url = "http://blitz.cs.niu.edu/CreditCard/";
      $data = array(
        "vendor" => "Group9A",
        "trans" => rand(),
        "cc" => $card_num,
        "name" => $name,
        "exp" => $expire_date,
        "amount" => $amount);

        $options = array(
          'http' => array(
            'header' => array('Content-type: application/json', 'Accept: application/json'),
            'method' => 'POST',
            'content'=> json_encode($data)));

            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            
            if (!preg_match("/.*(errors).*/", $result))
            {
              $substrpos = strpos($result, "_id");
              $substr = substr($result, $substrpos);
              echo "<h1>Your Transaction Number is: " . $substr ."</h1>";
              $complete = true;
              $pdo->query("INSERT INTO Order_History (name, email, address, card_number, expiration_date, purchase_amount, authorized) VALUES ($name, $email, $address, $card_num, $expire_date, $amount, 1);");
            }
            else
            {
              echo "<script>alert(\"Transaction Failed: " . $result . "\")</script>";
              echo "<script>window.location=\"order.php\"</script>";
            }
          }
          else
          {
          if (isset($_GET["action"] ))
          {
            if ($_GET["action"] == "add")
            {
              if (isset($taxes))
              {
                $amount *= $taxes;
              }
              else
              {
                $taxes = 0.15;
                $amount = number_format(($amount * $taxes) + $amount, 2);
              }
              if(empty($_POST["name"]))
              {
                echo "<script>alert(\"Name is required\")</script>";
                echo "<script>window.location=\"order.php\"</script>";
              }
              else
              {
                $name = $_POST["name"];
                if(!preg_match("/^[a-zA-Z-' ]*$/", $name))
                {
                  echo "<script>alert(\"Only letters and whitespace allowed\")</script>";
                  echo "<script>window.location=\"order.php\"</script>";
                }
              }
              if (empty($_POST["email"]))
              {
                echo "<script>alert(\"Email is required\")</script>";
              }
              else
              {
                $email = $_POST["email"];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                  echo "<script>alert(\"Invalid email format\")</script>";
                  echo "<script>window.location=\"order.php\"</script>";
                }
              }
              if (empty($_POST["address"]))
              {
                echo "<script>alert(\"Email is required\")</script>";
                echo "<script>window.location=\"order.php\"</script>";
              }
              else
              {
                $address = $_POST["address"];
              }
              $valid = true;
            }
          }
        }
      }
?>

<header>
  <a href="../index.php">
    <h1>Home</h1>
  </a>
</header>

<body>
  <main id="">
    <div>
    <span style="color:red">* required field </span>
    <form id="credit_form" method="POST" action="./order.php?action=add">
        <label for="name">Name: </label>
        <input type="text" name="name" value="<?php echo $name; ?>" required/><span style="color:red">*</span>
        <label for="email">Email: </label>
        <input type="text" name="email" value="<?php echo $email; ?>" required/><span style="color:red">*</span>
        <label for="address">Address: </label>
        <input type="text" name="address" value="<?php echo $address; ?>" required/><span style="color:red">*</span>
        <input class="name_info" type="submit" name="continue" value="Continue"/>
          <label for="card_number">Card Number: </label>
          <input class="card_info" type="text" name="card_number" value="" required disabled/>
          <label for="expiration_date">Expiration Date: </label>
          <input class="card_info" type="text" name="expiration_date" value="" required disabled/>
          <input class="card_info" type="submit" name="submit" value="Submit" disabled/>
        </form>
        <?php
        if ($valid)
        {
          echo "<h2>Total:" . $amount . " (taxes included) </hr>";
          echo "<script>enable();</script>";
        }
        if ($complete)
        {
          echo "<script>closeForm();</script>";
        }
         ?>
    </div>
  </main>
</body>

<footer>
  <p>Created by Group9A for NIU CSCI467 Group Project &copy; 12/04/2020</p>
</footer>

</html>
