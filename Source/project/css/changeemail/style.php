<? header ("Content-type: text/css");?>
<?php $base_url = $_GET['url']; ?>

.form{
	background: #f1f1f1;
	width: 470px;
	height: 275px;
	/* [disabled]padding-left: 50px; */
	/* [disabled]padding-top: 20px; */
	/* [disabled]padding-bottom: 0px; */
	/* [disabled]padding-right: 0px; */
	margin-bottom: 0;
	margin-left: auto;
	margin-right: auto;
	margin-top: 30px;
}
.form2{
	background: #f1f1f1;
	width: 470px;
	height: 100px;
	/* [disabled]padding-left: 50px; */
	/* [disabled]padding-top: 20px; */
	/* [disabled]padding-bottom: 0px; */
	/* [disabled]padding-right: 0px; */
	margin-bottom: 0;
	margin-left: auto;
	margin-right: auto;
	margin-top: 30px;
}
.form fieldset{
	border: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
	margin-right: 0px;
}
.form p.contact {
	font-size: 12px;
	line-height: 14px;
	font-family: Arial, Helvetica;
	margin-bottom: 10px;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	width: 150px;
}
.form p.contact.label.email_username{ width:100px;}
.form input[type="text"] { width: 400px; }
.form input[type="email"] { width: 400px; }
.form input[type="password"] { width: 400px; }
.form input[type="submit"]{margin-left: 250px; margin-top: 15px;}
.form input.birthday{width:60px;}
.form input.birthyear{width:100px;}
.form label { color: #000; font-weight:bold;font-size: 12px;font-family:Arial, Helvetica; }
.form label.month {width: 135px;}
.form input, textarea {
	border: 1px solid rgba(122, 192, 0, 0.15);
	font-family: Keffeesatz, Arial;
	color: #4b4b4b;
	font-size: 14px;
	-webkit-border-radius: 5px;
	margin-top: 10px;
	margin-bottom: 10px;
	padding-bottom: 7px;
	padding-left: 7px;
	padding-right: 30px;
	padding-top: 7px;
}
.form input:focus, textarea:focus {
	border: 1px solid #ff5400;
	background-color: rgba(255,255,255,1);
}
.form .select-style {
  -webkit-appearance: button;
  -webkit-border-radius: 2px;
  -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
  -webkit-padding-end: 20px;
  -webkit-padding-start: 2px;
  -webkit-user-select: none;
  background-image: url(<?php echo $base_url; ?>images/register/select-arrow.png), 
    -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);
  background-position: center right;
  background-repeat: no-repeat;
  border: 0px solid #FFF;
  color: #555;
  font-size: inherit;
  margin: 0;
  overflow: hidden;
  padding-top: 5px;
  padding-bottom: 5px;
  text-overflow: ellipsis;
  white-space: nowrap;
  }
  
.form .gender {
  width:410px;
  }
.form input.buttom{
	background: #7d7b7b;
	display: inline-block;
	color: #fbf7f7;
	text-decoration: none;
	font-weight: bold;
	line-height: 1;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	-moz-box-shadow: 0 1px 3px #999;
	-webkit-box-shadow: 0 1px 3px #999;
	box-shadow: 0 1px 3px #999;
	text-shadow: 0 -1px 1px #222;
	border: none;
	position: relative;
	cursor: pointer;
	font-size: 14px;
	font-family: Verdana, Geneva, sans-serif;
	padding-bottom: 6px;
	padding-left: 10px;
	padding-right: 10px;
	padding-top: 10px;
}
.form input.buttom:hover	{
	background-color: #C0C0C0;
}
.resetbutton{
	margin-left: 780px; 
	margin-top: -40px;
}
.textfield{
	font-size: 12px;
	line-height: 14px;
	font-family: Arial, Helvetica;
	margin-bottom: 0px;
	margin-left: 0px;
	margin-top: 5px;
	margin-right: 0px;
}

#result{

	margin-left:5px;

}



#contactform .short{

	color:#FF0000;

}



#contactform .weak{

	color:#E66C2C;

}



#contactform .good{

	color:#2D98F3;

}



#contactform .strong{

	color:#006400;

}
