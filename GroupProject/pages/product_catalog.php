<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Product System - Product Catalog</title>
  <!--<link rel="stylesheet" href="../styles.css">-->
  <link rel="stylesheet" href="../slideshow.css"/>
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

?>

<header>
  <a href="../index.html"><h1>Home</h1></a>
</header>

<body>
  <main id="">
    <h3 class="">Catalog</h3>
    <!-- Slideshow container -->
    <div class="slideshow-container">
      <!-- Full-width images with number and caption text -->
      <?php
      if($connected){
        $rs = $pdo_legacy->query("SELECT number, description, price, pictureURL FROM parts;");
        $rows = $rs->fetchAll(PDO::FETCH_ASSOC);
        $name = "";
        foreach ($rows as $row) {
          echo "<div class='mySlides fade'>
                <form action='./order.php' method='GET'>
                  <div class='numbertext'><p>" . $row['number'] . "</p></div>
                  <input type='text' name='order_selection' value='" . $row['number'] . "'/>
                  <input type='image' src='" . $row['pictureURL'] . "' alt='" . $row['description'] . "' style='width:100%'/>
                  <div class='text'><p>" . $row['description'] ." : " . $row['price'] . "</p></div>
                  </form>
                </div>";
        }
      }
      ?>
      <!-- Next and previous buttons -->
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>

    <!-- The dots/circles -->
    <div style="text-align:center">
      <form action="./order.php" method="GET">
        <label for="order_selection">Part:</label>
        <select id="order_selection" name="order_selection" onclick="event.stopImmediatePropagation()">
      <?php
      if($connected){
        $count = 1;
        foreach ($rows as $row) {
          echo "<option class='item' onclick='currentSlide(" . $count . ")' value='" . $row['description'] . "'>" . $row['description'] . "</option>";
          $count += 1;
        }
      }
      ?>
    </select>
  </form>
    </div>
  </main>
</body>

<footer>
  <p>Created by Group9A for NIU CSCI467 Group Project &copy; 12/04/2020</p>
</footer>
<script>
var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var items = document.getElementsByClassName("item");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  slides[slideIndex-1].style.display = "block";
}
</script>
</html>
