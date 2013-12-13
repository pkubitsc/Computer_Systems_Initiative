<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>HALOC Computer Systems Initiative</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="<?php echo $base_url; ?>css/home/style.php?url=<?php echo $base_url; ?>" rel="stylesheet" type="text/css" media="screen" />
<meta http-equiv="refresh" content="90">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<?php
$get_adder = "";
foreach ($_GET AS $key => $value) {
    if ($key == 'search') {
        $get_adder .= "&".$key."=".urlencode($value);
    } else {
        $get_adder .= "&".$key."=".urlencode($value);
    }
}
?>
<script type="text/javascript">
$(document).ready(function() {
        $.ajaxSetup({ cache: false }); // This part addresses an IE bug.  without it, IE will only load the first number and will never refresh
                (function get_posts() {
                    $('#posts').load('<?php echo $base_url;?>index.php/jquery_scripts/get_posts/<?php echo $function."/".$id."/".$current_page."/".$type_page."?".$get_adder; ?>');
                    setTimeout(get_posts, 300000);
                })();

                (function get_pages() {
                    $("div[id^='pages']").load('<?php echo $base_url;?>index.php/jquery_scripts/get_pages/<?php echo $function."/".$id."/".$current_page."/".$type_page."/".$order_option."?".$get_adder; ?>');  
                    setTimeout(get_pages, 300000);
                })();

                <?php if (isset($parent_post)) { ?>
                (function get_parent_post() {
                    $('#parent_post').load('<?php echo $base_url;?>index.php/jquery_scripts/get_posts/<?php echo $parent_post['function']."/".$parent_post['id']."/0?".$get_adder; ?>');
                    setTimeout(get_parent_post, 300000);
                })();
                <?php } ?>
            
            
        $('#characterLeft').text('200 characters left');
        $('#post').keyup(function () {
            var max = 200;
            var len = $(this).val().length;
            if (len >= max) {
                $('#characterLeft').text(' you have reached the limit');
            } else {
                var ch = max - len;
                $('#characterLeft').text(ch + ' characters left');
            }
        });
});
</script>

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
  <h1><a href="#">Haloc</a></h1>
	<p>Computer systems initiative</p>
	<p>&nbsp;</p>
</div>
<div id="header-wrapper">
	<div id="header">
		<div id="menu">
                        <ul>
                                <?php if (!isset($parent_post) || $type_page == 'yourposts' || $type_page == 'followed' ) { ?>
                                        <li><a href="<?php echo $base_url; ?>index.php/home/yourposts/">Your Hoots</a></li>
                                        <li><a href="<?php echo $base_url; ?>index.php/home/followed/">Followed Users/Hashtags</a></li>
                                <?php } else {} ?>  
                        </ul>
		</div>
	</div>
</div>