<?php
if (!isset($_SESSION)){
    session_start();
    include "navbar.php";

}

//if(isset($_SESSION['userName_session'])){
//    $username=$_SESSION['userName_session'];
//    echo $_SESSION['userName_session'];
//    echo $_SESSION['success'];


//}
//else{
//    echo 'no user is logged in now';
//}
//?>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>My Blog</h1>
            <span class="subheading">My Blog</span>
          </div>
        </div>
      </div>
    </div>
  </header>



<?php

//if (!isset($_SESSION['userName_session'])) {
//    session_start();
//}

if(!isset($_SESSION['userName_session'])){
    echo "you should register first";
    echo "<a href='/articles/login.php'>login</a> <br>";

}else {
    include 'connection.php';
    $sql = $conn->prepare("SELECT * FROM articles");
    $sql->execute();
    $rows = $sql->fetchAll();
    foreach ($rows as $row) {

//        echo "<div>" . $row['id'] . "</div>";
//        echo "<div>" . $row['title'] . "</div>";
//        echo "<div>" . $row['writer_name'] . "</div>";
//        echo "<div>" . $row['body'] . "</div>";
//        echo "<div> <img src='  images/uploads/" . $row['image'] . "  ' alt = '' /></div>";
//        echo "<div>" . $row['date'] . "</div>";
//
//        echo "<td>" . "<a href='delete.php/?idd=$row[id]'>delete</a>"."</td> <br>";
//        echo "<td>" . "<a href='edit.php/?idd=$row[id]'>edit</a>"."</td>";
//        echo "<hr>";
//    }
//}


//  <!-- Main Content -->

        echo "<div class='container'>";
        echo "<div class='row'>";
        echo "<div class='col-lg-8 col-md-10 mx-auto'>";
        echo "<div class='post-preview'>";
        echo "<a href='post.php'>";
        echo "<h2 class='post-title'>";

        echo "<div>" . $row['title'] . "</div>";
        echo "</h2>";
        echo "<h3 class='post-subtitle'>";
        echo "<div> <img style='width: 200px; height: 200px;' src='  images/uploads/" . $row['image'] . "  ' alt = '' /></div>";
        echo "<div>" . $row['body'] . "</div>";
        echo "</h3>";
        echo "</a>";
        echo "<p class='post-meta'>" . "<div>" . $row['writer_name'] . "</div>";
//        echo "<a href='#'>Start Bootstrap</a>";
        echo "<div>" . $row['date'] . "</div>";
        echo "</p>";
        echo "</div>";
        echo "<td>" . "<a style='text-decoration: none; color: #0f6674;' href='delete.php/?idd=$row[id]'>delete</a>"."</td> <br>";
//        echo "<td>" . "<a style='text-decoration: none; color: #0f6674;'href='edit.php/?idd=$row[id]'>edit</a>"."</td>";
        echo "<hr>";


//        <!-- Pager -->
        echo "<div class='clearfix'>";
//        echo "<a class='btn btn-primary float-right' href='#'>Older Posts &rarr;</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        echo "<hr>";

    }
}


?>


  <!-- Footer -->
<?php
include "footer.php";
?>
