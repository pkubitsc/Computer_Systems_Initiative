<? header ("Content-type: text/css");?>
<?php $base_url = $_GET['url']; ?>

/*
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License
*/

body {
	margin: 0px;
	padding: 0;
	background: url(<?php echo $base_url; ?>images/img01.jpg) repeat-x left top;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #66665E;
}

h1, h2, h3 {
	margin: 0;
	text-transform: uppercase;
	font-weight: normal;
	color: #36A12D;
}

h1 { font-size: 44px; }

h2 { font-size: 18px; }

h3 { }

p, ul, ol {
	margin-top: 0;
	line-height: 220%;
	text-align: justify;
}

ul, ol { }
ul.menu {  }
ul.menu li {  }
blockquote { }

a { color: #58191E; }

a:hover { text-decoration: none; }

a img {
	border: none;
}

img.left {
	float: left;
	margin: 7px 30px 0 0;
}

img.right {
	float: right;
	margin: 7px 0 0 30px;
}

hr { display: none; }

.list1 {
}

.list1 li {
	float: left;
	line-height: normal;
}

.list1 li img {
	margin: 0 30px 30px 0;
}

.list1 li.alt img {
	margin-right: 0;
}

#wrapper {
	margin: 0px;
	padding: 30px 0px 0px 0px;
}

/* Header */

#header-wrapper {
	margin: 0px;
	padding: 0px;
	
}

#header {
	width: 100%;
	height: 75px;
	margin: 0 auto;
	text-shadow: 0px 0px #FFFFFF;
	color: 0xFFFFFF;
}

/* Menu */

#menu {
	float: left;
	width: 100%;
	height: 50px;
	padding-top: 24px;
	text-decoration: underline;
	background-color: #000000;	
	display: block; 

}
#menu ul {
	margin: 0px;
	padding: 0px;
	list-style: none;
	line-height: normal;
	display: block;
	text-align: center;
}

#menu li {
	float: center;
	display: inline-block; 
}

#menu a {
	display: block;
	float: center;
	margin-right: 2px;
	padding: 4px 25px;
	text-decoration: none;
	text-transform: capitalize;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #FFFFFF;
	background: #2E2C2C;
}

#menu a:hover { 
	background: #635420;
}


#menu .current_page_item a {
	background: #6E831C;
	color: #FFFFFF;
	
}

#menu .first {
	background: #2E2C2C;
	float: center;
	display: inline-block; 
}
/* Search */

#search {
	float: left;
	width: 300px;
	height: 20px;
}

#search form {
	float: right;
	margin: 0;
	padding: 24px 30px 0 0;
}

#search fieldset {
	margin: 0;
	padding: 0;
	border: none;
}

#search input {
	float: left;
	font: 12px Georgia, "Times New Roman", Times, serif;
	border: none;
}

#search-text {
	width: 200px;
	height: 18px;
	padding: 3px 0 0 5px;
	border: 1px solid #333333;
	background: #ECF9E4;
	color: #000000;
}

#search-submit {
	height: 21px;
	margin-left: 10px;
	padding: 0px 5px;
	background: #6E831C;
	color: #FFFFFF;
}

/** LOGO */

#logo {

	width: 100%;
	height: 427px;
	margin-left: auto;
	margin-right: auto;
	background: url(<?php echo $base_url; ?>images/home/hal9001.png) no-repeat center;
	background-color: #58191E; 
	background-attachment:fixed;
	background-postion:center;
	
}

#logo h1, #logo p {
	margin: 0px;
	line-height: normal;
	font-weight: normal;
	color: #FFFFFF;
}

#logo p {
	padding-left: 32px;
	text-transform: uppercase;
	font-size: 13px;
	font-weight: bold;
	color: #FFFFFF;
}

#logo h1 {
	padding-left: 30px;
	padding-top: 160px;
	font-size: 60px;
	font-family: Georgia, "Times New Roman", Times, serif;
	width: auto;
}

#logo a {
	text-decoration: none;
	color: #FFFFFF;
}

#logo h1 a {
	text-decoration: none;
	color: #FFFFFF;
}

/* Page */

#page {
	margin: 0 auto;
	padding: 0px;
}

#page-bgtop {
	color: #66665E;
}

/* Content */

#content {
	float: right;
	width: 580px;
}

/* Post */

.post {
	margin-bottom: 10px;
}

.post .title {
	height: 30px;
	color: #08252E;
}

