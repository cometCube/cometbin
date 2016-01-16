<html>
<head><title>RDFL Members</title></head>
<body bgcolor="#f1f1f1">
<div align="center">
<div style="margin-top=5px;width:500px;height:50px;background-image:url('images/logo_main.jpg');background-repeat:no-repeat;position:relative;" >
<img src="images\logo.gif" align="left" width="150" height="50">
<center><font color=#19449b font-size="12"><b>Reliance Dairy Foods Ltd.,Sarsa</b></font><hr width="240" color=#acacff></center>
</div></div><br><br>
<!--<body bgcolor=#ddddff></body><font color=#hhhhhh weight="10"><center><b>Reliance Dairy Foods Ltd.,Sarsa</b></center></font><hr width="270" color=#acacff>-->
<?php
include "rdfl_connect.inc";

global $default_dbname,$pooling_mem_table;

$link_id=db_connect($default_dbname);
if(!$link_id)
 error_message(sql_error());

$query="select count(*) from $pooling_mem_table";
$result=mysql_query($query);

if(!$result)
 error_message(sql_error());

$query_data=mysql_fetch_row($result);
$member_count=$query_data[0];
echo "<center>$member_count Member(s) Found.</center>";
?>

<table border="3" width="80%" align="center">
<tr>
<th width="20%" nowrap><b>Code</b></th>
<th width="20%" nowrap><b>Member Name</b></th>
<th width="20%" nowrap><b>Father Name</b></th>
<th width="20%" nowrap><b>Phone Number</b></th>
</tr>

<?php

$query="select * from $pooling_mem_table";
$result=mysql_query($query);

if(!$result)
 error_message(sql_error());

while($query_data=mysql_fetch_array($result))
{
 $code=$query_data['code'];
 $name=$query_data['name'];
 $fname=$query_data['fname'];
 $ph_no=$query_data['ph_no'];

echo "<tr>";
echo "<td align=\"center\" width=\"20%\">$code</th>";
echo "<td align=\"center\" width=\"20%\">$name</th>";
echo "<td align=\"center\" width=\"20%\">$fname</th>";
echo "<td align=\"center\" width=\"20%\">$ph_no</th>";
echo "</tr>";
}
?>
<tr><th colspan="4"><input type="button" value="Ok" onclick="javascript:window.close();"></th></tr>
</table>
</body>
</html>