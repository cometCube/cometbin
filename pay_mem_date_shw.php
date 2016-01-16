<?php
include "rdfl_connect.inc";
global $default_dbname,$pooling_pt_table,$pooling_mem_table;

if(isset($_POST['posted']))
{
 $code=$_POST['code'];
 $sdate=$_POST['sdate'];
 $edate=$_POST['edate'];
}

$startdate=substr($sdate,0,2);
$enddate=substr($edate,0,2);
$startmonth=substr($sdate,3,2);
$endmonth=substr($edate,3,2);
//echo $sdate;
//echo $edate;
$link_id=db_connect($default_dbname);
if(!$link_id)
error_message(sql_error());

$query="select sum(amount) from $pooling_pt_table where 
        (code=$code and 
        ((substr(date,1,2) >= $startdate and substr(date,4,2)=$startmonth) and 
         (substr(date,1,2) <= $enddate and substr(date,4,2)=$endmonth)))";

//$query ="select substr(date,1,2) from pooling_pt where code=3";
$result=mysql_query($query);
if(!$result)
error_message(sql_error());
$query_data=mysql_fetch_row($result);
$payment=round($query_data[0],2);
//echo $payment;

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
<center>Member Payment For Selected Dates</center><br>
<table border="3" width="70%" align="center">
<tr>
<th width="50%" nowrap><b>Code</b></th>
<td width="50%" align="center"><?php echo $code; ?></td>
</tr>
<tr>
<th width="50%" nowrap><b>Name</b></th>
<td width="50%" align="center"><?php echo $name; ?></td>
</tr>
<tr>
<th width="50%" nowrap><b>Opening Date</b></th>
<td width="50%" align="center"><?php echo $sdate; ?></td>
</tr>
<tr>
<th width="50%" nowrap><b>Closing Date</b></th>
<td width="50%" align="center"><?php echo $edate; ?></td>
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