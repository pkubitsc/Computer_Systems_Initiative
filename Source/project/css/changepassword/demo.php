<? header ("Content-type: text/css");?>
<?php $base_url = $_GET['url']; ?>

/* CSS reset */
body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,textarea,p,blockquote,th,td {
	margin-bottom: 0;
	margin-left: 0;
	margin-top: -10px;
	padding-bottom: 0;
	padding-left: 10px;
	padding-right: 0px;
	padding-top: 10px;
}
html,body {
	margin: 0;
	height: 100%;
}
table {
	border-collapse:collapse;
	border-spacing:0;
}
img { 
	border:0;
}
address,caption,cite,code,dfn,th,var {
	font-style:normal;
	font-weight:normal;
}
ol,ul {
	list-style:none;
}
caption,th {
	text-align:left;
}
h1,h2,h3,h4,h5,h6 {
	font-size:100%;
	font-weight:normal;
}
header{
	display: block;
}
/* General Demo Style */
body{
	font-family: Cambria, Palatino, "Palatino Linotype", "Palatino LT STD", Georgia, serif;
	background:url(<?php echo $base_url; ?>images/register/bgnoise_lg.jpg);
	font-weight: 400;
	font-size: 15px;
	color: #3a2127;
	overflow-y: scroll;
}
a{
	color: #333;
	text-decoration: none;
}
.container{
	width: 100%;
	height: 100%;
	position: relative;
}
.clr{
	clear: both;
}
.container > header{
	padding: 20px 30px 20px 30px;
	margin: 0px 20px 10px 20px;
	position: relative;
	display: block;
	text-shadow: 1px 1px 1px rgba(0,0,0,0.2);
    text-align: center;
}
.container > header h1{
	position: relative;
	color: #FFFFFF;
	font-weight: 700;
	font-style: normal;
	font-size: 30px;
	padding: 0px 0px 5px 0px;
	text-shadow: 0px 1px 1px rgba(255,255,255,0.8);
}
.container > header h1 span{
	font-family: 'Alegreya SC', Georgia, serif;
	font-size: 20px;
	line-height: 20px;
	display: block;
	font-weight: 400;
	font-style: italic;
	color: #719dab;
	text-shadow: 1px 1px 1px rgba(0,0,0,0.1);
}
.container > header h2{
	font-size: 16px;
	font-style: italic;
	color: #2d6277;
	text-shadow: 0px 1px 1px rgba(255,255,255,0.8);
}
/* Header Style */
.freshdesignweb-top{
	line-height: 24px;
	font-size: 11px;
	background: rgba(0, 0, 0, 0.05);
	text-transform: uppercase;
	z-index: 9999;
	position: relative;
	box-shadow: 1px 0px 2px rgba(0,0,0,0.2);
}
.freshdesignweb-top a{
	padding: 0px 10px;
	letter-spacing: 1px;
	color: #333;
	text-shadow: 0px 1px 1px #fff;
	display: block;
	float: left;
}
.freshdesignweb-top a:hover{
	background: #fff;
}
.freshdesignweb-top span.right{
	float: right;
}
.freshdesignweb-top span.right a{
	float: left;
	display: block;
}
.freshdesignweb-demos{
    text-align:center;
	display: block;
	line-height: 30px;
	padding: 20px 0px;
}
.freshdesignweb-demos a{
    display: inline-block;
	margin: 0px 4px;
	padding: 0px 4px;
	color: #fff;
	line-height: 20px;	
	font-style: italic;
	font-size: 13px;
	border-radius: 3px;
	background: rgba(41,77,95,0.1);
	-webkit-transition: all 0.2s linear;
	-moz-transition: all 0.2s linear;
	-o-transition: all 0.2s linear;
	-ms-transition: all 0.2s linear;
	transition: all 0.2s linear;
}
.freshdesignweb-demos a:hover{
	background: rgba(41,77,95,0.3);
}
.freshdesignweb-demos a.current,
.freshdesignweb-demos a.current:hover{
	background: rgba(41,77,95,0.3);
}
