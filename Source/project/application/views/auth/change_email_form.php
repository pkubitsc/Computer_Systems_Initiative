<?php
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Email</title>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/changeemail/demo.css" media="all" />
  	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/changeemail/demo.css" media="all" />
  	<link href="<?php echo $base_url; ?>css/changeemail/style.css" rel="stylesheet" type="text/css" media="screen" />																			   	<link href="../../css/changeemail/style.css" rel="stylesheet" type="text/css" media="screen" />

    </head>
<body>
<div class="container">
			<!-- freshdesignweb top bar -->
            <div class="freshdesignweb-top">
              <div class="clr"></div>
            </div><!--/ freshdesignweb top bar -->
			<header>
				<h1>Change Email</h1>
            </header>       
      <div  class="form">
			<?php echo form_open_multipart($this->uri->uri_string());?>
            
           	<p class="contact"><label for="password"><?php echo form_label('Password', $password['id']); ?></label></p>
           	<?php echo form_password($password); ?>
				<?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>

              	<p class="contact"><label for="new_email"><?php echo form_label('New email address', $email['id']); ?></label></p>
				<?php echo form_input($email); ?>
				<?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>

        <p>
        <?php echo form_submit('change', 'Send confirmation email'); ?>
        </p>
        <?php echo form_close(); ?>
   </div>      

</div>
<br/><br/><br/><br/><br/>
</body>
</html>

<!--<?php echo form_open($this->uri->uri_string()); ?>
<table>
	<tr>
		<td><?php echo form_label('Password', $password['id']); ?></td>
		<td><?php echo form_password($password); ?></td>
		<td style="color: red;"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('New email address', $email['id']); ?></td>
		<td><?php echo form_input($email); ?></td>
		<td style="color: red;"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></td>
	</tr>
</table> -->
<!--<?php echo form_submit('change', 'Send confirmation email'); ?>
<?php echo form_close(); ?> -->