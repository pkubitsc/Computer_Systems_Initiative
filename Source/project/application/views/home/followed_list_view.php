<?php
function paging($base_url, $pages, $current_page) {
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
        $str .= " <a href=\"".$base_url."index.php/home/followed_users?page=1\">First</a> ";
    }
    for ($i = $page_start; $i <= $page_end; $i++) {
        $str .= " <a href=\"".$base_url."index.php/home/followed_users?page=".$i."\">".$i."</a>&nbsp;";
    }
    if ($page_end != $pages) {
        $str .= " <a href=\"".$base_url."index.php/home/followed_users?page=".$pages."\">Last</a> ";
    }
    
    return $str;
}
$pages = paging($base_url, $num_pages, $current_page);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>HALOC Computer Systems Initiative</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="<?php echo $base_url; ?>css/profile/style.php?url=<?php echo $base_url; ?>" rel="stylesheet" type="text/css" media="screen" />
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
			<ul>
             <li><a href="<?php echo $base_url; ?>index.php/home/followed_users/">Users You are Following</a></li>
             <li><a href="<?php echo $base_url; ?>index.php/home/followed_hashtags/">Hashtags You are Following</a></li>		
            </ul>
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
 
<!-- This is the results of the followed -->
<div class="container">
	   <!-- freshdesignweb top bar -->
      <div class="freshdesignweb-top">
      <div class="clr"></div>
      </div><!--/ freshdesignweb top bar -->       
      <div  class="form">
      <br/> 

<?php
if (isset($users) && !empty($users)) {
?>
      <b>Users You Are Following</b><br /><br />
      <?php foreach ($users as $user) {?>
                            <table><tr>
                            <td><img src="<?php echo $base_url; ?>images/user_images/<?php echo $user['profile_image']; ?>"></img></td>
                            <td><?php echo $user['username']?> (ID: <?php echo $user['id']; ?>)- <a href="<?php echo $base_url;?>index.php/home/view_other_profile/<?php echo $user['id']; ?>">See Profile/Posts</a> - <a href="<?php echo $base_url."index.php/home/unfollow_user/".$user['id']; ?>">Unfollow</a><br />
                            <?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></td>
                            </tr></table><br />
<?php }
} elseif (isset($hashtags) && !empty($hashtags)) {?>
       <b>Hashtags You Are Following</b><br /><br />                     
<?php    foreach ($hashtags as $hashtag) { ?>
      Hashtag: <?php echo $hashtag['hashtag'] ?><br />
                     - <a href="<?php echo $base_url."index.php/home/view_hashtag_profile/".$hashtag['hashtag_id'] ?>">See Posts</a> -  
                    <a href="<?php echo $base_url."index.php/home/unfollow_hashtag/".$hashtag['hashtag_id'] ?>">Unfollow</a><br /><br />
<?php } }?>
      </div>
<br/><br/><br/><br/><br/><br/>
</div>

<div id="footer-bull">
	<div id="footer">
    	<p>
        Made by: Corey Geesey, Paul Kubitschek, Mai Van Pham, Bryce Cooper
        </p>
	</div>
</div> 