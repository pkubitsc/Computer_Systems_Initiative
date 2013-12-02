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
    <link rel="stylesheet" type="text/css" href="../../css/register/demo.css" media="all" />
    <link href="../../css/register/style.css" rel="stylesheet" type="text/css" media="screen" />
   
   	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="script.js"></script>	
        
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
                
    			<p class="contact"><label for="email"><?php echo form_label('Email Address', $email['id']); ?></label></p> 
    			<?php echo form_input($email); ?>
              	<?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>  
                
           	<p class="contact"><label for="password"><?php echo form_label('Password', $password['id']); ?></label></p> 
	   			<?php echo form_password($password); ?>
          		<?php echo form_error($password['name']); ?>  
               
	  			<span id= "result"></span>
	           <p class="contact"><label for="repassword"><?php echo form_label('Confirm Password', $confirm_password['id']); ?></label></p> 
    			<?php echo form_password($confirm_password); ?> 
        		<?php echo form_error($confirm_password['name']); ?>
                
                
               <fieldset>
                 <label>Birthday</label>
                  <label class="month"> 
                  <select class="select-style" name="BirthMonth">
                  <option value="">Month</option>
                  <option  value="01">January</option>
                  <option value="02">February</option>
                  <option value="03" >March</option>
                  <option value="04">April</option>
                  <option value="05">May</option>
                  <option value="06">June</option>
                  <option value="07">July</option>
                  <option value="08">August</option>	
                  <option value="09">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12" >December</option>
                  </label>
                 </select>    
                <label>Day<input class="birthday" maxlength="2" name="BirthDay"  placeholder="Day" required></label>
                <label>Year <input class="birthyear" maxlength="4" name="BirthYear" placeholder="Year" required></label>
              </fieldset> 
              
             <p class= "contract"><label for="biography"><?php echo form_label('Biography', $biography['id']); ?></label>
             <?php echo form_textarea($biography); ?>
             <?php echo form_error($biography['name']); ?>
              
             <p class="contact"><label for="image"><?php echo form_label('Profile Image', $profile_image['id']); ?></label>
             <input type="file" name="userfile" size="20" />
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
