<?php
include "rdfl_connect.inc";
global $default_dbname,$pooling_pt_table;

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
 //$rate=$_POST['rate'];
 $qty=$_POST['qty'];
 $total=$_POST['total'];
}

$link_id=db_connect($default_dbname);
if(!$link_id)
error_message(sql_error());

$field_str="code='$code',";
$field_str.="date='$date',";
$field_str.="shift='$shift',";
$field_str.="fat='$fat',";
$field_str.="snf='$snf',";
$field_str.="quantity='$qty',";
$field_str.="amount='$total'";

$query="update $pooling_pt_table set $field_str where code='$cod' and date='$dat' and shift='$shft'";
$result=mysql_query($query);
if(!$result)
error_message(sql_error());

$mod_rec=mysql_affected_rows($link_id);
if($mod_rec)
{
 echo "<script language=\"javascript\">window.alert(\"Record Of Code:$cod For $dat $shft Modified Successfully !\");window.close();</script>";
}
else
{
 echo "<script language=\"javascript\">window.alert(\"Sorry,No Modifications Done To Record!\");window.close();</script>";
}

?>