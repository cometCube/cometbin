<html>
<head>
<title>RDFL Login</title>
<link rel="stylesheet" type="text/css" href="styles/mainnav.css" media="screen, projection, print"/> 
<script type="text/javascript">
function loginalert()
{
setTimeout(function(){alert("Please Login To Access RDFL......")},15000);
}

//<script type="text/javascript">
function startTime()
{
var today=new Date();
var h=today.getHours();
var m=today.getMinutes();
var s=today.getSeconds();
// add a zero in front of numbers<10
h=checkTime(h);
m=checkTime(m);
s=checkTime(s);
document.getElementById('txt').innerHTML=h+":"+m+":"+s;
t=setTimeout('startTime()',500);
}

function checkTime(i)
{
if (i<10)
  {
  i="0" + i;
  }
return i;
}
//</script>
</script>
</head>
<body style="background-image:url('images/back.jpg');background-repeat:no-repeat;position:relative;" onLoad="startTime()">
<?php echo "<script language=\"javascript\">loginalert();</script>";?>
<div align="center">
<div style="margin-top=5px;width:950px;height:150px;background-image:url('images/logo_main.jpg');background-repeat:no-repeat;position:relative;">
<img src="images/logo.gif" align="left" width="250" height="150"><br>
<center><font color=#19449b><h1><b>Reliance Dairy Foods Ltd.,Sarsa</b></h1></font><hr width="500" color=#19449b></center>
<b><div align="right"><font style="font-family:sans-serif;font-size:18px;color:#131313"><?php echo(date("l dS F, Y")); ?></font>
<!--<div id="txt"></div>-->
<object type="application/x-shockwave-flash"
data="styles/clock-183.swf"
width="100" height="25">
<param name="movie" value="styles/clock183.swf"/>
<param name="WMode" value="Transparent"/>
</object></div></b>
</div></div><br><br><br><br>
<div style="margin-top=5px;width:100%;height:50%;">
<form method="post" action="rdfl_home.php">
<input type="hidden" name="posted" value="true">

<table border="3" width="30%" height="25%" align="center" bordercolor="#454b49">
<tr>
<th width="40%" nowrap>Login-ID</th>
<td width="60%" align="center"><input type="text" name="admin_id" size="15" maxlength="10" spellcheck="false" autofocus required></td>
</tr>
<tr>
<th width="40%" nowrap>Login-Password</th>
<td width="60%" align="center"><input type="password" name="admin_passwd" size="15" maxlength="10" required></td>
</tr>
<tr>
<th colspan="2">
<input type="submit" name="submit" value="Login">
<input type="submit" name="reset" value="Cancel">
</th>
</tr>
</table><!--<br><br><br><br><br><br><br><br><br><br><br>--></form></div>
<div align="bottom">
<table width="960" border="0" cellspacing="0" cellpadding="0" align="center"> 
<tr valign="top"> 
 <td class="footer_background" valign="top">
  <table width="950" border="0" cellspacing="0" cellpadding="0" align="center" > 
   <tr valign="top"> 
    <td align="center" class="footer2" width="450" valign="top">
    <marquee behavior="alternate" scrollamount="2px" scrolldella="2">
    &copy; Application Developed &amp; Maintained By Curious Minds Lab</marquee><br/>
    <a href="mailto:vijayoncomet1@gmail.com"><b>Contact Us</b></a>
    </td> 
   </tr> 
  </table> 
 </td> 
 <td width="5" align="center">&nbsp;</td> 
</tr> 
</table> 
</div>
</body>
</html>