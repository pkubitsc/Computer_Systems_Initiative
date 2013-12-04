<?php
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
        $str .= " <a href=\"http://localhost/project/index.php/home/followed_users?page=1\">First</a> ";
    }
    for ($i = $page_start; $i <= $page_end; $i++) {
        $str .= " <a href=\"http://localhost/project/index.php/home/followed_users?page=".$i."\">".$i."</a>&nbsp;";
    }
    if ($page_end != $pages) {
        $str .= " <a href=\"http://localhost/project/index.php/home/followed_users?page=".$pages."\">Last</a> ";
    }
    
    return $str;
}
$pages = paging($num_pages, $current_page);
?>

- <a href="<?php echo $base_url; ?>index.php/home/yourposts/">Home</a>
- <a href="<?php echo $base_url; ?>index.php/auth/change_profile">Your Profile</a>
- <a href="<?php echo $base_url; ?>index.php/search/">Search</a>
- <a href="<?php echo $base_url; ?>index.php/auth/logout">Logout</a> -

<?php if (isset($errors)) {
        foreach ($errors AS $key => $value) { ?>
                <br/><?php echo $value; ?>
<?php   }
} ?>
 
<br /><br />
<table border="1" width="800">

<?php
echo $pages;
if (isset($users) && !empty($users)) {
    foreach ($users as $user) {?>
        <tr>
                <td><?php if(file_exists('images/user_images/'.$user['profile_image'])) { ?>
                        <img src="http://localhost/project/images/user_images/<?php echo $user['profile_image']; ?>"></img>
                <?php } ?></td>
		<td><?php echo $user['username']?>(ID: <?php echo $user['id']; ?>) - <a href="<?php echo $base_url; ?>index.php/home/view_other_profile/<?php echo $user['id']; ?>/">See Profile/Posts</a> - <a href="<?php echo $base_url."index.php/home/unfollow_user/".$user['id']; ?>">Unfollow</a><br />
                    <?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></td>
	</tr>
<?php }
} elseif (isset($hashtags) && !empty($hashtags)) {
    foreach ($hashtags as $hashtag) { ?>
        <tr>
		<td width="100">Hashtag: <?php echo $hashtag['hashtag'] ?></td>
                <td><a href="<?php echo $base_url."index.php/home/view_hashtag_profile/".$hashtag['hashtag_id'] ?>">See Posts</a> - 
                <a href="<?php echo $base_url."index.php/home/unfollow_hashtag/".$hashtag['hashtag_id'] ?>">Unfollow</a></td>
        </tr>
<?php } }?>
</table>