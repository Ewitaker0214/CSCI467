<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Administration Page</title>
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

 // $rs = $pdo_legacy->query("DESCRIBE parts;");
 // print_r($rs->fetchALL(PDO::FETCH_ASSOC));
?>

<header>
  <a href="../index.php"><h1>Home</h1></a>
</header>

<body>
  <main id="">
    <h2>Shipping and Handling Costs</h2>

<form method ="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<p>   0-10lbs: <input type ="number", name="bracket1" /></p>
<p>  10-25lbs: <input type="number", name="bracket2" /></p>
<p> 25-100lbs: <input type="number", name="bracket3" /></p>
<p>100-250lbs: <input type="number", name="bracket4" /></p>
<p>   250+lbs: <input type="number", name="bracket5" /></p>

<p><input type="submit" name="submit" value="Submit"><input type="reset"></p>
</form>
    
    <h2>Search For Order Details</h2>


<!-- MAKE EACH SEARCH TYPE ITS OWN FORM, then make an if statement  -->
<form action="administration.php" method="POST">
<p>    
	         <label for="sDate">Starting Date:</label>
		 <input type="datetime-local" id="sDate" name="sDate" >

            	 <label for="eDate">End Date:</label>
		 <input type="datetime-local" id="eDate" name="eDate" >
		      	 
  		 <p><input type="submit" name="submit1" value="View"></p>
<br>
</p>

<form action="administration.php" method="POST">
<p>              
		 <label for="sPrice">Starting Price:</label>
		 <input type="range" id="sPrice" name="sPrice" min="0" >
     
                 <label for="ePrice">Max Price:</label>
            	 <input type="range" id="ePrice" name="ePrice" min="1">

		 <p><input type="submit" name="submit2" value="View"></p>
<br>       	   		 
</p>

<form action="administration.php" method="POST">
<p>              
		 
		 <input type="Radio" id="Authorized" name="isAuthorized" value="1" >
		 <label for="Authorized">Authorized</label>
		 
            	 <input type="Radio" id="Unauthorized" name="isAuthorized" value="0" >
                 <label for="Unauthorized">Unauthorized</label>

		 <p><input type="submit" name="submit3" value="View"></p> 
<br>         	 		             	   		 
</p>

<form action="administration.php" method="POST">
<p>              
		 
		 <input type="Radio" id="Sphipped" name="isShipped" value="1" >
		 <label for="Shipped">Sphipped</label>
		 
            	 <input type="Radio" id="notShipped" name="isShipped" value="0" >
                 <label for="unShipped">Not Shipped</label>

		 <p><input type="submit" name="submit4" value="View"></p> 
<br>          	 		             	   		 
</p>

  <h3 class="">Order Details</h3>
      <table border=1 cellspaces=1 id="">
      <tr>
        <th>Customer ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Adress</th>
	      <th>Card Number</th>
	      <th>Expiration Date</th>
	      <th>Purchase Amount</th>
        <th>Authorized</th>
        <th>Shipped</th>
	      <th>Date Ordered</th>
	      <th>Date Shipped</th>
      </tr>

<?PHP  
	      
