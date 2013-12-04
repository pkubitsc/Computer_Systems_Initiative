<?php
if (empty($errors)) {
    $post = array(
            'name'	=> 'post',
            'id'	=> 'post',
            'value'	=> '',
            'maxlength'	=> 200,
            'rows' => 3,
            'columns' => 30
    );
} else {
     $post = array(
            'name'	=> 'post',
            'id'	=> 'post',
            'value'	=> set_value('post'),
            'maxlength'	=> 200,
            'rows' => 3,
            'columns' => 30
    );   
}
function paging($pages, $current_page) {
    $str = "Pages ";
    $temp_str = "";
    if ($pages > 10) {
        // do some hacking...
        if ($current_page-3 > 0) {
            $page_start = $current_page-3;
        } else {
            $page_start = 1;
        }
        
        if ($current_page+3 < $pages) {
            $page_end = $current_page+3;
        } else {
            $page_end = $pages;
        }

    } else {
        $page_start = 1;
        $page_end = $pages;
    }
    
    if ($page_start != 1) {
        $str .= "<a href=\"http://localhost/project/index.php/home/yourposts?page=1\">First</a> ";
    }
    for ($i = $page_start; $i <= $page_end; $i++) {
        $str .= "<a href=\"http://localhost/project/index.php/home/yourposts?page=".$i."\">".$i."</a> ";
    }
    if ($page_end != $pages) {
        $str .= "<a href=\"http://localhost/project/index.php/home/yourposts?page=".$pages."\">Last</a> ";
    }
    
    return $str;
}
$pages = paging($num_pages, $current_page);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>HALOC Computer Systems Initiative</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="<?php echo $base_url; ?>css/otherprofile/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="header-wrapper">
	<div id="header">
		<div id="menu">
			<ul>
				  <li><a href="<?php echo $base_url;?>index.php/home/yourposts/">HomePage</a></li>
				  <li><a href="<?php echo $base_url;?>index.php/auth/change_profile">Profile</a></li>
				  <li><a href="<?php echo $base_url;?>index.php/home/search">Search</a></li>
				  <li><a href="<?php echo $base_url;?>index.php/auth/logout">Logout</a></li>

			</ul>
		</div>
	</div>
</div>
<!-- end #header -->

<!-- end #header-wrapper -->
<div id="logo">
  <h1><a href="#">Haloc </a></h1>
	<p>Computer systems initiative</p>
	<p>&nbsp;</p>
</div>
<div id="header-wrapper">
	<div id="header">
		<div id="menu">

		</div>
	</div>
</div>
<?php 
if (isset($errors)) {
    foreach ($errors as $error_key => $error_value) {
        echo $error_value."<br/>";
    }
}
?>		

<div class="container">
	   <!-- freshdesignweb top bar -->
      <div class="freshdesignweb-top">
      <div class="clr"></div>
      </div><!--/ freshdesignweb top bar -->       
      <div  class="form" style="height: auto;">
      <br/>                  
            <table><tr>
                <?php if (isset($user)) { ?>
                        <td><img src="<?php echo $base_url."images/user_images/original/".$user['profile_image']; ?>"></td>
                        <td>&nbsp;</td>
                        <td><h2 class="title"><?php echo $user['username']; ?></h2><br/>
                        <?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?><br/>
                        <a href="<?php echo $base_url."index.php/home/follow_user/".$user['id']; ?>">Follow</a></td>
                <?php } else if(isset($hashtag)) { ?>
                        <h2 class="title">Hashtag: <?php echo $hashtag['hashtag'] ?></h2><br />
                        <a href="<?php echo $base_url."index.php/home/follow_hashtag/".$hashtag['hashtag_id']; ?>">Follow</a>
                <?php } ?>
            </tr></table><br /><br />
		    </div>
    </div> 

<!-- PAGES -->
<div class="container">
	   <!-- freshdesignweb top bar -->
      <div class="freshdesignweb-top">
      <div class="clr"></div>
      </div><!--/ freshdesignweb top bar -->       
      <div class="form2" style="height: 50px; padding-top: 15px;">
      <br/>                  
	<div class="post">
	<?php echo $pages; ?>&nbsp;
   </div>            
   </div>
</div> 

<?php foreach ($posts as $user_post) { ?>
<div class="container">
	   <!-- freshdesignweb top bar -->
      <div class="freshdesignweb-top">
      <div class="clr"></div>
      </div><!--/ freshdesignweb top bar -->       
      <div  class="form">
      <br/>                  
	<div class="post">
		<h2 class="title">&nbsp;</h2>
			<h2 class="title"><?php if(file_exists('images/user_images/'.$user_post['profile_image'])) { ?>
              <img src="http://localhost/project/images/user_images/<?php echo $user_post['profile_image']; ?>"></img>
              <?php } ?> <a href="<?php echo $base_url;?>index.php/home/view_other_profile/<?php echo $user_post['user_id'];?>"><?php echo $user_post['username'] ?></a></h2> &nbsp;&nbsp;&nbsp;
				<p class="meta">Posted On: <?php echo $user_post['created'] ?></p>
				<div class="entry">
					<p><?php echo $user_post['post_content']?></p>
                    
				 <a href="<?php echo $base_url; ?>index.php/home/see_replies/<?php echo $user_post['post_id'];?> "> Comments (<?php echo $user_post['post_replies']; ?>)</a> &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;
                  <?php if ($user_post['is_liked'] > 0) { ?>
                    			 <a href="http://localhost/project/index.php/home/likepost/<?php echo $user_post['post_id']; ?>"/>Dislike</a>
	                    <?php } else { ?>
    			               <a href="http://localhost/project/index.php/home/likepost/<?php echo $user_post['post_id']; ?>"/>Like</a>
                    <?php } ?>
                    &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo $user_post['post_likes']; ?> &nbsp;Likes
			    </div>
		    </div>
    </div>
</div>          
 <?php } ?>
<br/>

<!-- PAGES -->
<div class="container">
	   <!-- freshdesignweb top bar -->
      <div class="freshdesignweb-top">
      <div class="clr"></div>
      </div><!--/ freshdesignweb top bar -->       
      <div class="form2" style="height: 50px; padding-top: 15px;">
      <br/>                  
	<div class="post">
	<?php echo $pages; ?>&nbsp;
   </div>            
   </div>
</div> 

       

<div id="footer-bull">
	<div id="footer">
    	<p>
        Made by: Corey Geesey, Paul Kubitschek, Mai Van Pham, Bryce Cooper
        </p>
	</div>
</div> 