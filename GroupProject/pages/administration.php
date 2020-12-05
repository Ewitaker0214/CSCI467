<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Administration Page</title>
  <!--<link rel="stylesheet" href="../styles.css">-->
</head>

<?PHP //connection to database
DEFINE (‘DB_USER’,  ‘z1845428’);
DEFINE (‘DB_PASSWORD’, ‘2000Jan13’);
DEFINE (‘DB_HOST’, ‘courses’);
DEFINE (‘DB_NAME’, ‘z1845428’);

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die(‘Could not connect to MySQL ‘ .
	mysqli_connect_error());
?>

<header>
  <a href="../index.php"><h1>Home</h1></a>
</header>

<body>
  <main id="">
    <h2>Update Shipping and Handling Costs</h2>

	  <!-- Form for updating the shipping/handling costs -->
<form method ="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<p>   0-10lbs: <input type ="number", name="bracket1" /></p>
<p>  10-25lbs: <input type="number", name="bracket2" /></p>
<p> 25-100lbs: <input type="number", name="bracket3" /></p>
<p>100-250lbs: <input type="number", name="bracket4" /></p>
<p>   250+lbs: <input type="number", name="bracket5" /></p>

<p><input type="submit" name="submit" value="Submit"><input type="reset"></p>
</form>
    
    <h2>Search For Order Details</h2>


<!-- Form for searching Order history by date  -->
<form action="administration.php" method="POST">
<p>    
	         <label for="sDate">Starting Date:</label>
		 <input type="datetime-local" id="sDate" name="sDate" value="1/1/2000 12:00 AM" >

            	 <label for="eDate">End Date:</label>
		 <input type="datetime-local" id="eDate" name="eDate" value="12/3/2020 12:00 AM" >
		      	 
  		 <p><input type="submit" name="submit1" value="View"></p>
<br>
</p>

	  <!-- form for searching Order history by price -->
<form action="administration.php" method="POST">
<p>              
		 <label for="sPrice">Starting Price:</label>
		 <input type="number" id="sPrice" name="sPrice" min="0" value="0">
     
                 <label for="ePrice">Max Price:</label>
            	 <input type="number" id="ePrice" name="ePrice" min = "1" value="1">

		 <p><input type="submit" name="submit2" value="View"></p>
<br>       	   		 
</p>

	  <!-- form for searching order history by authorized status -->
<form action="administration.php" method="POST">
<p>              
		 
		 <input type="Radio" id="Authorized" name="isAuthorized" value="1" >
		 <label for="Authorized">Authorized</label>
		 
            	 <input type="Radio" id="Unauthorized" name="isAuthorized" value="0" >
                 <label for="Unauthorized">Unauthorized</label>

		 <p><input type="submit" name="submit3" value="View"></p> 
<br>         	 		             	   		 
</p>

	  <!-- form for searching order history by shipped status -->
<form action="administration.php" method="POST">
<p>              
		 
		 <input type="Radio" id="Sphipped" name="isShipped" value="1" >
		 <label for="Shipped">Sphipped</label>
		 
            	 <input type="Radio" id="notShipped" name="isShipped" value="0" >
                 <label for="unShipped">Not Shipped</label>

		 <p><input type="submit" name="submit4" value="View"></p> 
<br>          	 		             	   		 
</p>

	  <!-- table for displaying Order details -->
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
	      
