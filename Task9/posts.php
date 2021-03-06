<?php
require_once('config.php');
require_once(BASE_PATH . '/logic/posts.php');
require_once(BASE_PATH . '/logic/categories.php');
$category_id = isset($_REQUEST['category_id']) ? $_REQUEST['category_id'] : null;
$tag_id = isset($_REQUEST['tag_id']) ? $_REQUEST['tag_id'] : null;
$q = isset($_REQUEST['q']) ? $_REQUEST['q'] : null;
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
$page_size = 6;


//if (isset ($_GET['q'])) {   
//$q= $_GET['q'];}



if (!isset ($_GET['offset'])) {   
$offset= 1;
}
else {
	$offset=$_GET['offset'];
}
//ECHO $offset;
$posts = getPosts($page_size, $offset, $category_id, $tag_id, null, $q );


?>
<?php require_once('layout/header.php'); ?>
<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="heading-page header-text">
    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-content">
                        <h4>Recent Posts</h4>
                        <h2>Our Recent Blog Entries</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Banner Ends Here -->
<section class="blog-posts">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sidebar-item search">
                    <form id="search_form" name="gs" method="GET" action="<?= BASE_URL . '/posts.php' ?>">
                        <input type="text" value="<?= isset($_REQUEST['q']) ? $_REQUEST['q'] : '' ?>" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="all-blog-posts">
                    <div class="row">
                        <?php
                        foreach ($posts as $post) {
                        ?>
                            <div class="col-lg-6">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="<?= BASE_URL . $post['image'] ?>" alt="">
                                    </div>
                                    <div class="down-content">
                                        <span><?= $post['category_name'] ?></span>
                                        <a href="<?= BASE_URL . '/post-details.php?id=' . $post['id'] ?>">
                                            <h4><?= $post['title'] ?></h4>
                                        </a>
                                        <ul class="post-info">
                                            <li><a href="#"><?= $post['user_name'] ?></a></li>
                                            <li><a href="#"><?= $post['publish_date'] ?></a></li>
                                            <li><a href="#"><?= $post['comments'] ?> Comments</a></li>
                                        </ul>
                                        <p><?= $post['content'] ?></p>
                                        <?php
                                        if ($post['tags']) {
                                        ?>
                                            <div class="post-options">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <ul class="post-tags">
                                                            <li><i class="fa fa-tags"></i></li>
                                                            <?php
                                                            foreach ($post['tags'] as $tag) {
                                                            ?>
                                                                <li><a href="#"><?= $tag['name'] ?></a></li>
                                                            <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>


 <div class="col-lg-12">
                  <ul class="page-numbers">
				  <?php 
				  
				  
				  $PagingTotalPostsCountx = PagingTotalPostsCount($category_id = null, $tag_id = null, $user_id = null, $q = null);
$pagingcountArray = getRow($PagingTotalPostsCountx);

foreach ($pagingcountArray as $value) {
   $MyPagingcounter =$value;
}
//echo $MyPagingcounter;

$numberOfPages=  (int)((($MyPagingcounter -1)/6) +1);
$flag;
				  for ( $i = 0; $i < $numberOfPages ; $i++)
				  {
					  $hrefstring = "posts.php?offset=" .($i+1)  ;
					  if ($offset == $i+1)
					  {$classString=  "active";}
						else {$classString=  "";}
						//$hrefForArrow = "posts.php?offset=" .($i+1)  ;
						
				  ?>
                    <li class= <?php echo '"' .$classString .'"'  ?>  ><a href= <?php  echo '"' .$hrefstring .'"'  ?> > <?php  echo $i+1   ?> <?php if ($offset < $numberOfPages) {$flag = $offset +1 ;} else { $flag = $offset;}  ?> </a></li>
					
					<?php
				  }
					?>
					
                    <li><a href=<?php  echo '"' ."posts.php?offset=" .$flag .'"'  ?>><i class="fa fa-angle-double-right"></i></a></li>
                  </ul>
                </div>
				
				
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once('layout/footer.php') ?>