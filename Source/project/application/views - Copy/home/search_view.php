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
    
function paging($pages, $current_page, $search_terms) {
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
        $str .= " <a href=\"http://localhost/project/index.php/home/search?page=1&search=".$search_terms."&submit=Submit\">First</a> ";
    }
    for ($i = $page_start; $i <= $page_end; $i++) {
        $str .= " <a href=\"http://localhost/project/index.php/home/search?page=".$i."&search=".$search_terms."&submit=Submit\">".$i."</a>&nbsp;";
    }
    if ($page_end != $pages) {
        $str .= " <a href=\"http://localhost/project/index.php/home/search?page=".$pages."&search=".$search_terms."&submit=Submit\">Last</a> ";
    }
    
    return $str;
}
$pages = paging($num_pages, $current_page, $search_terms);
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
<br/>


<p>Hashtag Results:</p>
<table border="1" width="800">
<?php if (!empty($hashtag_results)) {
    echo $pages;
    foreach ($hashtag_results as $hashtag) { ?>

        <tr>
		<td width="100">Hashtag: <?php echo $hashtag['hashtag'] ?></td>
                <td><a href="<?php echo $base_url."index.php/home/view_hashtag_profile/".$hashtag['hashtag_id'] ?>">See Posts</a> - 
                <a href="<?php echo $base_url."index.php/home/follow_hashtag/".$hashtag['hashtag_id'] ?>">Follow</a></td>
        </tr>
<?php }
} else {?>
            No results
<?php }?>
</table>
<br />
<br />

<p>User Results:</p>
<table border="1" width="800">

<?php if (!empty($user_results)) {
    echo $pages;
    foreach ($user_results as $user) {
        if ($user['id'] != $logged_in_user_id) { ?>
        <tr>
                <td><?php if(file_exists('images/user_images/'.$user['profile_image'])) { ?>
                        <img src="http://localhost/project/images/user_images/<?php echo $user['profile_image']; ?>"></img>
                <?php } ?></td>
		<td><?php echo $user['username']?>(ID: <?php echo $user['id']; ?>) - <a href="<?php echo $base_url; ?>index.php/home/view_other_profile/<?php echo $user['id']; ?>/">See Profile/Posts</a> - <a href="<?php echo $base_url."index.php/home/follow_user/".$user['id']; ?>">Follow</a><br />
                    <?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></td>
	</tr>
<?php } }
} else {?>
            No results
<?php }?>
</table>