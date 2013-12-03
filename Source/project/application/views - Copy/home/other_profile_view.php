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

- <a href="<?php echo $base_url; ?>index.php/home/yourposts/">Home</a>
- <a href="<?php echo $base_url; ?>index.php/auth/change_profile">Your Profile</a>
- <a href="<?php echo $base_url; ?>index.php/home/search/">Search</a>
- <a href="<?php echo $base_url; ?>index.php/auth/logout">Logout</a> -

<?php if (isset($errors)) {
    foreach ($errors AS $key => $value) {
        echo $value;
    }
}?>

<br/><br /><br />
<?php if (isset($user)) { ?>
        <img src="<?php echo $base_url."images/user_images/original/".$user['profile_image']; ?>">
        <br />
        <?php echo $user['username']; ?><br/>
        <?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?><br/>
        <a href="<?php echo $base_url."index.php/home/follow_user/".$user['id']; ?>">Follow</a>
<?php } else if(isset($hashtag)) { ?>
        Hashtag: <?php echo $hashtag['hashtag'] ?><br />
        <a href="<?php echo $base_url."index.php/home/follow_hashtag/".$hashtag['hashtag_id']; ?>">Follow</a>
<?php } ?>
<br/><br/>
<?php echo $pages; ?>

<table border="1" width="800">
<?php foreach ($posts as $user_post) { ?>

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
                    - <a href="<?php echo $base_url; ?>index.php/home/see_replies/<?php echo $user_post['post_id'];?>"/>See Replies/Reply</a></td>
        </tr>
        <tr>
<?php } ?>
</table>

<br/>
<?php echo $pages ?>