<?php
if (isset($_GET['search'])) {
    $search_var = $_GET['search'];
} else {
    $search_var = '';
}
    $search = array(
            'name'	=> 'search',
            'id'	=> 'search',
            'value'	=> $search_var,
            'maxlength'	=> 200
    );
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>HALOC Computer Systems Initiative</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="../../css/search/style.css" rel="stylesheet" type="text/css" media="all" />
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
    
<?php if (isset($errors)) {
        foreach ($errors AS $key => $value) { ?>
                <br/><?php echo $value; ?>
<?php   }
} ?>
<div class="container">
			<!-- freshdesignweb top bar -->
            <div class="freshdesignweb-top">
              <div class="clr"></div>
            </div><!--/ freshdesignweb top bar -->       
      <div  class="form">
            	<br/>                  
                  <?php echo form_open('home/search/', array('method' => 'get')); ?>
					<?php echo form_label('Search', $search['id']); ?>
                	<?php echo form_input($search); ?>
					<?php echo form_error($search['name']); ?>     
                   
        <p>
        <?php echo form_submit('submit', 'Submit'); ?>
        </p>
        <br/><br/><br/><br/><br/>
       </div>
<?php echo form_close(); ?>
</div>

<!--This is the results by # -->
<div class="container">
	   <!-- freshdesignweb top bar -->
      <div class="freshdesignweb-top">
      <div class="clr"></div>
      </div><!--/ freshdesignweb top bar -->       
      <div  class="form">
      <br/>                  
		<?php if (!empty($hashtag_results)) {
   				foreach ($hashtag_results as $hashtag) { ?>
                    Hashtag: <?php echo $hashtag['hashtag'] ?>
                    <a href="<?php echo $base_url."index.php/home/view_hashtag/".$hashtag['hashtag_id'] ?>">See Posts</a>  
                    <a href="<?php echo $base_url."index.php/home/follow_hashtag/".$hashtag['hashtag_id'] ?>">Follow</a>
                <?php }
		} else {?>
           No results
		<?php }?>
      </div>
<?php echo form_close(); ?>
</div>
<!-- This is the results on PEOPLE on the search page -->
<div class="container">
	   <!-- freshdesignweb top bar -->
      <div class="freshdesignweb-top">
      <div class="clr"></div>
      </div><!--/ freshdesignweb top bar -->       
      <div  class="form">
      <br/>      
             
<?php if (!empty($user_results)) {
    foreach ($user_results as $user) {
        if ($user['id'] != $logged_in_user_id) { ?>
        		<?php if(file_exists('images/user_images/'.$user['profile_image'])) { ?>
              		<img src="http://localhost/project/images/user_images/<?php echo $user['profile_image']; ?>"></img>
              	<?php } ?></td>
				<?php echo $user['username']?> - <a href="home/view_profile/<?php echo $user['id']; ?>">See Profile/Posts</a> - <a href="<?php echo $base_url."index.php/home/follow_user/".$user['id']; ?>">Follow</a><br />
              <?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?>
				<?php } }
		} else {?>
            No results
		<?php }?>
      </div>
<?php echo form_close(); ?>
<br/><br/><br/><br/><br/><br/>
</div>


<!--BELOW IS DUPLICATE CODE THAT IS NOT NECESSARY -->


<!-- SEARCHING
<?php echo form_open('home/search/', array('method' => 'get')); ?>
<table>
	<tr>
		<td><?php echo form_label('Search', $search['id']); ?></td>
                <td><?php echo form_input($search); ?></td>
		<td style="color: red;"><?php echo form_error($search['name']); ?></td>
	</tr>
</table>
<?php echo form_submit('submit', 'Submit'); ?>
<?php echo form_close(); ?>
<br />
<br/>  -->


<!--
<p>Hashtag Results:</p>
<table border="1" width="800">
<?php if (!empty($hashtag_results)) {
    foreach ($hashtag_results as $hashtag) { ?>

        <tr>
		<td width="100">Hashtag: <?php echo $hashtag['hashtag'] ?></td>
                <td><a href="<?php echo $base_url."index.php/home/view_hashtag/".$hashtag['hashtag_id'] ?>">See Posts</a> - 
                <a href="<?php echo $base_url."index.php/home/follow_hashtag/".$hashtag['hashtag_id'] ?>">Follow</a></td>
        </tr>
<?php }
} else {?>
            No results
<?php }?>
</table>
<br/>
<br/>
-->
<!--
<p>User Results:</p>
<table border="1" width="800">
<?php if (!empty($user_results)) {
    foreach ($user_results as $user) {
        if ($user['id'] != $logged_in_user_id) { ?>
        <tr>
                <td><?php if(file_exists('images/user_images/'.$user['profile_image'])) { ?>
                        <img src="http://localhost/project/images/user_images/<?php echo $user['profile_image']; ?>"></img>
                <?php } ?></td>
		<td><?php echo $user['username']?> - <a href="home/view_profile/<?php echo $user['id']; ?>">See Profile/Posts</a> - <a href="<?php echo $base_url."index.php/home/follow_user/".$user['id']; ?>">Follow</a><br />
                    <?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></td>
	</tr>
<?php } }
} else {?>
            No results
<?php }?>
-->