switch (true) 
{
	case isset($_POST["submit"]):
		$_SESSION["bracket1"] = $_POST["bracket1"];
		$_SESSION["bracket2"] = $_POST["bracket2"];
		$_SESSION["bracket3"] = $_POST["bracket3"];
		$_SESSION["bracket4"] = $_POST["bracket4"];
		$_SESSION["bracket5"] = $_POST["bracket5"];
		echo '<p>Shipping charges have been updated</p>';
			break;

	case isset($_POST["submit1"]):
		if($connected)
      		{
			$result = $pdo->query($SBD);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
			
	foreach ($rows as $row)
        {
        ?>
        <form method="POST" action="administration.php">
          <tr>
            <td># <?php echo $row["customer_id"]; ?></td>
            <input type="hidden" name="customer_id" value="<?php echo $row["customer_id"]; ?>"/>
            <td><?php echo $row["name"]; ?></td>
            <input type="hidden" name="name" value="<?php echo $row["name"]; ?>"/>
            <td>$<?php echo $row["email"]; ?></td>
            <input type="hidden" name="email" value="<?php echo $row["email"]; ?>"/>
            <td># <?php echo $row["address"]; ?></td>
            <input type="hidden" name="address" value="<?php echo $row["address"]; ?>"/>
            <td><?php echo $row["card_number"]; ?></td>
            <input type="hidden" name="card_number" value="<?php echo $row["card_number"]; ?>"/>
            <td>$<?php echo $row["expiration_date"]; ?></td>
            <input type="hidden" name="expiration date" value="<?php echo $row["expiration_date"]; ?>"/>
	    <td># <?php echo $row["purchase_amount"]; ?></td>
            <input type="hidden" name="purchase_amount" value="<?php echo $row["purchase_amount"]; ?>"/>
            <td><?php echo $row["authorized"]; ?></td>
            <input type="hidden" name="authorized" value="<?php echo $row["authorized"]; ?>"/>
            <td>$<?php echo $row["shipped"]; ?></td>
            <input type="hidden" name="shipped" value="<?php echo $row["shipped"]; ?>"/>
            <td># <?php echo $row["date_ordered"]; ?></td>
            <input type="hidden" name="date_ordered" value="<?php echo $row["date_ordered"]; ?>"/>
            <td><?php echo $row["date_shipped"]; ?></td>
            <input type="hidden" name="date_shipped" value="<?php echo $row["date_shipped"]; ?>"/>
          </tr>
        </form>
        <?php
	}
	}		
		break;

	case isset($_POST["submit2"]):
		if($connected)
      		{
			$result = $pdo->query($SBP);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
			
	foreach ($rows as $row)
        {
        ?>
        <form method="POST" action="administration.php">
          <tr>
            <td># <?php echo $row["customer_id"]; ?></td>
            <input type="hidden" name="customer_id" value="<?php echo $row["customer_id"]; ?>"/>
            <td><?php echo $row["name"]; ?></td>
            <input type="hidden" name="name" value="<?php echo $row["name"]; ?>"/>
            <td>$<?php echo $row["email"]; ?></td>
            <input type="hidden" name="email" value="<?php echo $row["email"]; ?>"/>
            <td># <?php echo $row["address"]; ?></td>
            <input type="hidden" name="address" value="<?php echo $row["address"]; ?>"/>
            <td><?php echo $row["card_number"]; ?></td>
            <input type="hidden" name="card_number" value="<?php echo $row["card_number"]; ?>"/>
            <td>$<?php echo $row["expiration_date"]; ?></td>
            <input type="hidden" name="expiration date" value="<?php echo $row["expiration_date"]; ?>"/>
	    <td># <?php echo $row["purchase_amount"]; ?></td>
            <input type="hidden" name="purchase_amount" value="<?php echo $row["purchase_amount"]; ?>"/>
            <td><?php echo $row["authorized"]; ?></td>
            <input type="hidden" name="authorized" value="<?php echo $row["authorized"]; ?>"/>
            <td>$<?php echo $row["shipped"]; ?></td>
            <input type="hidden" name="shipped" value="<?php echo $row["shipped"]; ?>"/>
            <td># <?php echo $row["date_ordered"]; ?></td>
            <input type="hidden" name="date_ordered" value="<?php echo $row["date_ordered"]; ?>"/>
            <td><?php echo $row["date_shipped"]; ?></td>
            <input type="hidden" name="date_shipped" value="<?php echo $row["date_shipped"]; ?>"/>
          </tr>
        </form>
        <?php	
	}
		}
		break;

	case isset($_POST["submit3"]):
		if($connected)
      		{
			$result = $pdo->query($SBS);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
			
	foreach ($rows as $row)
        {
        ?>
        <form method="POST" action="administration.php">
          <tr>
            <td># <?php echo $row["customer_id"]; ?></td>
            <input type="hidden" name="customer_id" value="<?php echo $row["customer_id"]; ?>"/>
            <td><?php echo $row["name"]; ?></td>
            <input type="hidden" name="name" value="<?php echo $row["name"]; ?>"/>
            <td>$<?php echo $row["email"]; ?></td>
            <input type="hidden" name="email" value="<?php echo $row["email"]; ?>"/>
            <td># <?php echo $row["address"]; ?></td>
            <input type="hidden" name="address" value="<?php echo $row["address"]; ?>"/>
            <td><?php echo $row["card_number"]; ?></td>
            <input type="hidden" name="card_number" value="<?php echo $row["card_number"]; ?>"/>
            <td>$<?php echo $row["expiration_date"]; ?></td>
            <input type="hidden" name="expiration date" value="<?php echo $row["expiration_date"]; ?>"/>
	    <td># <?php echo $row["purchase_amount"]; ?></td>
            <input type="hidden" name="purchase_amount" value="<?php echo $row["purchase_amount"]; ?>"/>
            <td><?php echo $row["authorized"]; ?></td>
            <input type="hidden" name="authorized" value="<?php echo $row["authorized"]; ?>"/>
            <td>$<?php echo $row["shipped"]; ?></td>
            <input type="hidden" name="shipped" value="<?php echo $row["shipped"]; ?>"/>
            <td># <?php echo $row["date_ordered"]; ?></td>
            <input type="hidden" name="date_ordered" value="<?php echo $row["date_ordered"]; ?>"/>
            <td><?php echo $row["date_shipped"]; ?></td>
            <input type="hidden" name="date_shipped" value="<?php echo $row["date_shipped"]; ?>"/>
          </tr>
        </form>
        <?php		
		}
		}
		break;

	case isset($_POST["submit4"]):
		if($connected)
      		{
			$result = $pdo->query($SBA);
			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
			
	foreach ($rows as $row)
        {
        ?>
        <form method="POST" action="administration.php">
          <tr>
            <td># <?php echo $row["customer_id"]; ?></td>
            <input type="hidden" name="customer_id" value="<?php echo $row["customer_id"]; ?>"/>
            <td><?php echo $row["name"]; ?></td>
            <input type="hidden" name="name" value="<?php echo $row["name"]; ?>"/>
            <td>$<?php echo $row["email"]; ?></td>
            <input type="hidden" name="email" value="<?php echo $row["email"]; ?>"/>
            <td># <?php echo $row["address"]; ?></td>
            <input type="hidden" name="address" value="<?php echo $row["address"]; ?>"/>
            <td><?php echo $row["card_number"]; ?></td>
            <input type="hidden" name="card_number" value="<?php echo $row["card_number"]; ?>"/>
            <td>$<?php echo $row["expiration_date"]; ?></td>
            <input type="hidden" name="expiration date" value="<?php echo $row["expiration_date"]; ?>"/>
	    <td># <?php echo $row["purchase_amount"]; ?></td>
            <input type="hidden" name="purchase_amount" value="<?php echo $row["purchase_amount"]; ?>"/>
            <td><?php echo $row["authorized"]; ?></td>
            <input type="hidden" name="authorized" value="<?php echo $row["authorized"]; ?>"/>
            <td>$<?php echo $row["shipped"]; ?></td>
            <input type="hidden" name="shipped" value="<?php echo $row["shipped"]; ?>"/>
            <td># <?php echo $row["date_ordered"]; ?></td>
            <input type="hidden" name="date_ordered" value="<?php echo $row["date_ordered"]; ?>"/>
            <td><?php echo $row["date_shipped"]; ?></td>
            <input type="hidden" name="date_shipped" value="<?php echo $row["date_shipped"]; ?>"/>
          </tr>
        </form>
        <?php
	}		
		}
		break;
}
	      //SQL SEARCH STATMENTS
$SBD = "Select * From Order_History Where date_ordered <= " . $_POST["eDate"] . " AND date_ordered >= " . $_POST["sDate"] ."";
$SBS = "Select * From Order_History Where shipped = " .$_POST["isShipped"]. "";
$SBP = "Select * From Order_History Where purchase_amount <= " . $_POST["ePrice"] . " AND purchase_amount >= " . $_POST["sPrice"] ."" ;
$SBA = "Select * From Order_History Where authorized = " .$_POST["isAuthorized"]. "";
?>
    </table>
  </main>
</body>

<footer>
  <p>Created by Group9A for NIU CSCI467 Group Project &copy; 12/04/2020</p>
</footer>
</html>
