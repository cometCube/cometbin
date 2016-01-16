<?php
include "rdfl_connect.inc";
global $default_dbname,$pooling_mem;

$link_id=db_connect($default_dbname);

if(!$link_id)
{
 error_message(sql_error());
}

$shift_options=enum_options('status',$link_id);


if(isset($_POST['post']))
{
 $date=$_POST['date'];
 $shift=$_POST['shift'];
 $code=$_POST['code'];
 $fat=$_POST['fat'];
 $snf=$_POST['snf'];
 $qty=$_POST['qty'];
 $rate=$_POST['rate'];
 $total=$_POST['total'];
}

$query="select status from $pooling_pt_table where date='$date' and shift='$shift'";
$result=mysql_query($query);
if(!$result)
 error_message(sql_error());
$query_data=mysql_fetch_row($result);
$status1=$query_data[0];

if($status1==$shift_options[1])
{
 echo "<script>window.alert(\"Sorry ? $shift Shift For Date:$date Is Close ? You Cann't Work With This Shift Anymore\");
         window.location.href='rdfltest.php';</script>";
}
else
{
 $query="insert into $pooling_pt_table values($code,'$date','$shift',$fat,$snf,$qty,$total,'open')";
 $result=mysql_query($query);
 if(!$result)
  error_message(sql_error());
}
?>

<html>
<head><title>RDFL Pooling Point</title></head>
<body bgcolor="#f1f1f1">
<div align="center">
<div style="margin-top=5px;width:500px;height:50px;background-image:url('images/logo_main.jpg');background-repeat:no-repeat;position:relative;" >
<img src="images\logo.gif" align="left" width="150" height="50"><br>
<center><font color=#19449b font-size="12"><b>Reliance Dairy Foods Ltd.,Sarsa</b></font><hr width="240" color=#acacff></center>
</div></div><br><br>
<!--<body bgcolor=#ddddff><font color=#hhhhhh weight="10"><center><b>Reliance Dairy Foods Ltd.,Sarsa</b></center></font><hr width="270" color=#acacff>-->
<form>
<table border="0" width="50%" align="center">
<tr><th><b>DATE:</b></th><td><?php echo $date; ?></td></tr>
<tr><th nowrap><b>SHIFT:</b></th><td><?php echo $shift; ?></td></tr>
<tr><th nowrap><b>CODE:</b></th><td><?php echo $code; ?></td></tr>
<tr><th nowrap><b>FAT:</b></th><td><?php echo $fat; ?></td></tr>
<tr><th nowrap><b>SNF:</b></th><td><?php echo $snf; ?></td></tr>
<tr><th nowrap><b>RATE:</b></th><td><?php echo $rate; ?></td></tr>
<tr><th nowrap><b>QUANTITY:</b></th><td><?php echo $qty; ?></td></tr>
<tr><th nowrap><b>TOTAL:</b></th><td><?php echo $total; ?></td></tr>
</table>
<hr width="270" color=#acacff>
<table border="0" width="50%" align="center">
<tr><th colspan="2"><input type="button" value="Ok" onclick="javascript:window.location.href='rdfltest.php';">
       <input type="button" value="Print" onclick="javascript:window.print();window.location.href='rdfltest.php';"></tr>
</table><hr width="270" color=#acacff>
</form>
</body>
</html>