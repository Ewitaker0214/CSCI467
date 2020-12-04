<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Product System - Workstation</title>
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
  <a href="../index.html"><h1>Home</h1></a>
</header>

<header> WAREHOUSE WORKSTATION<br><br>
<body>
  <main id="">
 
  <header> New Packing List
  <form action="orders.php" method="post">
  Date: <input type="text" name="name"><br>
  <input type="submit" name="submit" value="Print"><br><br>
  </form>

  <header> Print Invoice & Shipping Label
  <form action="order.php" method="post">
  Order #: <input type="text" name="number"><br>
  <input type="submit" name="submit" value="Print"><br><br>
  </form>

  <header> Confirm Shipment
  if($connected){
  <form action="order.php" method="post">
  Customer E-mail: <input type="text" name="number"><br>
  <input type="submit" name="submit" value="Confirm"><br><br>
  </form>
  $sql = "SELECT * FROM Order History WHERE authorization = 1 AND shipped = 0 ORDER BY     date_ordered DESC|ASC LIMIT 1";
  }

  </main>
</body>

<footer>
  <p>Created by Group 9A for NIU CSCI467 Group Project &copy; 12/04/2020</p>
</footer>
</html>
