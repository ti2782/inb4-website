<!DOCTYPE html>
<html lang="en">
  <head>    
    <!--  Meta  -->
    <meta charset="UTF-8" />
    <title>INB4SAUCE MARKERS</title>

    <!--  Styles  -->
    <link rel="stylesheet" href="styles/main.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <nav class="navbar navbar-dark bg-dark">
      <!-- Navbar content -->      
      <a class="navbar-brand" href='https://inb4sauce.net'>INB4SAUCE</a>
      <form class="form-inline">
        <a class="navbar-brand" href='https://inb4sauce.net/posts.php'>POSTS</a>
        <a class="navbar-brand" href='https://inb4sauce.net/markers.php'>MARKERS</a>
	<input class="form-control mr-sm-2" type="search" id="search-text" placeholder="Search" aria-label="Search">
	<button class="btn btn-outline-success my-2 my-sm-0" id="search-button" type="submit" onClick="javascript:searchButton()">Search</button>
      </form>      
    </nav>
  </head>
  <body>
    
    <div class="alert alert-dark" role="alert">
      NEVER WRONG. Ahead of schedule. Below budget. Anon delivers. Always.
    </div>

    <?php
     require 'utils.php';
     include("markers.html");
     getFooter();
    ?>
    <!-- Scripts -->
    <script src="scripts/search.js"></script> 
  </body>
</html>