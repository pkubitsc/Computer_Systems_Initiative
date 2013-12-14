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
            'maxlength'	=> 200,
            'rows'      => 3
    );
?>
<!-- HEADER -->
<?php include_once(__DIR__."/header.php"); ?>

<?php if (isset($errors)) {
        foreach ($errors AS $key => $value) { ?>
                <br/><?php echo $value; ?>
<?php   }
} ?>
                
                
<div class="form" style="position:relative; top:50%; height:70px; margin-top:25px;">
      <br/>      
                  
	<?php echo form_open('home/search/', array('method' => 'get')); ?>
            <div style="float: left; padding-top: 10px; padding-left: 0px;">
                        <?php echo form_label('Search', $search['id']); ?>
            </div>
            <div style="float: left; padding-top: 0px; padding-left: 100px;">
                    <?php echo form_input($search); ?>
            </div>
            <div style="float: left; padding-top: 0px; padding-left: 30px;">
                    <?php echo form_submit('submit', 'Submit'); ?>
            </div>
                <?php echo form_error($search['name']); ?> 
        <?php echo form_close(); ?>
</div>                

<!-- PAGES -->
<div id="pages0"></div>

<!--This is the results by # -->
<div class="container">
	   <!-- freshdesignweb top bar -->
      <div class="freshdesignweb-top">
      <div class="clr"></div>
      </div><!--/ freshdesignweb top bar -->       
      <div  class="form">
      <br/>   <b>Hashtag Results:</b><br /><br />               
		<?php if (!empty($hashtag_results)) {
   				foreach ($hashtag_results as $hashtag) { ?>
                    Hashtag: <?php echo $hashtag['hashtag'] ?><br />
                     - <a href="<?php echo $base_url."index.php/home/view_hashtag_profile/".$hashtag['hashtag_id'] ?>">See Posts</a>
                     <?php if(!$hashtag['is_followed']) { ?>
                                <a href="<?php echo $base_url."index.php/home/follow_hashtag/".$hashtag['hashtag_id'] ?>">Follow</a>
                     <?php } ?>
                     <br /><br />
                <?php }
		} else {?>
           No results<br /><br />
		<?php }?>
      </div>
</div>

<!-- PAGES -->
<div id="pages1"></div>

<!-- This is the results on PEOPLE on the search page -->
<div class="container">
	   <!-- freshdesignweb top bar -->
      <div class="freshdesignweb-top">
      <div class="clr"></div>
      </div><!--/ freshdesignweb top bar -->       
      <div  class="form">
      <br/>    <b>User Results:</b><br /><br />  
            
            <?php if (!empty($user_results)) {
                foreach ($user_results as $user) {
                    if ($user['id'] != $logged_in_user_id) { ?>
                            <table><tr>
                            <td><img src="<?php echo $base_url."images/user_images/".$user['profile_image']; ?>"></img></td>
                            <td><?php echo $user['username']?> (ID: <?php echo $user['id']; ?>)- <a href="<?php echo $base_url;?>index.php/home/view_other_profile/<?php echo $user['id']; ?>">See Profile/Posts</a>
                                <?php if ($user['is_followed'] == 0) { ?>
                                    - <a href="<?php echo $base_url."index.php/home/follow_user/".$user['id']; ?>">Follow</a><br />
                                <?php } ?>
                            <?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></td>
                            </tr></table><br />
            <?php } }
            } else {?>
                            No results<br /><br />
            <?php }?>
      </div>
</div>

<!-- PAGES -->
<div id="pages0"></div>

<!-- FOOTER -->
<?php include_once(__DIR__."/footer.php"); ?>