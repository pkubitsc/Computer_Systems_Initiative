<?php
$biography = array(
	'name'	=> 'biography',
	'id'	=> 'biography',
	'value' => set_value('biography'),
	'maxlength'	=> 255,
        'rows' => 5,
        'columns' => 10,
	'size'	=> 30,
);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>HALOC Computer Systems Initiative</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="../../css/profile/style.css" rel="stylesheet" type="text/css" media="screen" />
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
             <li><a href="#">Your Hoots</a></li>
             <li><a href="#">Top Hoots</a></li>
             <li><a href="#">Followed</a></li>		
            </ul>
		</div>
	</div>
</div>
<?php 
if (isset($errors)) {
    foreach ($errors as $error_key => $error_value) {
        echo $error_value."<br/>";
    }
}
?>		
<div id="wrapper">
	<div id="page">
		<div id="page-bgtop">
        </div>
	<hr />

<?php echo form_open_multipart($this->uri->uri_string()); ?>
<table>
        <tr>
                <td>
                        <table>
                            <tr>
                                <td><img src="http://localhost/project/images/user_images/original/<?php echo $user->profile_image;?>"></img></td>
                            </tr>
                            <tr>
                                <td><a href="http://localhost/project/index.php/auth/change_profile_image/">Change Profile Image</a></td>
                            </tr>
                        </table>
                </td>
                <td>
                    <!-- show and change everything else -->
                    <table>
                        <tr>
                            <td>Username - </td>
                            <td><?php echo $user->username?></td>
                        </tr>
                        <tr>
                            <td>Name - </td>
                            <td><?php echo $user->first_name?> <?php echo $user->last_name?></td>
                        </tr>
                        <tr>
                            <td><a href="http://localhost/project/index.php/auth/change_email/">Change Email</a></td>
                        </tr>
                        <tr>
                            <td><a href="http://localhost/project/index.php/auth/change_password/">Change Password</a></td>
                        </tr>
                        <tr>
  <!--                      <td><?php echo form_label('Biography', $biography['id']); ?></td>
                            <td><?php echo $user->biography; ?></td>
                            <td><?php echo form_textarea($biography); ?></td>
                            <td style="color: red;"><?php echo form_error($biography['name']); ?></td>
                        </tr> -->
                    </table>
                </td>
        </tr>
</table>
<div class="container">
			<!-- freshdesignweb top bar -->
            <div class="freshdesignweb-top">
              <div class="clr"></div>
            </div><!--/ freshdesignweb top bar -->       
      <div  class="form">
            	<br/>
	      			<?php echo form_open_multipart($this->uri->uri_string());?>
              		<?php echo form_label('Biography', $biography['id']); ?>
              	  	<?php echo $user->biography; ?>
                	<br/><br/><br/><br/>
                 	<?php echo form_textarea($biography); ?>
                 	<?php echo form_error($biography['name']); ?>
                
        <p>
        <?php echo form_submit('change', 'Change'); ?>
        </p>
        <br/><br/><br/><br/><br/>
       </div>
      <?php echo form_close(); ?>
  </div>
