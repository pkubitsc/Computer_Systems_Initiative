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
function paging($pages, $current_page, $followed = null) {
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
    
    if (isset($followed)) {
        $url = "followed";
    } else {
        $url = "yourposts";
    }
    
    if ($page_start != 1) {
        $str .= "<a href=\"http://localhost/project/index.php/home/".$url."yourposts?page=1\">First</a> ";
    }
    for ($i = $page_start; $i <= $page_end; $i++) {
        $str .= "<a href=\"http://localhost/project/index.php/home/".$url."?page=".$i."\">".$i."</a> ";
    }
    if ($page_end != $pages) {
        $str .= "<a href=\"http://localhost/project/index.php/home/".$url."?page=".$pages."\">Last</a> ";
    }
    
    return $str;
}
if (isset($followed)) {
    $pages = paging($num_pages, $current_page, $followed);
} else {
    $pages = paging($num_pages, $current_page);
}
?>
 
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>HALOC Computer Systems Initiative</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="<?php echo $base_url; ?>css/home/style.css" rel="stylesheet" type="text/css" media="screen" />
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

<?php if (!isset($parent_post)) { ?>
<div id="header-wrapper">
	<div id="header">
		<div id="menu">
         <ul>
		   	<li><a href="<?php echo $base_url; ?>index.php/home/yourposts/">Your Hoots</a></li>
			<li><a href="<?php echo $base_url; ?>index.php/home/followed/">Followed Users/Hashtags</a></li>
         </ul>
		</div>
	</div>
</div>
<?php } else { ?>
<!-- Parent Post SECTION -->   
<div class="container">
	   <!-- freshdesignweb top bar -->
      <div class="freshdesignweb-top">
      <div class="clr"></div>
      </div><!--/ freshdesignweb top bar -->       
      <div class="form">
      <br/>                  
	<div class="post">
		<h2 class="title">Original Post</h2>
			<h2 class="title"><?php if(file_exists('images/user_images/'.$parent_post['profile_image'])) { ?>
              	<img src="http://localhost/project/images/user_images/<?php echo $parent_post['profile_image']; ?>"></img>
              	<?php } ?> 
			  	<?php echo $parent_post['username'] ?></h2> &nbsp;&nbsp;&nbsp;
				<p class="meta">Posted On: <?php echo $parent_post['created'] ?></p>
				<div class="entry">
					<p><?php echo $parent_post['post_content']?></p>
                  
                  <?php if ($parent_post['is_liked'] > 0) { ?>
                    			 <a href="http://localhost/project/index.php/home/likepost/<?php echo $parent_post['post_id']; ?>"/>Dislike</a>
	                    <?php } else { ?>
    			               <a href="http://localhost/project/index.php/home/likepost/<?php echo $parent_post['post_id']; ?>"/>Like</a>
                    <?php } ?>
                    &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo $parent_post['post_likes']; ?> &nbsp;Likes
			    </div>
		    </div>
    </div>
</div>          
 <?php } ?>
<br/>

<?php 
if (isset($errors)) {
    foreach ($errors as $error_key => $error_value) {
        echo $error_value."<br/>";
    }
} 
?>		
<div id="wrapper">
	<div id="page">
		<div id="page-bgtop">
        </div>
	<hr/>
<!-- ADD POST SECTION -->    
<div class="container">
	   <!-- freshdesignweb top bar -->
      <div class="freshdesignweb-top">
      <div class="clr"></div>
      </div><!--/ freshdesignweb top bar -->       
      <div class="form2">
      <br/>      
                  
		<?php
                    if (!isset($parent_post)) {
                        echo form_open('home/addpost/');
                    } else {
                        echo form_open('home/addpost/'.$parent_post['post_id']);
                    }
                ?>
        <table>
            <tr>
                <td><?php echo form_label('Reply', $post['id']); ?></td>
                        <td><?php echo form_textarea($post); ?></td>
                <td style="color: red;"><?php echo form_error($post['name']); ?></td>
            </tr>
        </table>
        <?php echo form_submit('submit', 'Submit'); ?>
        <?php echo form_close(); ?>
        

      </div>
	
</div>	
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

<div class="container">
	   <!-- freshdesignweb top bar -->
      <div class="freshdesignweb-top">
      <div class="clr"></div>
      </div><!--/ freshdesignweb top bar -->       
      <div class="form2" style="height: 50px; padding-top: 15px;">
      <br/>                  
	<div class="post">
	<?php echo $pages; ?> &nbsp;
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