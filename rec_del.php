<html>
<head>
<title>RDFL Delete Record</title>
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
<form method="post" action="rec_del_shw.php">
<input type="hidden" name="posted" value="true">
<table width="60%" border="3" align="center">
<tr>
<th width="20%" nowrap><b>CODE:</b></th>
<td width="80%"><input type="text" name="code" size="10" maxlength="8" autofocus required></td>
</tr>
<tr>
<th width="20%" nowrap><b>DATE:</b></th>
<td width="80%">

<?php
date_default_timezone_set("Asia/Kolkata");
$date=date("d-m-Y",time());
?>

<input type="text" name="date" size="10" value="<?php echo $date;?>">
<a href="#" onClick="setYears(2001, 2099);showCalender(this, 'date');">
<img src="calender.png"></a>

</td>
</tr>
<tr>
<th width="20%" nowrap><b>SHIFT:</b></th>
<td width="80%"><select name="shift" size="1">
<option value="Mor">Morning</option>
<option value="Eve">Evening</option>
</select>
</td>
</tr>
<tr><th colspan="2">
<input type="submit" value="Delete Record">
<input type="reset" value="Cancel">
</th></tr>
</table>
</form>
</body>
</html>