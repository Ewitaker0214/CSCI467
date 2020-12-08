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
  
  //$rs = $pdo_legacy->query("DESCRIBE parts;");
  //print_r($rs->fetchALL(PDO::FETCH_ASSOC));
?>
  
<header>
  <a href="../index.php"><h1>Home</h1></a>
</header>

<center>
<h1>WAREHOUSE WORKSTATION</h1>

<body>
  <main id="">
 
  <!--form to print packing list based on a range of dates-->
  <header> Packing List  
    <form action="workstation.php" method="post">
    <label for="sDate">Starting Date:</label>
    <input type="date" id="sDate" name="sDate">
   
    <label for="eDate">End Date:</label>
    <input type="date" id="eDate" name="eDate" >
		      	 
    <p><input type="submit" name="submit1" value="Print"></p>                                        
   
 <!--form to search for order # to print out invoice & shipping label-->
  <header> Print Invoice & Shipping Label  
    <form action="order.php" method="post">
    <br>Order #: <input type="text" name="number"><br>
    <input type="submit" name="submit" value="Print"><br><br>
    </form>

  <!--form to confirm shipment of order by entering e-mail of customer and e-email sent to notify customer of shipment-->	  
  <header> Confirm Shipment 
    <form action="order.php" method="post">
    Customer E-mail: <input type="text" name="number"><br>
    <input type="submit" name="submit" value="Confirm"><br><br>
    </form>
	  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  
    
</main>
</body>

<footer>
  <p>Created by Group 9A for NIU CSCI467 Group Project &copy; 12/04/2020</p>
</footer>
</html>
