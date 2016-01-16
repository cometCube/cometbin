<html>
<head>
<title>RDFL Edit & Modify Record</title>
<script language="javaScript" type="text/javascript" src="calendar.js"></script>
<link href="calendar.css" rel="stylesheet" type="text/css">

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

</head>
<body bgcolor="#f1f1f1">
<div align="center">
<div style="margin-top=5px;width:500px;height:65px;background-image:url('images/logo_main.jpg');background-repeat:no-repeat;position:relative;" >
<img src="images\logo.gif" align="left" width="150" height="65"><br>
<center><font color=#19449b font-size="12"><b>Reliance Dairy Foods Ltd.,Sarsa</b></font><hr width="240" color=#acacff></center>
</div></div><br><br>
</body>
</html>

<?php
include "rdfl_connect.inc";

global $default_dbname,$pooling_pt_table;

if(isset($_POST['posted']))
{
 $code=$_POST['code'];
 $date=$_POST['date'];
 $shift=$_POST['shift'];
}

$link_id=db_connect($default_dbname);
if(!$link_id)
error_message(sql_error());

$query="select count(*) from $pooling_pt_table where code=$code and date='$date' and shift='$shift'";
$result=mysql_query($query);
if(!$result)
error_message(sql_error());
$query_data=mysql_fetch_row($result);
$count=$query_data[0];
if($count>0)
{
$query="select * from $pooling_pt_table where code=$code and date='$date' and shift='$shift'";
$result=mysql_query($query);
if(!$result)
error_message(sql_error());
while($query_data=mysql_fetch_array($result))
{
 $code=$query_data['code'];
 $fat=$query_data['fat'];
 $snf=$query_data['snf'];
 $qty=$query_data['quantity'];

echo "<form method=\"post\" action=\"rec_edit_res.php\">";
echo "<input type=\"hidden\" name=\"posted\" value=\"true\">";
echo "<input type=\"hidden\" name=\"cod\" value=\"$code\">";
echo "<input type=\"hidden\" name=\"dat\" value=\"$date\">";
echo "<input type=\"hidden\" name=\"shft\" value=\"$shift\">";

echo "<table border=\"3\" width=\"60%\" align=\"center\">";
echo "<tr>";
echo "<th width=\"50%\" nowrap><b>Code</b></th>";
echo "<td width=\"50%\"><input type=\"text\" name=\"code\" value=\"$code\"></td>";
echo "</tr>";

date_default_timezone_set("Asia/Kolkata");
//$date=date("d-m-Y",time());

echo "<tr>";
echo "<th width=\"50%\" nowrap><b>Date</b></th>";
echo "<td width=\"50%\"><input type=\"text\" name=\"date\" size=\"10\" value=\"$date\">
        <a href=\"#\" onClick=\"setYears(2001, 2099);showCalender(this, 'date');\">
        <img src=\"calender.png\"></a></td>";
echo "</tr>";
echo "<tr>";
echo "<th width=\"50%\" nowrap><b>Shift</b></th>";
echo "<td width=\"50%\"><select name=\"shift\" size=\"1\">
       <option value=\"Mor\">Morning</option>
       <option value=\"Eve\">Evening</option>
       </select></td>";
echo "</tr>";
echo "<tr>";
echo "<th width=\"50%\" nowrap><b>Fat</b></th>";
echo "<td width=\"50%\"><input type=\"text\" name=\"fat\" value=\"$fat\"></td>";
echo "</tr>";
echo "<tr>";
echo "<th width=\"50%\" nowrap><b>Snf</b></th>";
echo "<td width=\"50%\"><input type=\"text\" name=\"snf\" value=\"$snf\"></td>";
echo "</tr>";
echo "<tr>";
echo "<th width=\"50%\" nowrap><b>Quantity</b></th>";
echo "<td width=\"50%\"><input type=\"text\" name=\"qty\" value=\"$qty\"></td>";
echo "</tr>";
echo "<tr><th colspan=\"2\">";
echo "<input type=\"submit\" value=\"Ok\">";
echo "<input type=\"button\" value=\"Cancel\" onclick=\"javascript:history.go(-1);\">";
echo "</th></tr>";
echo "</table>";
echo "</form>";
}
}
else
{
 echo "<script language=\"javascript\">window.alert(\"Sorry,No Record Found For Code:$code From $date $shift\");history.go(-1);</script>";
}
?>