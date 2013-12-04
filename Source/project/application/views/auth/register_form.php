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

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <link rel="stylesheet" type="text/css" href="style.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/register/demo.php?url=<?php echo $base_url; ?>" media="all" />
        <link href="<?php echo $base_url; ?>css/register/style.php?url=<?php echo $base_url; ?>" rel="stylesheet" type="text/css" media="screen" />
   <script src="<?php echo $base_url; ?>css/register/script.js"></script>
   
   	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="<?php echo $base_url; ?>script.js"></script>
        
        <!--script for checking username, email, password matching-->	
        <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
        <!-- <script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script> -->
        
       <script type="text/javascript">
 
 
 
        //Script for checking username
         $(document).ready(function(){
            $("#username").change(function(){
                 $("#message").html("<img src='../../images/ajax-loader.gif' /> checking...");
             
 
            var username=$("#username").val();
 
              $.ajax({
                    type:"post",
                    url:"<?php echo $base_url; ?>index.php/jquery_scripts/check_username/",
                    data:"username="+username,
                        success:function(data){
                        if(data==0){
                            $("#message").html("<img src='../../images/register/tick.png' /> Username available");
                        }
                        else{
                            $("#message").html("<img src='../../images/register/cross.png' /> Username already taken");
                        }
                    }
                 });
 
            });
 
         });
         
         //function checking password
          function checkPasswordMatch() {
                var password = $("#password").val();
                var confirmPassword = $("#confirm_password").val();

        if (password != confirmPassword)
                 $("#divCheckPasswordMatch").html("Passwords do not match!");
        else
                 $("#divCheckPasswordMatch").html("Passwords match.");
        }

        $(document).ready(function () {
             $("#txtConfirmPassword").keyup(checkPasswordMatch);
        });

 
         //function checking email	
         $(document).ready(function(){
            $("#email").change(function(){
                 $("#message_email").html("<img src='../../images/register/ajax-loader.gif' /> checking...");
             
 
            var email=$("#email").val();
 
              $.ajax({
                    type:"post",
                    url:"<?php echo $base_url; ?>index.php/jquery_scripts/check_email/",
                    data:"email="+email,
                        success:function(data){
                        if(data==0){
                            $("#message_email").html("<img src='../../images/register/tick.png' /> Email available");
                        }
                        else{
                            $("#message_email").html("<img src='../../images/register/cross.png' /> Email already taken");
                        }
                    }
                 });
 
            });
 
         });
 
       </script>
        
    </head>
<body>
<div class="container">
			<!-- freshdesignweb top bar -->
            <div class="freshdesignweb-top">
              <div class="clr"></div>
            </div><!--/ freshdesignweb top bar -->
			<header>
				<h1>Register</h1>
            </header>       
      <div  class="form">
			<?php echo form_open_multipart($this->uri->uri_string());?>
            
           	<p class="contact"><label for="firstname"><?php echo form_label('First Name', $first_name['id']); ?></label></p>
				<?php echo form_input($first_name); ?>
				<?php echo form_error($first_name['name']); ?>

              	<p class="contact"><label for="lastname"><?php echo form_label('Last Name', $last_name['id']); ?></label></p>
				<?php echo form_input($last_name); ?>
				<?php echo form_error($last_name['name']); ?>
	
              	<p class="contact"><label for="name"><?php echo form_label('Username', $username['id']); ?></label></p> 
    			<?php echo form_input($username); ?> 
    			<?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?>
                        <span id= "message"></span>
                        
                <p class="contact"><label for="email"><?php echo form_label('Email Address', $email['id']); ?></label></p> 
    			<?php echo form_input($email); ?>
                        <?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>  
                        <span id= "message_email"></span>
                        
           	<p class="contact"><label for="password"><?php echo form_label('Password', $password['id']); ?></label></p> 
	   			<?php echo form_password($password); ?>
          		<?php echo form_error($password['name']); ?>  
               
	  			<span id= "result"></span>
	           <p class="contact"><label for="repassword"><?php echo form_label('Confirm Password', $confirm_password['id']); ?></label></p> 
    			<?php echo form_password($confirm_password, array('id' => 'confirm_password'), "onChange=\"checkPasswordMatch();\""); ?>
        		<?php echo form_error($confirm_password['name']); ?>
                <div class="registrationFormAlert" id="divCheckPasswordMatch">
                </div>
                
     
              
                 <p class= "contact"><label for="biography"><?php echo form_label('Biography', $biography['id']); ?></label>
                     <?php echo form_textarea($biography); ?>
                     <?php echo form_error($biography['name']); ?>
             
                <p class="contact"><label for="image"><?php echo form_label('Profile Image', $profile_image['id']); ?></label>
                    <input type="file" name="userfile" />
                    <?php echo form_error($profile_image['name']); ?>
             
                <br/>
                </p>
                <p>
           <?php echo form_submit('register', 'Register'); ?>
			</p>
		<?php echo form_close(); ?>
        </div>      
</div>
<br/><br/><br/><br/><br/>
</body>
</html>
