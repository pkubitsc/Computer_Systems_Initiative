<? header ("Content-type: text/css");?>
<?php $base_url = $_GET['url']; ?>

﻿/* Copyright Design3Edge */
/* http://www.design3edge.com */

* {margin: auto;padding: 0;}

body {background:url(<?php echo $base_url; ?>images/login/main_BG.jpg) left repeat; font-family:arial; font-size:12px; color:#ffffff;text-align:center;}
  
p {margin:0px; padding:0px;}
 
a img{border: 0px;}

.left{float:left;}

.clear{clear:both;}

.right{float:right;}

:focus{outline:none;}
 
a {text-decoration:none;cursor:pointer;}

/* Form Style Starts Here */

#main_body {width:526px;margin-top:200px;text-align:left;height:295px;
background:url(<?php echo $base_url; ?>images/login/form_BG.png) no-repeat left;
padding:20px 0px 0px 43px;
margin-left: auto;
margin-right: auto;}

.form_title{color:#000000;font-size:12px;float:left;padding-top:3px;}

.form_box{padding-top:65px;color:#ffffff;font-size:12px;}

.form_text{color:#fffff;font-size:12px;float:left;padding-top:6px;}

.form_input_BG{width:259px; background:url(<?php echo $base_url; ?>images/login/form_input.png) center left no-repeat; margin-left:30px;border:0px;height:42px;float:left;}

.form_input_BG input[type="text"]{margin:5px 0px 0px 5px;border:none;width:220px;background:none;}
.form_input_BG input[type="password"]{margin: 5px 0px 0px 5px;border:none;width:220px;background:none;}
 
.form_check_box{margin-left:135px;margin-top:-15px;}

.form_login_signup_btn input{margin-left:135px;margin-top: 23px;}
.form_password{
	margin-left: 253px;
}
