<?php
    $str = "Pages ";
    $temp_str = "";
    
    $get_adder = "";
    foreach ($_GET AS $key => $value) {
        if ($key != 'page') {
                if ($key == 'search') {
                    $get_adder .= "&".$key."=".urlencode($value);
                } else {
                    $get_adder .= "&".$key."=".urlencode($value);
                }
        }
        
    }
    
    if ($num_pages > 10) {
            // do some hacking...
            if ($current_page-3 > 0) {
                    $page_start = $current_page-3;
            } else {
                    $page_start = 1;
            }

            if ($current_page+3 < $num_pages) {
                    $page_end = $current_page+3;
            } else {
                    $page_end = $num_pages;
            }
    } else {
            $page_start = 1;
            $page_end = $num_pages;
    }
    
    $type_page = ($type_page == 'see_replies' ? 'see_replies/'.$id : $type_page);
    $type_page = ($type_page == 'view_other_profile' ? 'view_other_profile/'.$id : $type_page);
    
    if ($page_start != 1) {
            $str .= "<a href=\"".$base_url."index.php/home/".$type_page."?page=1".$get_adder."\">First</a> ";
    }
    for ($i = $page_start; $i <= $page_end; $i++) {
            $str.= "<a href=\"".$base_url."index.php/home/".$type_page."?page=".$i.$get_adder."\">".$i."</a> ";
    }
    if ($page_end != $num_pages) {
            $str .= "<a href=\"".$base_url."index.php/home/".$type_page."?page=".$num_pages.$get_adder."\">Last</a> ";
    }
    
    $order_by['posts'] = array(
                  'default'  => 'Default',
                  'created'  => 'Created',
                  'username'    => 'Username',
                  'likes' => 'Number Likes',
                  'replies' => 'Number Replies'
                );
    
    $order_by['hashtags'] = array(
                  'default'  => 'Default',
                  'created'  => 'Created',
                  'hashtag'  => 'Hashtag Name'
                );
    
    $order_by['users'] = array(
                  'default'  => 'Default',
                  'created'  => 'Account Creation Date',
                  'hashtag'  => 'Username',
                  'first_name'  => 'First Name',
                  'last_name'  => 'Last Name'
                );

    $order = array(
                  'default'  => 'Default',
                  'DESC'  => 'Descending',
                  'ASC'  => 'Ascending',
                );
    
    if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            $default_order_by = $_GET['order_by'];
            $default_order = $_GET['order'];
    } else {
            $default_order_by = 'default';
            $default_order = 'default';
    }
?>
<div class="form" style="position:relative; top:50%; height:50px; margin-top:25px;">               
	<div style="float: left; padding-top: 17px;">
            <?php echo $str; ?>&nbsp;
        </div>
        <div style="float: right; padding-top: 7px;">
            <!-- form to order posts. ONLY sort yourposts and followed (but able to be expanded
                 at a later date)
            -->
            <?php echo form_open($base_url.'index.php/home/'.$type_page.'?page='.$current_page, array('method' => 'GET')); ?>
            <?php echo form_dropdown('order_by', $order_by[$order_option], $default_order_by); ?>
            <?php echo form_dropdown('order', $order, $default_order); ?>
            <?php echo form_submit('sort', 'Sort'); ?>
            <?php form_close(); ?>
        </div>
</div>