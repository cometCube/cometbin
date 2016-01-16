<html>
<head><title>RDFL Payment Creation</title></head>
<body bgcolor="#f1f1f1">
<div align="center">
<div style="margin-top=5px;width:500px;height:65px;background-image:url('images/logo_main.jpg');background-repeat:no-repeat;position:relative;" >
<img src="images\logo.gif" align="left" width="150" height="65"><br>
<center><font color=#19449b font-size="12"><b>Reliance Dairy Foods Ltd.,Sarsa</b></font><hr width="240" color=#acacff></center>
</div></div><br><br>
<!--<body bgcolor=#ddddff><font color=#hhhhhh weight="10"><center><b>Reliance Dairy Foods Ltd.,Sarsa</b></center></font><hr width="270" color=#acacff><br><br>-->

<?php
include "rdfl_connect.inc";

global $default_dbname,$pooling_mem_table,$pooling_pt_table;

if(isset($_POST['posted']))
{
 $sdate=$_POST['sdate'];
 $edate=$_POST['edate'];
}

$startdate=substr($sdate,0,2);
$enddate=substr($edate,0,2);
$startmonth=substr($sdate,3,2);
$endmonth=substr($edate,3,2);
$startyear=substr($sdate,6,4);
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

<center>Payment From <b><?php echo $sdate; ?></b> To <b><?php echo $edate; ?></b></center><br>
<table border="1" width="80%" align="center">
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

?>

<tr>
<th colspan="2"><b>Total</b></th>
<td align="center" width="30%"><b><?php echo $total; ?></b></td>
</tr>


<tr><th colspan="4">
<input type="button" value="Ok" onclick="javascript:window.close();">
<input type="button" value="Print" onclick="javascript:window.print();window.close();">
</th></tr>
</table>
</body>
</html>