switch (true) //switch statment that decides which form was submitted
{
	case isset($_POST["submit"]): //updates the shipping costs
		$_SESSION["bracket1"] = $_POST["bracket1"];
		$_SESSION["bracket2"] = $_POST["bracket2"];
		$_SESSION["bracket3"] = $_POST["bracket3"];
		$_SESSION["bracket4"] = $_POST["bracket4"];
		$_SESSION["bracket5"] = $_POST["bracket5"];
		echo '<p>Shipping charges have been updated</p>';
			break;

	case isset($_POST["submit1"])://searches by date
			$SBD = "Select * From Order_History Where date_ordered <= " . $_POST["eDate"] . " AND date_ordered >= " . $_POST["sDate"] .";";
			$result = mysqli_query($dbc,$SBD);
			while($row = mysql_fetch_array($result))
			{
				echo ‘<tr><td align=‘left”>’ .
				$row[‘customer_id’] . ‘</td><td align=“left”>’ .
				$row[‘name’] . ‘</td><td align=“left”>’ .
				$row[‘email’] . ‘</td><td align=“left”>’ .
				$row[‘address’] . ‘</td><td align=“left”>’ .
				$row[‘card_number’] . ‘</td><td align=“left”>’ .
				$row[‘expiration_date’] . ‘</td><td align=“left”>’ .
				$row[‘purchase_amount’] . ‘</td><td align=“left”>’ .
				$row[‘authorized’] . ‘</td><td align=“left”>’ .
				$row[‘shipped’] . ‘</td><td align=“left”>’ .
				$row[‘date_ordered’] . ‘</td><td align=“left”>’ .
				$row[‘date_shipped’] . ‘</td><td align=“left>’;

				echo ‘</tr>;
			}
			echo '</table>;
		break;
		
	case isset($_POST["submit2"])://lists by purchase amount
			$SBP = "Select * From Order_History Where purchase_amount <= " . $_POST["ePrice"] . " AND purchase_amount >= " . $_POST["sPrice"] .";";
			$result = mysqli_query($dbc, $SBP);
			while($row = mysql_fetch_array($result))
			{
				echo ‘<tr><td align=‘left”>’ .
				$row[‘customer_id’] . ‘</td><td align=“left”>’ .
				$row[‘name’] . ‘</td><td align=“left”>’ .
				$row[‘email’] . ‘</td><td align=“left”>’ .
				$row[‘address’] . ‘</td><td align=“left”>’ .
				$row[‘card_number’] . ‘</td><td align=“left”>’ .
				$row[‘expiration_date’] . ‘</td><td align=“left”>’ .
				$row[‘purchase_amount’] . ‘</td><td align=“left”>’ .
				$row[‘authorized’] . ‘</td><td align=“left”>’ .
				$row[‘shipped’] . ‘</td><td align=“left”>’ .
				$row[‘date_ordered’] . ‘</td><td align=“left”>’ .
				$row[‘date_shipped’] . ‘</td><td align=“left>’;

				echo ‘</tr>;
			}
			echo '</table>;
		break;

	case isset($_POST["submit3"])://searches by shipped status
			$SBS = "Select * From Order_History Where shipped = " .$_POST["isShipped"]. ";";
			$result = mysqli_query($dbc, $SBP);
			while($row = mysql_fetch_array($result))
			{
				echo ‘<tr><td align=‘left”>’ .
				$row[‘customer_id’] . ‘</td><td align=“left”>’ .
				$row[‘name’] . ‘</td><td align=“left”>’ .
				$row[‘email’] . ‘</td><td align=“left”>’ .
				$row[‘address’] . ‘</td><td align=“left”>’ .
				$row[‘card_number’] . ‘</td><td align=“left”>’ .
				$row[‘expiration_date’] . ‘</td><td align=“left”>’ .
				$row[‘purchase_amount’] . ‘</td><td align=“left”>’ .
				$row[‘authorized’] . ‘</td><td align=“left”>’ .
				$row[‘shipped’] . ‘</td><td align=“left”>’ .
				$row[‘date_ordered’] . ‘</td><td align=“left”>’ .
				$row[‘date_shipped’] . ‘</td><td align=“left>’;

				echo ‘</tr>;
			}
			echo '</table>;
		break;

	case isset($_POST["submit4"])://searches by authorized status
			$SBA = "Select * From Order_History Where authorized = " .$_POST["isAuthorized"]. ";";
			$result = mysqli_query($dbc, $SBA);
			while($row = mysql_fetch_array($result))
			{
				echo ‘<tr><td align=‘left”>’ .
				$row[‘customer_id’] . ‘</td><td align=“left”>’ .
				$row[‘name’] . ‘</td><td align=“left”>’ .
				$row[‘email’] . ‘</td><td align=“left”>’ .
				$row[‘address’] . ‘</td><td align=“left”>’ .
				$row[‘card_number’] . ‘</td><td align=“left”>’ .
				$row[‘expiration_date’] . ‘</td><td align=“left”>’ .
				$row[‘purchase_amount’] . ‘</td><td align=“left”>’ .
				$row[‘authorized’] . ‘</td><td align=“left”>’ .
				$row[‘shipped’] . ‘</td><td align=“left”>’ .
				$row[‘date_ordered’] . ‘</td><td align=“left”>’ .
				$row[‘date_shipped’] . ‘</td><td align=“left>’;

				echo ‘</tr>;
			}
			echo '</table>;
			mysqli_close($dbc);
		break;
}
?>
  </main>
</body>

<footer>
  <p>Created by Group9A for NIU CSCI467 Group Project &copy; 12/04/2020</p>
</footer>
</html>
