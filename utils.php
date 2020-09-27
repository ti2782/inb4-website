<?php

 function getPages($lastpage, $currentpage) {    

 $p1 = $currentpage - 1;   
 $p2 = $currentpage - 2;
 $p3 = $currentpage - 3;
 
 echo '<nav aria-label="Pagination">
<ul class="pagination justify-content-center">';
  if($currentpage != $lastpage)
  {
  $prevPage = $currentpage + 1;
  
  echo '<li class="page-item">    
    <a class="page-link" href="?pages='.$lastpage.'" tabindex="$prevpage">First</a>
  </li>
  <li class="page-item">    
    <a class="page-link" href="?pages='.$prevPage.'" tabindex="$prevpage">Previous</a>
';
  }
  if($currentpage > 1) { 
  echo '<li class="page-item"><a class="page-link" href="?pages='.$p1.'">'.$p1.'</a></li>';
  }
  if($currentpage > 2) {
  echo '<li class="page-item"><a class="page-link" href="?pages='.$p2.'">'.$p2.'</a></li>';
  }
  if($currentpage > 3) {        
  echo '<li class="page-item"><a class="page-link" href="?pages='.$p3.'">'.$p3.'</a></li>';
  }
  if($currentpage > 1) {
  echo '<li class="page-item">
    <a class="page-link" href="?pages='.$p1.'">Next</a>
  </li>
  <li class="page-item">
    <a class="page-link" href="?pages=1">Last</a>
  </li>';
  }
  echo '</ul>
</nav>';
}


function getFooter() {
$update = file_get_contents("html/last_updated.txt");
echo '<div><a href="https://t.me/inb4sauce" class="fa fa-telegram"></a><a href="https://twitter.com/Inb4Sauce" class="fa fa-twitter"></a><a href="https://github.com/ti2782" class="fa fa-github"></a></div>';
echo '<div class="alert alert-dark" role="alert">
  <p align="left"><small><b>LAST UPDATED @ '.$update.'<b></small></p><p align="left"><small> Help maintaining this site. Funds are NOT used for terrorist activity. Pinky swear. XMR: 8BWiSZbB32cDDrPvFwWsrxfdVvL2vBxbv3UWNxoLufqS3QpAiUSviTFSJBenMWk6joj9xcrrCT5hsNKUVv5ZEC1XUjaZpQZ</small></p></div></a>';
}

?>
