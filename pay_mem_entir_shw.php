<?php
include "rdfl_connect.inc";
global $default_dbname,$pooling_pt_table,$pooling_mem_table;

if(isset($_POST['posted']))
{
 $code=$_POST['code'];
}

$link_id=db_connect($default_dbname);
if(!$link_id)
error_message(sql_error());

$query ="select sum(amount) from pooling_pt where code=$code";
$result=mysql_query($query);
if(!$result)
error_message(sql_error());
$query_data=mysql_fetch_row($result);
$payment=round($query_data[0],2);

$query="select name from $pooling_mem_table where code=$code";
$result=mysql_query($query);
if(!$result)
error_message(sql_error());
$query_data=mysql_fetch_row($result);
$name=$query_data[0];
?>
<html>
<head><title>RDFL Member's Payment</title></head>
<body bgcolor="#f1f1f1">
<div align="center">
<div style="margin-top=5px;width:500px;height:65px;background-image:url('images/logo_main.jpg');background-repeat:no-repeat;position:relative;" >
<img src="images\logo.gif" align="left" width="150" height="65"><br>
<center><font color=#19449b font-size="12"><b>Reliance Dairy Foods Ltd.,Sarsa</b></font><hr width="240" color=#acacff></center>
</div></div><br><br>
<!--<body bgcolor=#ddddff><font color=#hhhhhh weight="10"><center><b>Reliance Dairy Foods Ltd.,Sarsa</b></center></font><hr width="270" color=#acacff><br><br>-->
<center>Entire Payment For Selected Member</center><br>
<table border="3" width="60%" align="center">
<tr>
<th width="50%" nowrap><b>Code</b></th>
<td width="50%" align="center"><?php echo $code; ?></td>
</tr>
<tr>
<th width="50%" nowrap><b>Name</b></th>
<td width="50%" align="center"><?php echo $name; ?></td>
</tr>
<tr>
<th width="50%" nowrap><b>Payment</b></th>
<td width="50%" align="center"><?php echo $payment; ?></td>
</tr>
<tr><th colspan="2">
<input type="button" value="Ok" onclick="javascript:window.close();">
<input type="button" value="Print" onclick="javascript:window.print();window.close();">
</th></tr>
</table>
</body>
</html>
