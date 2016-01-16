<html>
<head><title>RDFL Browse Records</title></head>
<body bgcolor="#f1f1f1">
<div align="center">
<div style="margin-top=5px;width:500px;height:65px;background-image:url('images/logo_main.jpg');background-repeat:no-repeat;position:relative;" >
<img src="images\logo.gif" align="left" width="150" height="65"><br>
<center><font color=#19449b font-size="12"><b>Reliance Dairy Foods Ltd.,Sarsa</b></font><hr width="240" color=#acacff></center>
</div></div><br><br>
<!--<body bgcolor=#ddddff><font color=#hhhhhh weight="10"><center><b>Reliance Dairy Foods Ltd.,Sarsa</b></center></font><hr width="270" color=#acacff>-->


<?php
include "rdfl_connect.inc";

global $default_dbname,$pooling_pt_table;

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
$startyear=substr($sdate,6,4);
$endyear=substr($edate,6,4);

$link_id=db_connect($default_dbname);
if(!$link_id)
 error_message(sql_error());

$query="select count(*) from $pooling_pt_table where
        (code=$code and
        ((substr(date,1,2) >= $startdate and substr(date,4,2)=$startmonth and substr(date,7,4)=$startyear) and
         (substr(date,1,2) <= $enddate and substr(date,4,2)=$endmonth and substr(date,7,4)=$endyear)))";

$result=mysql_query($query);

if(!$result)
 error_message(sql_error());

$query_data=mysql_fetch_row($result);
$member_count=$query_data[0];
echo "<center>$member_count Record(s) Found For code:<b>$code</b> From <b>$sdate</b> To <b>$edate</b>.</center>";
?>

<table border="3" width="85%" align="center">
<tr>
<th width="20%" nowrap><b>CODE</b></th>
<th width="20%" nowrap><b>DATE</b></th>
<th width="20%" nowrap><b>SHIFT</b></th>
<th width="20%" nowrap><b>FAT</b></th>
<th width="20%" nowrap><b>SNF</b></th>
<th width="20%" nowrap><b>QUANTITY</b></th>
<th width="20%" nowrap><b>AMOUNT</b></th>
</tr>

<?php

$query="select * from $pooling_pt_table where
        (code=$code and
        ((substr(date,1,2) >= $startdate and substr(date,4,2)=$startmonth and substr(date,7,4)=$startyear) and
         (substr(date,1,2) <= $enddate and substr(date,4,2)=$endmonth and substr(date,7,4)=$endyear)))";

$result=mysql_query($query);

if(!$result)
 error_message(sql_error());

while($query_data=mysql_fetch_array($result))
{
 $code=$query_data['code'];
 $date=$query_data['date'];
 $shift=$query_data['shift'];
 $fat=$query_data['fat'];
 $snf=$query_data['snf'];
 $qty=$query_data['quantity'];
 $amount=$query_data['amount'];

echo "<tr>";
echo "<td align=\"center\" width=\"20%\">$code</th>";
echo "<td align=\"center\" width=\"20%\">$date</th>";
echo "<td align=\"center\" width=\"20%\">$shift</th>";
echo "<td align=\"center\" width=\"20%\">$fat</th>";
echo "<td align=\"center\" width=\"20%\">$snf</th>";
echo "<td align=\"center\" width=\"20%\">$qty</th>";
echo "<td align=\"center\" width=\"20%\">$amount</th>";
echo "</tr>";
}
$query="select sum(quantity) as qty_tot,sum(amount) as amt_tot from $pooling_pt_table where
        (code=$code and
        ((substr(date,1,2) >= $startdate and substr(date,4,2)=$startmonth and substr(date,7,4)=$startyear) and
         (substr(date,1,2) <= $enddate and substr(date,4,2)=$endmonth and substr(date,7,4)=$endyear)))";
$result=mysql_query($query);
if(!$result)
 error_message(sql_error());
$query_data=mysql_fetch_array($result);
$qty_tot=round($query_data['qty_tot'],2);
$amt_tot=round($query_data['amt_tot'],2);
echo "<tr>";
echo "<td align=\"center\" colspan=\"5\"><b>Total</b></td>";
echo "<td align=\"center\" width=\"20%\"><b>$qty_tot</b></td>";
echo "<td align=\"center\" width=\"20%\"><b>$amt_tot</b></td>";
echo "</tr>";
?>
<tr><th colspan="7"><input type="button" value="Ok" onclick="javascript:window.close();">
<input type="button" value="Print" onclick="javascript:window.print();window.close();">
</th></tr>
</table>
</body>
</html>