<?php
include "rdfl_connect.inc";
global $default_dbname,$pooling_pt_table,$pooling_mem_table;

$link_id=db_connect($default_dbname);
if(!$link_id)
error_message(sql_error());
$shift_options=enum_options('shift',$link_id);
mysql_close($link_id);
date_default_timezone_set("Asia/Kolkata");
$date=date("d-m-Y",time());
?>

<html>
<head>
<title>RDFL Pooling Point</title>
<link href="calendar.css" rel="stylesheet" type="text/css" media="screen">
<script language="javaScript" type="text/javascript" src="calendar.js"></script> 
</head>
<body bgcolor="#f1f1f1">
<div align="center">
<div style="margin-top=5px;width:500px;height:65px;background-image:url('images/logo_main.jpg');background-repeat:no-repeat;position:relative;" >
<img src="images\logo.gif" align="left" width="150" height="65"><br>
<center><font color=#19449b font-size="12"><b>Reliance Dairy Foods Ltd.,Sarsa</b></font><hr width="240" color=#acacff></center>
</div></div><br>
<!--<body bgcolor=#ddddff><font color=#hhhhhh weight="10"><center><b>Reliance Dairy Foods Ltd.,Sarsa</b></center></font><hr width="270" color=#acacff>-->
<form method="post" action="rdfltest1.php">
<input type="hidden" name="posted" value="true">
<table border="3" align="center">
<tr>
<th width="5%" nowrap><b>DATE:</b></th>
<td width="58%">


<input type="text" name="datum" value="<?php echo $date;?>">
<a href="#" onClick="setYears(2001, 2099);showCalender(this, 'datum');">
<img src="calender.png"></a>

	
<!-- Calender Script  --> 

 <table id="calenderTable">
 <tbody id="calenderTableHead">
 <tr>
 <td colspan="3" align="center">
 <select onChange="showCalenderBody(createCalender(document.getElementById('selectYear').value,this.selectedIndex, false));" id="selectMonth">
   <option value="0">Jan</option>
   <option value="1">Feb</option>
   <option value="2">Mar</option>
   <option value="3">Apr</option>
   <option value="4">May</option>
   <option value="5">Jun</option>
   <option value="6">Jul</option>
   <option value="7">Aug</option>
   <option value="8">Sep</option>
   <option value="9">Oct</option>
   <option value="10">Nov</option>
   <option value="11">Dec</option>
 </select>
 </td>
 <td colspan="3" align="center">
 <select onChange="showCalenderBody(createCalender(this.value, document.getElementById('selectMonth').selectedIndex, false));" id="selectYear">
 </select>
 </td>
 <td align="center">
 <a href="#" onClick="closeCalender();"><font color="#003333" size="+1">X</font></a>
 </td>
 </tr>
 </tbody>
 <tbody id="calenderTableDays">
 <tr style="">
 <td>Sun</td><td>Mon</td><td>Tue</td><td>Wed</td><td>Thu</td><td>Fri</td><td>Sat</td>
 </tr>
 </tbody>
 <tbody id="calender"></tbody>
 </table>

<!-- End Calender Script  --> 

</td>
<th width="15%" nowrap><b>SHIFT:</b></th><td width="20%"><select name="shift" size="1">

<?php
date_default_timezone_set("Asia/Kolkata");
$hour=date("G");
for($i=0;$i<count($shift_options);$i++)
{
  /*if(!isset($shift) && $i == 0)
  {
   echo "<OPTION SELECTED VALUE = \"" . $shift_options[$i] . "\">" . $shift_options[$i] ."</OPTION>\n";
  }
  else*/
  if($hour >= 0 && $hour < 12)
  {
   if(!isset($shift) && $i == 0)
   {
    echo "<OPTION SELECTED VALUE = \"" . $shift_options[$i] . "\">" . $shift_options[$i] ."</OPTION>\n";
   }
   else
   {
    echo "<OPTION VALUE = \"" . $shift_options[$i] . "\">" . $shift_options[$i] ."</OPTION>\n";
   }
  }
  else
  {
   if($shift == $cshift_options[$i])
   {
    echo "<OPTION SELECTED VALUE = \"" . $shift_options[$i] . "\">" . $shift_options[$i] ."</OPTION>\n";
   }
   else
   {
    echo "<OPTION VALUE = \"" . $shift_options[$i] . "\">" . $shift_options[$i] ."</OPTION>\n";
   }
  }
}
?>

