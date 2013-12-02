<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-AU">
<head>
 <title>HALOC Login </title>
 <meta name="keywords" content="Sleek & Modern Login Form" /> 
 <meta http-equiv="content-type" content="application/xhtml; charset=UTF-8" />
 <link rel="stylesheet" type="text/css" href="css/style.css" />
 <link href="../../css/login/style.css" rel="stylesheet" type="text/css" media="screen" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
$('input[type="image"]').attr('disabled','disabled');
$('input[type="text"]').keyup(function(){
    if($('input[type="text"]').val() == ""){
        $('input[type="image"]').attr('disabled','disabled');
    }
    else{
        $('input[type="image"]').removeAttr('disabled');
    }
})
</script>
</head>

<body>
    
<!-- Main Body Starts Here -->
<div id="main_body">

<!-- Form Title Starts Here -->
<div class="form_title">
<img src="http://localhost/project/images/login/form_title.gif" alt="Sleek &amp; Modern Login Form - Design3Edge" />
</div>
<!-- Form Title Ends Here -->

<!-- Form Starts Here -->
<div class="form_box">
<?php echo form_open_multipart($this->uri->uri_string()); ?>

<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
<?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>

<!-- User Name -->
<p class="form_text">
<?php echo form_label('Username', $login['id']); ?>
</p>
<p class="form_input_BG"><?php echo form_input($login); ?></p>

<!-- User Name -->

<!-- Clear -->
<p class="clear">&nbsp;
</p>
<!-- Clear -->

<!-- Password -->
<p class="form_text" style="margin-left:4px;">
<?php echo form_label('Password', $password['id']); ?>
</p>
<p class="form_input_BG"><?php echo form_password($password); ?></p>
<!-- Password -->
 
<!-- Clear -->
<p class="clear">&nbsp;
</p>
<!-- Clear -->
<p class="form_password">  
<?php echo anchor('/auth/forgot_password/', 'Forgot password'); ?> 
</p>
<p class="form_check_box">
<?php echo form_label('Remember me', $remember['id']); ?>&nbsp;
<?php echo form_checkbox($remember); ?>
</p>

<p class="form_login_signup_btn">
<?php echo form_input(array('type' => 'image', 'src' => 'http://localhost/project/images/login/login_btn.png', 'name' => 'submit'));?> &nbsp;
<a href="http://localhost/project/index.php/auth/register"><img src="http://localhost/project/images/login/signup_btn.png" title="Signup Now" name="signup" id="signup" /></a>
</p>
		
<?php echo form_close(); ?>
</div>
<!-- Form Ends Here -->

</div>
<!-- Main Body Ends Here -->

<!-- Copyright -->
<div style="text-align:center;margin:100px 270px 0px 0px;">
<a href="index.php?page=register" </a>
</div>
<!-- Copyright -->

 </body>
</html>
