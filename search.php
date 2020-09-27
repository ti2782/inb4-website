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
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exactCheck">
    <label class="form-check-label" for="exactCheck">Exact Match</label>
  </div>
    &nbsp;  
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
         $search = $_GET['search'];
     if(isset($_GET['page']))
        $page = $_GET['page'];
     else
        $page = 1;
     if(isset($_GET['exact']))
         $exact = true;
     else
         $exact = false;

	require 'vendor/autoload.php';

    
	$coll = (new MongoDB\Client())->inb4->posts;
	$threadcoll = (new MongoDB\Client())->inb4->threads;
    if($exact) {
        $cursor = $coll->find(array('$text' => array('$search' => '"'.$search.'"')));    
        $pageNum = ceil(iterator_count($cursor) / 32);
        $cursor = $coll->find(array('$text' => array('$search' => '"'.$search.'"')), array('sort' => array('timestamp'=>-1)));
    }
    else {        
        $cursor = $coll->find(array('$text' => array('$search' => $search)));
        $pageNum = ceil(iterator_count($cursor) / 32);
        $cursor = $coll->find(array('$text' => array('$search' => $search)));
    }
    $iterator = new IteratorIterator($cursor);
    $iterator->rewind();
    
    if($page > 1) {
        $toskip = ($page - 1) * 32;
        for($i = 0; $i < $toskip; $i++)
            $iterator->next();
    }

	$count = 0;
	echo '<div class="container">
	     <div class="row row-no-gutters">';	 
    while ( $iterator->valid() ) {

            $document = $iterator->current();
            $post = $document->post;
            $thread = $document->thread;
		
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
            if($count >= 32)
                break;
        
            $iterator->next();
    }    
	
	if($count % 4 != 0)
	   echo '</div>'; // ROW

	echo '</div><br><br>'; // CONTAINER

    var_dump($count);
    
    if($pageNum > 1)
    {
        echo '<nav aria-label="Pagination">
               <ul class="pagination justify-content-center">';

        if($exact) {
            echo '<li class="page-item">
                <a class="page-link" href="?page=1&search='.$search.'&exact=true">First</a></li>';                
            }
        else {            
            echo '<li class="page-item">
                <a class="page-link" href="?page=1&search='.$search.'">First</a></li>';
        }

        $maxpage = $page + 5;
        $prevpage = $page - 1;
        $nextpage = $page + 1;
        if($prevpage >= 1) {
           if($exact) {
               echo '<li class="page-item"><a class="page-link" href="?page='.$prevpage.'&search='.$search.'&exact=true">Previous</a></li>';
           }
           else {
               echo '<li class="page-item"><a class="page-link" href="?page='.$prevpage.'&search='.$search.'">Previous</a></li>';
           }
        }
        
        for($i = $page + 1; $i <= $pageNum; $i++)
        {
            if($i >= $maxpage)
                break;
            if($exact) {
                echo '<li class="page-item"><a class="page-link" href="?page='.$i.'&search='.$search.'&exact=true">'.$i.'</a></li>';
            }
            else {
                echo '<li class="page-item"><a class="page-link" href="?page='.$i.'&search='.$search.'">'.$i.'</a></li>';                
            }
        }
       
        if($nextpage <= $pageNum) {
            if($exact) {
                 echo '<li class="page-item"><a class="page-link" href="?page='.$nextpage.'&search='.$search.'&exact=true">Next</a></li>';
            }
            else {
                 echo '<li class="page-item"><a class="page-link" href="?page='.$nextpage.'&search='.$search.'">Next</a></li>';
            }
        }
        if($exact) {
           echo '<li class="page-item">
              <a class="page-link" href="?page='.$pageNum.'&search='.$search.'&exact=true">Last</a></li>';
        }
        else {
           echo '<li class="page-item">
              <a class="page-link" href="?page='.$pageNum.'&search='.$search.'">Last</a></li>';
        }
        echo '</ul> </nav>';
            
    }
     }
    ?>
    <!-- Scripts -->
    <script src="scripts/search.js"></script> 
  </body>
</html>