.post .title a {
	text-decoration: none;
	text-transform: capitalize;
	font-size: 1.4em;
	font-weight: bold;
	color: #58191E;
}

.post .date {
}

.post .meta {
	margin-left: 2px;
	padding: 2px 30px 2px 0px;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: normal;
	font-size: 10px;
	color: #66665E;
}

.post .meta span {
	display: block;
	margin-top: -10px;
}

.post .meta a { }

.post .entry {
	padding: 2px 0 10px 0;
}

.post .entry-content {
	float: right;
}

.post .entry-image {
	float: left;
	width: 280px;
	padding-right: 20px;
	padding-top: 6px;
	padding-bottom: 30px;
}

.post .links a {
	font-weight: bold;
	color: #58191E;
}

.post .links .comments {
}

.post .links .permalink {
	padding-left: 17px;
}

/* Sidebar */

#sidebar {
	float: left;
	width: 300px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}

#sidebar ul {
	margin: 0px 0px 0px 0px;
	padding: 0;
	list-style: none;
	line-height: normal;
}

#sidebar li {
	margin-bottom: 30px;
}

#sidebar li ul {
	margin: 0px;
	padding: 0px;
	background: #F8DFBB;
}

#sidebar li li {
	margin: 0px 15px;
	padding: 10px 0px 10px 0px;
	border-bottom: 1px solid #FFFFFF;
}

#sidebar li li a {
	font-weight: normal;
}

#sidebar li li a:hover {
}

#sidebar p {
	line-height: 200%;
	padding: 20px 15px 0px 15px;
}

#sidebar h2 {
	height: 30px;
	padding: 5px 0px 0px 15px;
	background: url(<?php echo $base_url; ?>images/img04.jpg) no-repeat left top;
	text-transform: capitalize;
	font-size: 16px;
	font-weight: bold;
	color: #FFFFFF;
}

#sidebar a {
	text-align: left;
	text-decoration: none;
	font-weight: bold;
	color: #66665E;
}

/* Calendar */

#calendar {
}

#calendar caption {
	padding-bottom: 5px;
	font-weight: bold;
}

#calendar table {
	width: 100%;
	border-collapse: collapse;
	border-bottom: 1px solid #24130F;
	border-left: 1px solid #24130F;
	border-right: 1px solid #24130F;
}

#calendar thead th {
	padding: 5px 0;
	text-align: center;
	border-top: 1px solid #24130F;
	border-left: 1px solid #24130F;
	background: #24130F;
}

#calendar tbody td {
	padding: 5px 0;
	text-align: center;
	border-top: 1px solid #24130F;
	border-left: 1px solid #24130F;
	border-bottom: 1px solid #24130F;
}

#calendar tfoot td {
	padding: 5px;
	border-left: 1px solid #24130F;
	border-bottom: 1px solid #24130F;
}

#calendar tfoot #next {
	border-top: 1px solid #24130F;
	text-align: right;
}

#calendar tfoot #prev {
	border-top: 1px solid #24130F;
}

#calendar .pad {
	border-bottom: 1px solid #24130F;
}

#calendar #today {
	background: #24130F;
}

/* Footer */

#footer {
	float: center;
	width: 40%;
	height: 50px;
	background-color: #000000;
        font-size: 16px;
        text-align: center;
        vertical-align: middle;
        line-height: 50px;
}

#footer-container {
        float: left;
	width: 100%;
	height: 50px;
	background-color: #000000;
        font-size: 16px;
        text-align: center;
        vertical-align: middle;
        line-height: 50px;
}

.form{
	background: #f1f1f1;
	width: 70%;
	min-height: 30px;
	/* [disabled]padding-left: 50px; */
	/* [disabled]padding-top: 20px; */
	/* [disabled]padding-bottom: 0px; */
	/* [disabled]padding-right: 0px; */
	margin-bottom: 0;
	margin-left: auto;
	margin-right: auto;
	margin-top: 10px;
	padding-left: 30px;	
	padding-right: 30px;	
}

