<!DOCTYPE html>
<html lang="en">
   <?php
      require(__DIR__ . '/../../utils.php');
      include("../../markers-header.html");
?>
  <body>
    
    <div class="alert alert-dark" role="alert">
    Famine. Plague. War. Death.
    </div>

    <!-- INCLUDE PAGE -->
    <?php
     $lastpage = file_get_contents("html/last_page.txt");

     if(isset($_GET['pages'])) {
     $page = $_GET['pages'];
     include("html/$page.html");
     echo "<br><br>";
    getPages($lastpage, $page);
    }
    else {
    include("html/$lastpage.html");
    echo "<br><br>";
    getPages($lastpage, $lastpage);
    }
    getFooter();
    ?>
    <!-- Scripts -->
    <script src="../../scripts/search.js"></script> 
  </body>
</html>
