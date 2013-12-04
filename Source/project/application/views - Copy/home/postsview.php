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

- <a href="<?php echo $base_url; ?>index.php/home/yourposts/">Home</a>
- <a href="<?php echo $base_url; ?>index.php/auth/change_profile">Your Profile</a>
- <a href="<?php echo $base_url; ?>index.php/home/search/">Search</a>
- <a href="<?php echo $base_url; ?>index.php/auth/logout">Logout</a> -

<?php
if (!isset($parent_post)) {
    echo form_open('home/addpost/');
} else {
    echo form_open('home/addpost/'.$parent_post['post_id']);
}
?>
<table>
	<tr>
		<td><?php echo form_label('Post Something', $post['id']); ?></td>
                <td><?php echo form_textarea($post); ?></td>
		<td style="color: red;"><?php echo form_error($post['name']); ?>
                <?php if (isset($errors['hashtag_error'])) {
                    echo $errors['hashtag_error'];
                }?></td>
	</tr>
</table>
<?php echo form_submit('submit', 'Submit'); ?>
<?php echo form_close(); ?>
<br />
<?php if (!isset($parent_post)) { ?>
 - <a href="<?php echo $base_url; ?>index.php/home/yourposts/">Your Hoots</a>
 - <a href="<?php echo $base_url; ?>index.php/home/followed/">Followed Users/Hashtags</a>
 - <a href="<?php echo $base_url; ?>index.php/home/trending/">Trending Hoots</a> - 
 <?php } else { ?>

Original Post:
<table border="1" width="800">
        <tr>
		<td width="100"><?php echo $parent_post['username'] ?></td>
                <td>Posted On: <?php echo $parent_post['created'] ?></td>
        </tr>
        <tr>
                <td><?php if(file_exists('images/user_images/'.$parent_post['profile_image'])) { ?>
                        <img src="http://localhost/project/images/user_images/<?php echo $parent_post['profile_image']; ?>"></img>
                <?php } ?></td>
		<td><?php echo $parent_post['post_content']; ?></td>
	</tr>
        <tr>
		<td width="100"> </td>
                <td textalign="center">
                    <?php if ($parent_post['is_liked'] > 0) { ?>
                        <a href="http://localhost/project/index.php/home/likepost/<?php echo $parent_post['post_id']; ?>"/>Dislike</a>
                    <?php } else { ?>
                        <a href="http://localhost/project/index.php/home/likepost/<?php echo $parent_post['post_id']; ?>"/>Like</a>
                    <?php } ?>
                </td>
        </tr>
        <tr>
</table> 
 
 <?php } ?>
<br/>
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