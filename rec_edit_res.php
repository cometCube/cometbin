<html>
<head><title>RDFL Browse Records</title></head>
<body bgcolor="#f1f1f1">
<div align="center">
<div style="margin-top=5px;width:500px;height:65px;background-image:url('images/logo_main.jpg');background-repeat:no-repeat;position:relative;" >
<img src="images\logo.gif" align="left" width="150" height="65"><br>
<center><font color=#19449b font-size="12"><b>Reliance Dairy Foods Ltd.,Sarsa</b></font><hr width="240" color=#acacff></center>
</div></div><br>
<!--<body bgcolor=#ddddff><font color=#hhhhhh weight="10"><center><b>Reliance Dairy Foods Ltd.,Sarsa</b></center></font><hr width="270" color=#acacff>-->

<?php
include "rdfl_connect.inc";

$newdataset = simplexml_load_file("RC.xml");

if(isset($_POST['posted']))
{
 $cod=$_POST['cod'];
 $dat=$_POST['dat'];
 $shft=$_POST['shft'];
 $code=$_POST['code'];
 $date=$_POST['date'];
 $shift=$_POST['shift'];
 $fat=$_POST['fat'];
 $snf=$_POST['snf'];
 $qty=$_POST['qty'];
}

if($fat >= 50 && $fat <=150)
 {
  foreach($newdataset->RC_B[$fat-50]->children() as $nodes)
  $rate[]=$nodes;
  $rrate = $rate[$snf - 49];
  settype($rrate,"float");
 }
 else
 {
  foreach($newdataset->RC_C[$fat-30]->children() as $nodes)
  $rate[]=$nodes;
  $rrate = $rate[$snf - 49];
  settype($rrate,"float");
  $rrate = round($rrate,2);
 }
 $total = $rrate * $qty;
 settype($total,"float");
 $total = round($total,2);
?>

<form method="post" action="rec_edit_sav.php">
<input type="hidden" name="posted" value="true">
<input type="hidden" name="cod" value="<?php echo $cod; ?>">
<input type="hidden" name="dat" value="<?php echo $dat; ?>">
<input type="hidden" name="shft" value="<?php echo $shft; ?>">
<table width="60%" height="40%" border="3" align="center">
<tr>
<th width="40%" nowrap><b>Code</b></th>
<td width="60%" align="center"><input type="text" name="code" value="<?php echo $code; ?>" size="20" maxlength="8" readonly></td>
</tr>
<tr>
<th width="40%" nowrap><b>Date & Shift</b></th>
<td width="60%" align="center"><input type="text" name="date" value="<?php echo $date; ?>" size="20" readonly>
                               <input type="text" name="shift" value="<?php echo $shift; ?>" size="20" readonly></td>
</tr>
<tr>
<th width="40%" nowrap><b>Fat</b></th>
<td width="60%" align="center"><input type="text" name="fat" value="<?php echo $fat; ?>" size="20" readonly></td>
</tr>
<tr>
<th width="40%" nowrap><b>Snf</b></th>
<td width="60%" align="center"><input type="text" name="snf" value="<?php echo $snf; ?>" size="20" readonly></td>
</tr>
<tr>
<th width="40%" nowrap><b>Rate</b></th>
<td width="60%" align="center"><input type="text" name="rate" value="<?php echo $rrate; ?>" size="20" readonly></td>
</tr>
<tr>
<th width="40%" nowrap><b>Quantity</b></th>
<td width="60%" align="center"><input type="text" name="qty" value="<?php echo $qty; ?>" size="20" readonly></td>
</tr>
<tr>
<th width="40%" nowrap><b>Amount</b></th>
<td width="60%" align="center"><input type="text" name="total" value="<?php echo $total; ?>" size="20" readonly></td>
</tr>
<tr><th colspan="2">
<input type="submit" value="Save Record">
<input type="button" value="Cancel" onclick="javascript:history.go(-1);">
</th></tr>
</table>
</form>
</body>
</html>