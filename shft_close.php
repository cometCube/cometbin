<html>
<head><title>RDFL SHIFT CLOSE</title></head>
<body bgcolor="#f1f1f1">
<div align="center">
<div style="margin-top=5px;width:500px;height:65px;background-image:url('images/logo_main.jpg');background-repeat:no-repeat;position:relative;" >
<img src="images\logo.gif" align="left" width="150" height="65"><br>
<center><font color=#19449b font-size="12"><b>Reliance Dairy Foods Ltd.,Sarsa</b></font><hr width="240" color=#acacff></center>
</div></div><br><br>
<!--<body bgcolor=#ddddff></body><font color=#hhhhhh weight="10"><center><b>Reliance Dairy Foods Ltd.,Sarsa</b></center></font><hr width="270" color=#acacff>-->
</body>
</html>

<?php
include "rdfl_connect.inc";
global $default_dbname,$pooling_pt_table,$pooling_mem;

$link_id=db_connect($default_dbname);
if(!$link_id)
{
 error_message(sql_error());
}

date_default_timezone_set("Asia/Kolkata");
$date=date("d-m-Y",time());
$hour=date("G");
$shift_options=enum_options('shift',$link_id);
$shift_status=enum_options('status',$link_id);

if($hour >=0 and $hour < 12)
{
 $shift=$shift_options[0];
}
else
{
 $shift=$shift_options[1];
}

$query="select status from $pooling_pt_table where date='$date' and shift='$shift'";
$result=mysql_query($query);
if(!$result)
 error_message(sql_error());
$query_data=mysql_fetch_row($result);
$status1=$query_data[0];
if($status1 == $shift_status[1])
 echo "<SCRIPT>window.alert(\"$shift Shift For Date:$date Has Already Been Dispatched ?\");history.go(-1);</SCRIPT>";


$query="update $pooling_pt_table set status='closed' where date='$date' and shift='$shift'";
$result=mysql_query($query);

if(!$result)
{
 error_message("Sorry An Error Occured While Dispatching $shift Shift For Date:$date ?Please Try Again");
}
else
{
 echo "<SCRIPT>window.alert(\"$shift Shift For Date:$date Is Dispatched Successfully\");</SCRIPT>";
}

$query = "SELECT COUNT(*) from $pooling_pt_table where date='$date' and shift='$shift'";
$result= mysql_query($query);
if(!$result)
error_message(sql_error());
$query_data=mysql_fetch_row($result);
$count=$query_data[0];

echo "<table border=\"3\" width=\"100%\" align=\"center\">";
echo "<tr><th width=\"15%\" nowrap><b>DATE:</b></th>";
echo "<td width=\"15%\"><input type=\"text\" name=\"date\" value=\"$date\" readonly></td></tr>";
echo "<tr><th width=\"15%\" nowrap><b>SHIFT:</b></th>";
echo "<td width=\"15%\"><input type=\"text\" name=\"shift\" value=\"$shift\" readonly></td></tr>";
echo "<tr><th width=\"15%\" nowrap>Counting Of Total Members Poured This Shift</th>";
echo "<td width=\"15%\">
      <input type=\"text\" name=\"count\" value=\"$count\" size=\"20\" readonly></td></tr>";

$query="SELECT round(sum(quantity),2) from $pooling_pt_table where date='$date' and shift='$shift'";
$result=mysql_query($query);
if(!$result)
error_message(sql_error());
$query_data=mysql_fetch_row($result);
$shft_tot_qty=$query_data[0];

echo "<tr><th width=\"15%\" nowrap>Quantity Of Total Milk Poured This Shift</th>";
echo "<td width=\"15%\">
          <input type=\"text\" name=\"shft_tot_qty\" value=\"$shft_tot_qty\" size=\"20\" readonly></td></tr>";

$query ="SELECT round(sum(amount),2) from $pooling_pt_table where date='$date' and shift='$shift'";
$result=mysql_query($query);
if(!$result)
error_message(sql_error());
$query_data=mysql_fetch_row($result);
$shft_tot_amt=$query_data[0];

echo "<tr><th width=\"15%\" nowrap>Sum Of Total Amount For This Shift</th>";
echo "<td width=\"15%\">
          <input type=\"text\" name=\"shft_tot_amt\" value=\"$shft_tot_amt\" size=\"20\" readonly></td></tr>";
echo "<tr><th colspan=\"2\"><input type=\"button\" value=\"Ok\" onclick=\"javascript:window.history.go(-1);\"></th></tr>";
echo "</table>";
?>

