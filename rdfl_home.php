<?php
include "rdfl_connect.inc";

global $default_dbname,$pooling_pt_table,$pooling_mem_table;

if(isset($_POST['posted']))
{
 $admin_id=$_POST['admin_id'];
 $admin_passwd=$_POST['admin_passwd'];

 if(!isset($admin_id))
 {
  echo "<script language=\"javascript\">javascript:window.alert(\"Enter Valid Login-ID ?\");history.go(-1);</script>";
 }
 else
 {
  session_start();
  @session_register('$admin_id','$admin_passwd');
  $name=auth_login($admin_id,$admin_passwd);
  if(!$name)
  {
   //$PHP_SELF=$_SERVER['PHP_SELF'];
   @session_unregister('$admin_id');
   @session_unregister('$admin_passwd');
   //echo "Authorization Failed ?.You Must Enter Valid Login-ID and Password<br>\n";
   //echo "<a href=\"$PHP_SELF\">Click Here To Try Again</a>";
   echo "<script language=\"javascript\">javascript:window.alert(\"Admin Not Found ? Try Again......\");history.go(-1);</script>";
  }
  else
  {
   //echo "Login Successfully !";
   //echo "<script language=\"javascript\">javascript:window.location.href='rdfl_home.php';</script>";
  
?>
<html>
<head>
<title>RDFL Home</title>
<link rel="stylesheet" type="text/css" href="styles/mainnav.css" media="screen, projection, print"/>
<script type="text/javascript">

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

function stopmar(tmp)
{
tmp.stop();
}
 
function startmar(tmp)
{
tmp.start();
}

function payalert(msg)
{
setTimeout(function(){alert(msg)},15000);
}

</script>

</head>
<body style="background-image:url('images/back.jpg');background-repeat:no-repeat;position:relative;" onLoad="startTime()">

<?php
$date=date("d");
if($date==01 or $date==11 or $date==21)
{
$date=date("l dS F Y");
echo "<script language=\"javascript\">payalert(\"Today is $date ! You Have To Take Print-Out Of Payment.\");</script>";
}
?>

<div align="center">
<div style="margin-top=5px;width:950px;height:150px;background-image:url('images/logo_main.jpg');background-repeat:no-repeat;position:relative;" >
<img src="images\logo.gif" align="left" width="250" height="150"><br>
<center><font color=#19449b><h1><b>Reliance Dairy Foods Ltd.,Sarsa</b></h1></font><hr width="500" color=#19449b></center>
<b><div align="right"><font style="font-family:sans-serif;font-size:18px;color:#131313"><?php echo(date("l dS F, Y")); ?></font>
<!--<div id="txt"></div>-->
<object type="application/x-shockwave-flash"
data="styles/clock-183.swf"
width="100" height="25">
<param name="movie" value="styles/clock183.swf"/>
<param name="WMode" value="Transparent"/>
</object><embed src="styles/Logon.wav" width="1" height="1"/></div></b>
</div></div>
<div align="center">
<!--HTML code for the menu -->
<!--<table width="960" border="1" cellspacing="0" cellpadding="0" align="center"> 
 <tr> 
  <td width="5" align="center">&nbsp;</td> 
   <td align="center">-->
    <table width="950" cellpadding="0" cellspacing="0" align="center" border="0"> 
     <tr > 
      <td align="center" id="menu"> 
       <ul>
        <!--<li><a href="#">Home</a></li>-->
        <li><a href="#">Members</a>
         <ul>
          <li><a href="javascript:openwin('pooling_mem_reg.php');">Register</a></li>
          <li><a href="javascript:openwin('pooling_mem_srch.php');">Search</a></li>
          <li><a href="javascript:openwin('pooling_mem_list.php');">See All Members</a></li>
         </ul>
        </li>
        <li><a href="javascript:openwin('rdfltest.php');">Pooling Point</a></li>
        <li><a href="#">Payment</a>
         <ul>
          <li><a href="javascript:openwin('pay_mem_entir.php');">Member's Entire Payment</a></li>
          <li><a href="javascript:openwin('pay_mem_date.php');">Member's Payment For Selected Dates</a></li>
          <li><a href="javascript:openwin('pay_shft.php');">Payment For 10 Days</a></li>
         </ul>
        </li>
        <li><a href="#">Records</a>
        <ul>
          <li><a href="javascript:openwin('rec_date.php');">Records For Selected Date & Shift</a></li>
          <li><a href="javascript:openwin('rec_code.php');">Records For Selected Code,Date & Shift</a></li>
          <li><a href="javascript:openwin('rec_code_date.php');">Records For Selected Code Between Dates</a></li>
          <li><a href="javascript:openwin('rec_edit.php');">Edit & Modify Record</a></li> 
          <li><a href="javascript:openwin('rec_del.php');">Delete Record</a></li>
        </ul>
        </li>
        <li><a href="javascript:openwin('import_rate.php');">Import Rate</a></li>
        <li><a href="javascript:window.location.href='rdfl_logout.php';">Logout</a></li>
    </ul>
</td> 
</tr> 
</table><!--<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>-->

<div align="center">
<!--<div style="background-color:#ddddff; font-weight:bolder; font-size:120%"><center>Notification</center></div>-->
<marquee direction="up" style="color:#0d2c7c;width:950px;height:355px;font-size:100%" scrolldelay="400" onMouseOver="stopmar(this)" onMouseOut="startmar(this)">

<?php

$tmp_date=date("d");
if($tmp_date >= 01 And $tmp_date <= 10)
{
 $sdate=01;
}
else if($tmp_date >= 11 And $tmp_date <= 20)
{
 $sdate=11;
}
else
{
 $sdate=21;
}
//echo $sdate;
$edate=date("d-m-Y");
//echo $edate;

$startdate=$sdate;
$enddate=substr($edate,0,2);
$startmonth=substr($edate,3,2);
$endmonth=substr($edate,3,2);
$startyear=substr($edate,6,4);
$endyear=substr($edate,6,4);

$link_id=db_connect($default_dbname);
if(!$link_id)
error_message(sql_error());

$query="select code,sum(amount) as payment from $pooling_pt_table where 
        ((substr(date,1,2) >= $startdate and substr(date,4,2)=$startmonth and substr(date,7,4)=$startyear) and 
        (substr(date,1,2) <= $enddate and substr(date,4,2)=$endmonth and substr(date,7,4)=$endyear)) group by code";

$result=mysql_query($query);
if(!$result)
error_message(sql_error());
?> 
<table border="3" bordercolor="#454b49" width="80%" align="center">
<tr>
<th width="30%" nowrap><b>Code</b></th>
<th width="30%" nowrap><b>Member Name</b></th>
<th width="30%" nowrap><b>Payment</b></th>
</tr>

<?php
while($query_data=mysql_fetch_array($result))
{
 $code=$query_data['code'];
 $payment=round($query_data['payment'],2);
$query1="select name,fname from $pooling_mem_table where code=$code";
$result1=mysql_query($query1);
if(!$result1)
error_message(sql_error());
$query_data1=mysql_fetch_row($result1);
$name=$query_data1[0];

echo "<tr>";
echo "<td align=\"center\" width=\"30%\">$code</td>";
echo "<td align=\"center\" width=\"30%\">$name</td>";
echo "<td align=\"center\" width=\"30%\">$payment</td>";
echo "</tr>";
}

$query2="select sum(amount) as total from $pooling_pt_table where 
        ((substr(date,1,2) >= $startdate and substr(date,4,2)=$startmonth and substr(date,7,4)=$startyear) and 
        (substr(date,1,2) <= $enddate and substr(date,4,2)=$endmonth and substr(date,7,4)=$endyear))";
$result2=mysql_query($query2);
if(!$result2)
error_message(sql_error());
$query_data2=mysql_fetch_row($result2);
$total=round($query_data2[0],2);

echo "<tr>";
echo "<th colspan=\"2\"><b>Total</b></th>";
echo "<td align=\"center\" width=\"30%\"><b>$total</b></td>";
echo "</tr>";
?>
</table>
</marquee> 
</div>

<table width="950" border="0" cellspacing="0" cellpadding="0" align="center"> 
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

<?php


  }
 }

} 

function auth_login($admin_id,$admin_passwd)
{
 global $default_dbname,$rdfl_admin_table;

 $link_id=db_connect($default_dbname);
 if(!$link_id)
 error_message(sql_error());
 $query="select name from $rdfl_admin_table where admin_id='$admin_id' and admin_passwd=password('$admin_passwd')";
 $result=mysql_query($query);
 if(!$result)
 error_message(sql_error());
 if(!mysql_num_rows($result))
 {
  //echo "<script language=\"javascript\">javascript:window.alert(\"Admin Not Found ? Try Again......\");history.go(-1);</script>";
  return 0;
 }
 else
 {
  $query_data=mysql_fetch_row($result);
  return $query_data[0];
  //echo "<script language=\"javascript\">javascript:window.location.href='js_menu.php';</script>";
 }
}
?>