<?php
$post = array(
	'name'	=> 'post',
	'id'	=> 'post',
	'value'	=> set_value('post'),
	'maxlength'	=> 200,
        'rows' => 3,
        'columns' => 30,
);

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
	
    $str.= "<div class=\"entry\"> <p class='links'>";
    if ($page_start != 1) {
        $str .= "<a href=\"http://localhost/project/index.php/home/yourposts/".$i."\">First</a> ";
    }
    for ($i = $page_start; $i <= $page_end; $i++) {
        $str .= "<a href=\"http://localhost/project/index.php/home/yourposts/".$i."\">".$i."</a> ";
    }
    if ($page_end != $pages) {
        $str .= "<a href=\"http://localhost/project/index.php/home/yourposts/".$pages."\">Last</a>";
    }
    $str .="</p></div>";
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
<link href="<?php echo $base_url; ?>css/home/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="header-wrapper">
	<div id="header">
		<div id="menu">
			<ul>
				<ul>
				  <li><a href="#">HomePage</a></li>
				  <li><a href="#">Profile</a></li>
				  <li><a href="#">Search</a></li>
				  <li><a href="<?php echo $base_url;?>index.php/auth/logout">Logout</a></li>
			</ul>
		</div>
		<!-- end #menu -->
	<!--	<div id="search">
			<form method="get" action="">
				<fieldset>
				<input type="text" name="s" id="search-text" size="15" />
				<input type="submit" id="search-submit" value="GO" />
				</fieldset>
			</form>
		</div>
        -->
		<!-- end #search -->
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
             <li><a href="#">Your Hoots</a></li>
             <li><a href="#">Top Hoots</a></li>
             <li><a href="#">Followed</a></li>		
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
<div id="wrapper">
	<div id="page">
		<div id="page-bgtop">
        </div>
	<hr />
		
<?php echo form_open('home/addpost/'); ?>
<table>
	<tr>
		<td><?php echo form_label('Post Something', $post['id']); ?></td>
                <td><?php echo form_textarea($post); ?></td>
		<td style="color: red;"><?php echo form_error($post['name']); ?></td>
	</tr>
</table>
<?php echo form_submit('submit', 'Submit'); ?>
<?php echo form_close(); ?>

<br/>
<?php echo $pages ?>

<table border="1" width="800">
<?php foreach ($posts as $user_post) { ?>
			<div class="post">
				<h2 class="title">&nbsp;</h2>
				<h2 class="title"><?php if(file_exists('images/user_images/'.$user_post['profile_image'])) { ?>
              <img src="http://localhost/project/images/user_images/<?php echo $user_post['profile_image']; ?>"></img>
              <?php } ?> <?php echo $user_post['username'] ?></h2> &nbsp;&nbsp;&nbsp;
				<p class="meta">Posted On: <?php echo $user_post['created'] ?></p>
				<div class="entry">
					<p><?php echo $user_post['post_content']?></p>
					<p class="links"><a href="#">Read More</a> &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp; <a href="#">Comments</a></p>
			    </div>
		    </div>
        <tr>
		<td width="100"><?php echo $user_post['username'] ?></td>
                <td>Posted On: <?php echo $user_post['created'] ?></td>
        </tr>
        <tr>
                <td><?php if(file_exists('images/user_images/'.$user_post['profile_image'])) { ?>
                        <img src="http://localhost/project/images/user_images/<?php echo $user_post['profile_image']; ?>"></img>
                <?php } ?></td>
		<td><?php echo $user_post['post_content']?></td>
	</tr>
        <tr>
		<td width="100"> </td>
                <td textalign="center">
                    <?php if ($user_post['is_liked'] > 0) { ?>
                        <a href="http://localhost/project/index.php/home/likepost/<?php echo $user_post['post_id']; ?>"/>Dislike</a>
                    <?php } else { ?>
                        <a href="http://localhost/project/index.php/home/likepost/<?php echo $user_post['post_id']; ?>"/>Like</a>
                    <?php } ?>
                    - <a href=""/>Reply</a> - <a href=""/>See Replies</a></td>
        </tr>
        <tr>
<?php } ?>
</table>

<br/>
<?php echo $pages ?>