rm fieldset{
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
.form input[type="text"] { width: 100px;}
.form input[type="email"] { width: 100px; }
.form input[type="password"] { width: 100px; }
.form input[type="submit"]{width: 60px; }
.form input.birthday{width:60px;}
.form input.birthyear{width:100px;}
.form label { color: #000; font-weight:bold;font-size: 12px;font-family:Arial, Helvetica; }
.div pagelabel{ color: #000; font-weight:bold;font-size: 12px;font-family:Arial, Helvetica};
.form label.month {width: 135px;}
.form input, textarea {
	border: 1px solid rgba(122, 192, 0, 0.15);
	font-family: Keffeesatz, Arial;
	color: #4b4b4b;
	width: 60px;
	font-size: 14px;
	-webkit-border-radius: 5px;
	margin-bottom: 10px;
	padding-bottom: 7px;
	padding-left: 5px;
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

.form2{
	background: #f1f1f1;
	width: 970px;
	height: 150px;
	/* [disabled]padding-left: 50px; */
	/* [disabled]padding-top: 20px; */
	/* [disabled]padding-bottom: 0px; */
	/* [disabled]padding-right: 0px; */
	margin-bottom: 0;
	margin-left: auto;
	margin-right: auto;
	margin-top: 30px;
	padding-left: 30px;	
	padding-right: 30px;	
}

rm fieldset{
	border: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
	margin-right: 0px;
}
.form2 p.contact {
	font-size: 12px;
	line-height: 14px;
	font-family: Arial, Helvetica;
	margin-bottom: 10px;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	width: 150px;
}
.form2 p.contact.label.email_username{ width:100px;}
.form2 input[type="text"] { width: 400px; }
.form2 input[type="email"] { width: 400px; }
.form2 input[type="password"] { width: 400px; }
.form2 input[type="submit"]{margin-left: 900px; margin-top: 7px; width: 60px; }
.form2 input.birthday{width:60px;}
.form2 input.birthyear{width:100px;}
.form2 label { color: #000; font-weight:bold;font-size: 12px;font-family:Arial, Helvetica; }
.form2 label.month {width: 135px;}
.form2 input, textarea {
	border: 1px solid rgba(122, 192, 0, 0.15);
	font-family: Keffeesatz, Arial;
	color: #4b4b4b;
	width: 800px;
	font-size: 14px;
	-webkit-border-radius: 5px;
	margin-bottom: 10px;
	padding-bottom: 7px;
	padding-left: 5px;
	padding-right: 30px;
	padding-top: 7px;
}
.form2 input:focus, textarea:focus {
	border: 1px solid #ff5400;
	background-color: rgba(255,255,255,1);
}
.form2 .select-style {
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
  
.form2 .gender {
  width:410px;
  }
.form2 input.buttom{
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
.form2 input.buttom:hover	{
	background-color: #C0C0C0;
}


<!-- PAGES BUTTON-->

.form3{
	background: #f1f1f1;
	width: 970px;
	height: 50px;
	/* [disabled]padding-left: 50px; */
	/* [disabled]padding-top: 20px; */
	/* [disabled]padding-bottom: 0px; */
	/* [disabled]padding-right: 0px; */
	margin-bottom: 0;
	margin-left: auto;
	margin-right: auto;
	margin-top: 30px;
	padding-left: 30px;	
	padding-right: 30px;	
}

rm fieldset{
	border: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
	margin-right: 0px;
}
.form3 p.contact {
	font-size: 12px;
	line-height: 14px;
	font-family: Arial, Helvetica;
	margin-bottom: 10px;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	width: 150px;
}
.form3 p.contact.label.email_username{ width:100px;}
.form3 input[type="text"] { width: 400px; }
.form3 input[type="email"] { width: 400px; }
.form3 input[type="password"] { width: 400px; }
.form3 input[type="submit"]{margin-left: 900px; margin-top: 7px; width: 60px; }
.form3 input.birthday{width:60px;}
.form3 input.birthyear{width:100px;}
.form3 label { color: #000; font-weight:bold;font-size: 12px;font-family:Arial, Helvetica; }
.form3 label.month {width: 135px;}
.form3 input, textarea {
	border: 1px solid rgba(122, 192, 0, 0.15);
	font-family: Keffeesatz, Arial;
	color: #4b4b4b;
	width: 800px;
	font-size: 14px;
	-webkit-border-radius: 5px;
	margin-bottom: 10px;
	padding-bottom: 7px;
	padding-left: 5px;
	padding-right: 30px;
	padding-top: 7px;
}
.form3 input:focus, textarea:focus {
	border: 1px solid #ff5400;
	background-color: rgba(255,255,255,1);
}
.form3 .select-style {
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
  
.form3 .gender {
  width:410px;
  }
.form3 input.buttom{
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
.form3 input.buttom:hover	{
	background-color: #C0C0C0;
}

.div likes{
	font-weight: bold;
	color: #58191E;
}
	
