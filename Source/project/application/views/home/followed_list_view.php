<?php include_once(__DIR__."/header.php"); ?>
<?php 
if (isset($errors)) {
    foreach ($errors as $error_key => $error_value) {
        echo $error_value."<br/>";
    }
}
?>		
 
<!-- PAGES -->
<div id="pages0"></div>

<!-- This is the results of the followed -->       
<div class="form">
        <?php if (isset($users) && !empty($users)) { ?>
                <b>Users You Are Following</b><br /><br />
                <?php foreach ($users as $user) {?>
                                    <table><tr>
                                    <td><img src="<?php echo $base_url; ?>images/user_images/<?php echo $user['profile_image']; ?>"></img></td>
                                    <td><?php echo $user['username']?> (ID: <?php echo $user['id']; ?>)- <a href="<?php echo $base_url;?>index.php/home/view_other_profile/<?php echo $user['id']; ?>">See Profile/Posts</a> - <a href="<?php echo $base_url."index.php/home/unfollow_user/".$user['id']; ?>">Unfollow</a><br />
                                    <?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></td>
                                    </tr></table><br />
                <?php } ?>

        <?php } elseif (isset($hashtags) && !empty($hashtags)) {?>
                <b>Hashtags You Are Following</b><br /><br />                     
                <?php foreach ($hashtags as $hashtag) { ?>
                        Hashtag: <?php echo $hashtag['hashtag'] ?><br />
                        - <a href="<?php echo $base_url."index.php/home/view_hashtag_profile/".$hashtag['hashtag_id'] ?>">See Posts</a> -  
                        <a href="<?php echo $base_url."index.php/home/unfollow_hashtag/".$hashtag['hashtag_id'] ?>">Unfollow</a><br /><br />
                <?php } ?>
        <?php } ?>
</div>

<!-- PAGES -->
<div id="pages0"></div>

  <br/><br/><br/><br/><br/><br/>

<!-- FOOTER -->
<?php include_once(__DIR__."/footer.php"); ?>