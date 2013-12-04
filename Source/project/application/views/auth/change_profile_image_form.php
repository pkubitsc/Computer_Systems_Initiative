<?php
$profile_image = array(
	'name'	=> 'profile_image',
	'id'	=> 'profile_image',
	'value' => set_value('profile_image'),
        'max_height' => '2000',
        'max_width' => '2000',
        'max_size' => '10000000'
);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>HALOC Computer Systems Initiative</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="<?php echo $base_url;?>css/profile/style.php?url=<?php echo $base_url; ?>" rel="stylesheet" type="text/css" media="screen" />
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
             <li><a href="<?php echo $base_url; ?>index.php/home/followed_users/">Users You are Following</a></li>
             <li><a href="<?php echo $base_url; ?>index.php/home/followed_hashtags/">Hashtags You are Following</a></li>		
            </ul>
		</div>
	</div>
</div>		


<div id="wrapper">
	<div id="page">
		<div id="page-bgtop">
        </div>
	<hr />
        
<?php echo form_open_multipart($this->uri->uri_string()); ?>

<table align="center">
        <tr>
                <td>Current Image:<br /></td>
        </tr>
        <tr>
                <td><img src="<?php echo $base_url; ?>images/user_images/original/<?php echo $user->profile_image;?>"></img></td>
        </tr>
</table>

<table align="center">
        <tr>
		<td><?php echo form_label('Profile Image', $profile_image['id']); ?></td>
        </tr><tr>
                <td><input type="file" name="userfile"/></td>
        </tr><tr>
		<td style="color: red;"><?php echo $errors; ?></td>
	</tr>
        <tr>
                <td><?php echo form_submit('upload', 'Upload'); ?></td>
        </tr>
</table>

<?php echo form_close(); ?>
        </div>
</div>
<br/><br/><br/>