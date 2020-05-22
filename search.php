<!DOCTYPE html>
<html lang="en">
  <head>    
    <!--  Meta  -->
    <meta charset="UTF-8" />
    <title>SEARCH</title>

    <!--  Styles  -->
    <link rel="stylesheet" href="styles/main.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <nav class="navbar navbar-dark bg-dark">
      <!-- Navbar content -->
      <a class="navbar-brand" href='https://inb4sauce.net'>INB4SAUCE</a>
      <form class="form-inline">
        <a class="navbar-brand" href='https://paulfurber.net/bda/index.html'>BDANON</a>
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

    <!-- MONGODB -->
    <?php
      if(isset($_GET['search'])) {
     	$search = '"'.$_GET['search'].'"';
	require 'vendor/autoload.php';

	$coll = (new MongoDB\Client())->inb4->posts;
	$threadcoll = (new MongoDB\Client())->inb4->threads;
	$cursor = $coll->find(array('$text' => array('$search' => $search)));

	$count = 0;
	echo '<div class="container">
	     <div class="row row-no-gutters">';	 
	     
	foreach($cursor as $document) {
		$post = $document[post];
		$thread = $document[thread];
		
		$threadele = $threadcoll->findOne(array('thread' => $thread));
		$title = $threadele['title'];
		$src = $threadele['thumbnail'];
		$thumb = '<img class="card-img-top" src="'.($src).'">';

		$link = '<a href="https://archive.4plebs.org/pol/thread/'.($thread).'/#q'.($post).'" ';
		
	 	if($count % 4 == 0 && $count != 0) {
			   echo '</div><br><br><div class="row row-no-gutters">';
		}
		
		echo '<div class="col-sm-3">
		<div class="card bg-dark text-white">'.($thumb).'
		<div class="card-body">
		<h4 class="card-title">'.($title).'</h4>
		<p class="card-text">';
		echo $document['txt'] . '</p></div><br>';
		echo $link . '
		class="btn btn-primary">View Post</a>
		 </div></div>';
		
		++$count;
	}
	
	if($count % 4 != 0)
	   echo '</div>'; // ROW
	   
	echo '</div>'; // CONTAINER
      }
    ?>
    <!-- Scripts -->
    <script src="scripts/search.js"></script> 
  </body>
</html>