</td>
</tr>
</table><hr color=#acacac>
<table border="3" width="50%" align="left">
<tr><th width="30%" nowrap><b>CODE:</b></th>
<td width="70%" align="center"><input type="text" name="code" size="20" maxlength="8" autofocus autocomplete="off" required><br></td></tr>
<tr><th width="30%" nowrap><b>FAT:</b></th>
<td width="70%" align="center"><input type="text" name="fat" size="20" maxlength="3" autocomplete="off" required><br></td></tr>
<tr><th width="30%" nowrap><b>SNF:</b></th>
<td width="70%" align="center"><input type="text" name="snf" size="20" maxlength="3" autocomplete="off" required><br></td></tr>
<tr><th width="30%" nowrap><b>QUANTITY:</b></th>
<td width="70%" align="center" ><input type="text" name="qty" size="20" maxlength="7" autocomplete="off" required><br></td></tr>
<tr><th colspan="2"><input type="submit" value="Submit"><input type="reset" value="Cancel"></th></tr>
</table>

<?php

date_default_timezone_set("Asia/Kolkata");
$date=date("d-m-Y",time());
$hour=date("G");
//echo $date;
//echo $hour;
if($hour >= 0 and $hour < 12)
 $shift=$shift_options[0];
else
 $shift=$shift_options[1];
//echo $shift;

$link_id=db_connect($default_dbname);
if(!$link_id)
error_message(sql_error());

$query = "SELECT COUNT(*) from $pooling_pt_table where date='$date' and shift='$shift'";
$result= mysql_query($query);
if(!$result)
error_message(sql_error());
$query_data=mysql_fetch_row($result);
$count=$query_data[0];
//echo $count;
echo "<table border=\"3\" width=\"45%\" align=\"right\">";
echo "<tr><th nowrap>Counting Of Total Members Poured This Shift</th></tr>";
echo "<tr><td align=\"center\">
          <input type=\"text\" name=\"count\" value=\"$count\" size=\"20\" readonly></td></tr>";

$query="SELECT round(sum(quantity),2) from $pooling_pt_table where date='$date' and shift='$shift'";
$result=mysql_query($query);
if(!$result)
error_message(sql_error());
$query_data=mysql_fetch_row($result);
$shft_tot_qty=$query_data[0];

echo "<tr><th nowrap>Quantity Of Total Milk Poured This Shift</th></tr>";
echo "<tr><td align=\"center\">
          <input type=\"text\" name=\"shft_tot_qty\" value=\"$shft_tot_qty\" size=\"20\" readonly></td></tr>";

$query ="SELECT round(sum(amount),2) from $pooling_pt_table where date='$date' and shift='$shift'";
$result=mysql_query($query);
if(!$result)
error_message(sql_error());
$query_data=mysql_fetch_row($result);
$shft_tot_amt=$query_data[0];

echo "<tr><th nowrap>Sum Of Total Amount For This Shift</th></tr>";
echo "<tr><td align=\"center\">
          <input type=\"text\" name=\"shft_tot_amt\" value=\"$shft_tot_amt\" size=\"20\" readonly></td></tr>";

echo "</table>";
?>
</form>
<form>
<table border="3" width="100%" align="bottom">
<tr><th colspan="2">
<input type="button" value="Dispatch Shift" onclick="javascript:window.location.href='shft_close.php';">
<input type="button" value="Quit" onclick="javascript:window.close();">
</th></tr>
</table>
</form>
</body>
</html>