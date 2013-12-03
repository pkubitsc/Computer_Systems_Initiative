<?php
if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
	);
}
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'value' => set_value('confirm_password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$first_name = array(
	'name'	=> 'first_name',
	'id'	=> 'first_name',
	'value' => set_value('first_name'),
	'maxlength'	=> 40,
	'size'	=> 30,
);
$last_name = array(
	'name'	=> 'last_name',
	'id'	=> 'last_name',
	'value' => set_value('last_name'),
	'maxlength'	=> 40,
	'size'	=> 30,
);
$biography = array(
	'name'	=> 'biography',
	'id'	=> 'biography',
	'value' => set_value('biography'),
	'maxlength'	=> 255,
        'rows' => 5,
        'columns' => 10,
	'size'	=> 30,
);
$profile_image = array(
	'name'	=> 'profile_image',
	'id'	=> 'profile_image',
	'value' => set_value('profile_image'),
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<html>
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript">
        $("#register").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "http://localhost/project/index.php/jquery_scripts/check_email/",
                        type: "post"
                     }
                }
            },
            messages: {
                email: {
                    required: "Please Enter Email!",
                    email: "This is not a valid email!",
                    remote: "Email already in use!"
                }
            }
        });
    </script>
    </head>
    
<?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'register')); ?>
<table>
	<?php if ($use_username) { ?>
	<tr>
		<td><?php echo form_label('Username', $username['id']); ?></td>
		<td><?php echo form_input($username); ?></td>
		<td style="color: red;"><?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?></td>
	</tr>
	<?php } ?>
	<tr>
		<td><?php echo form_label('Email Address', $email['id']); ?></td>
		<td><?php echo form_input($email, array('id' => 'email')); ?></td>
		<td style="color: red;"><span id="email"></span><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Password', $password['id']); ?></td>
		<td><?php echo form_password($password); ?></td>
		<td style="color: red;"><?php echo form_error($password['name']); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Confirm Password', $confirm_password['id']); ?></td>
		<td><?php echo form_password($confirm_password); ?></td>
		<td style="color: red;"><?php echo form_error($confirm_password['name']); ?></td>
	</tr>
        <tr>
		<td><?php echo form_label('First Name', $first_name['id']); ?></td>
		<td><?php echo form_input($first_name); ?></td>
		<td style="color: red;"><?php echo form_error($first_name['name']); ?></td>
	</tr>
        <tr>
		<td><?php echo form_label('Last Name', $last_name['id']); ?></td>
		<td><?php echo form_input($last_name); ?></td>
		<td style="color: red;"><?php echo form_error($last_name['name']); ?></td>
	</tr>
        <tr>
		<td><?php echo form_label('Biography', $biography['id']); ?></td>
                <td><?php echo form_textarea($biography); ?></td>
		<td style="color: red;"><?php echo form_error($biography['name']); ?></td>
	</tr>
        <tr>
		<td><?php echo form_label('Profile Image', $profile_image['id']); ?></td>
                <td><input type="file" name="userfile" size="20" /></td>
		<td style="color: red;"><?php echo form_error($profile_image['name']); ?></td>
	</tr>

	<?php if ($captcha_registration) {
		if ($use_recaptcha) { ?>
	<tr>
		<td colspan="2">
			<div id="recaptcha_image"></div>
		</td>
		<td>
			<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
			<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
			<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="recaptcha_only_if_image">Enter the words above</div>
			<div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
		</td>
		<td><input type="text" id="recaptcha_response_field" name="recaptcha_response_field" /></td>
		<td style="color: red;"><?php echo form_error('recaptcha_response_field'); ?></td>
		<?php echo $recaptcha_html; ?>
	</tr>
	<?php } else { ?>
	<tr>
		<td colspan="3">
			<p>Enter the code exactly as it appears:</p>
			<?php echo $captcha_html; ?>
		</td>
	</tr>
	<tr>
		<td><?php echo form_label('Confirmation Code', $captcha['id']); ?></td>
		<td><?php echo form_input($captcha); ?></td>
		<td style="color: red;"><?php echo form_error($captcha['name']); ?></td>
	</tr>
	<?php }
	} ?>
</table>
<?php echo form_submit('register', 'Register'); ?>
<?php echo form_close(); ?>