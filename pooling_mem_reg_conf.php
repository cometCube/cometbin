<?php
include "rdfl_connect.inc";

global $default_dbname,$pooling_mem_table;

if(isset($_POST['posted']))
{
 $name=$_POST['name'];
 $fname=$_POST['fname'];
 $ph_no=$_POST['ph_no'];
}

$link_id=db_connect($default_dbname);
if(!$link_id)
 error_message(sql_error());

$query="insert into $pooling_mem_table values(null,'$name','$fname','$ph_no')";
$result=mysql_query($query);
if(!$result)
 error_message(sql_error());
$code=mysql_insert_id($link_id);

if(empty($name))
 error_message("You Must Specify Member's Name?");
if(empty($fname))
 error_message("You Must Specify Member's Father Name ?");

date_default_timezone_set("Asia/Kolkata");
$date=date("d-m-Y",time());

?>
<html>
<head><title>RDFL Member Registeration</title></head>
<body bgcolor="#f1f1f1">
<div align="center">
<div style="margin-top=5px;width:500px;height:50px;background-image:url('images/logo_main.jpg');background-repeat:no-repeat;position:relative;" >
<img src="images\logo.gif" align="left" width="150" height="50">
<center><font color=#19449b font-size="12"><b>Reliance Dairy Foods Ltd.,Sarsa</b></font><hr width="240" color=#acacff></center>
</div></div><br><br>
<!--<body bgcolor=#ddddff></body><font color=#hhhhhh weight="10"><center><b>Reliance Dairy Foods Ltd.,Sarsa</b></center></font><hr width="270" color=#acacff>-->
<center><u>Member's Registration Details</u></center>
<form>
<table border="0" width="50%" align="center">
<tr><th><b>Code:</b></th><td><?php echo $code; ?></td></tr>
<tr><th><b>Name:</b></th><td><?php echo $name; ?></td></tr>
<tr><th nowrap><b>Father Name:</b></th><td><?php echo $fname; ?></td></tr>
<tr><th nowrap><b>Phone Number:</b></th><td><?php echo $ph_no; ?></td></tr>
<tr><th nowrap><b>Registration Date:</b></th><td><?php echo $date; ?></td></tr>
</table>
<hr width="270" color=#acacff>
<table border="0" width="50%" align="center">
<tr><th colspan="2"><input type="button" value="Ok" onclick="javascript:window.close();">
       <input type="button" value="Print" onclick="javascript:window.print();window.close();"></tr>
</table><hr width="270" color=#acacff>
</form>
</body>
</html>