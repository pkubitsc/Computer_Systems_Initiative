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
?>

<?php include_once(__DIR__."/header.php"); ?>

<?php 
if (isset($errors)) {
    foreach ($errors as $error_key => $error_value) {
        echo $error_value."<br/>";
    }
}
?>		

<div class="container">       
        <div  class="form">                
            <table><tr>
                <?php if (isset($user)) { ?>
                        <td><img src="<?php echo $base_url."images/user_images/original/".$user['profile_image']; ?>"></td>
                        <td>&nbsp;</td>
                        <td><h2 class="title"><?php echo $user['username']; ?></h2><br/>
                        <?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?><br/>
                        <a href="<?php echo $base_url."index.php/home/follow_user/".$user['id']; ?>">Follow</a></td>
                <?php } elseif(isset($hashtag)) { ?>
                        <h2 class="title">Hashtag: <?php echo $hashtag['hashtag'] ?></h2><br />
                        <a href="<?php echo $base_url."index.php/home/follow_hashtag/".$hashtag['hashtag_id']; ?>">Follow</a>
                <?php } ?>
            </tr></table>
        </div>
</div> 

<!-- PAGES -->
<div id="pages0"></div>         

<!-- POSTS -->
<div id="posts"></div>

<!-- PAGES -->
<div id="pages1"></div>           
<br /><br />       

<!-- FOOTER -->
<?php include_once(__DIR__."/footer.php"); ?>