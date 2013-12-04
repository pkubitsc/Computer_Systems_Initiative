<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = 'Email or login';
} else {
	$login_label = 'Email';
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<? echo $base_url;?>css/forgotpassword/demo.css" media="all" />
    <link href="<? echo $base_url;?>css/forgotpassword/style.css" rel="stylesheet" type="text/css" media="screen" />
    </head>
<body>
<div class="container">
			<!-- freshdesignweb top bar -->
            <div class="freshdesignweb-top">
              <div class="clr"></div>
            </div><!--/ freshdesignweb top bar -->
			<header>
				<h1>Forgot Password</h1>
            </header>       
      <div  class="form">
			<?php echo form_open_multipart($this->uri->uri_string());?>
            
           	<p class="contact"><label for="email_username"><?php echo form_label($login_label, $login['id']); ?></label></p>
				<?php echo form_input($login); ?>
				<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
        <p>
        <?php echo form_submit('reset', 'Get a new password'); ?>
        </p>
        <?php echo form_close(); ?>
   </div>      

</div>
<br/><br/><br/><br/><br/>
</body>
</html>





<?php echo form_open($this->uri->uri_string()); ?>
<table>
	<tr>
    <!--
		<td><?php echo form_label($login_label, $login['id']); ?></td>
		<td><?php echo form_input($login); ?></td>
		<td style="color: red;"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></td> -->
	</tr>
</table>
<!--<?php echo form_submit('reset', 'Get a new password'); ?> -->
<!-- <?php echo form_close(); ?>-->