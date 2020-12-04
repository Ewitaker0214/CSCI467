<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Product System - Product Catalog</title>
  <!--<link rel="stylesheet" href="../styles.css">-->
</head>
  
<?PHP
  session_start();
  
  //establishes a connection to the blitz site and the Legacy DB
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
  
  //establishes connection with out website and the Group Project DB
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

  /* Now that we did that it's business time! Using the legacy DB we list the contents from the parts Table.
     We Print that cause we want to see it. also it's in an associative array. */
  $rs = $pdo_legacy->query("SELECT number, description from parts;");
  print_r($rs->fetchALL(PDO::FETCH_ASSOC));
  
    foreach($row as $row){
        echo "Number= " . $row["number"] . "Description= " . $row["description"];
        echo "<br>";
  }
  
 // now i need to store/insert the contents of the parts table to our Product table from out group prohect database
  
?>

<header>
  <a href="../index.html"><h1>Home</h1></a>
</header>

<h1> Receiving Desk </h1>
  
<body>
  <main id="">

  </main>
</body>

<footer>
  <p>Created by Group9A for NIU CSCI467 Group Project &copy; 12/04/2020</p>
</footer>
</html>
