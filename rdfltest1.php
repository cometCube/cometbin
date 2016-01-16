<?php
include "rdfl_connect.inc";

 $newdataset = simplexml_load_file("RC.xml");
 if(isset($_POST['posted']))
 {
  $date=$_POST['datum'];
  $shift=$_POST['shift'];
  $code=$_POST['code'];
  $fat=$_POST['fat'];
  $snf=$_POST['snf'];
  $qty=$_POST['qty'];
  settype($qty,"float");
  $qty = round($qty,1);
  $count=$_POST['count'];
  $shft_tot_qty=$_POST['shft_tot_qty'];
  $shft_tot_amt=$_POST['shft_tot_amt'];
 }
 
 $link_id = db_connect($default_dbname);
 if(!$link_id)
  error_message(sql_error());
 
 if(not_mem($code))
   echo "<script>javascript:alert('Member Not Found ? Please Register The Member On Registration !');
                 javascript:openwin('pooling_mem_reg.php');history.go(-1);</script>";
 if(empty($fat))
  error_message("Please Enter Valid FAT !");
 if($fat < 30 or $fat > 150)
  error_message("Invalid Value Entered For FAT Field ?");
 if(empty($snf))
  error_message("Please Enter Valid SNF !");
 if($snf < 50 or $snf > 150)
  error_message("Invalid Value Entered For SNF Field ?");
 

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



<?php
echo "<html>";
echo "<head><title>RDFL Pooling Point</title></head>";
echo "<body bgcolor=\"#f1f1f1\">";
echo "<div align=\"center\">";
echo "<div style=\"margin-top=5px;width:500px;height:60px;background-image:url('images/logo_main.jpg');background-repeat:no-repeat;position:relative;\">";
echo "<img src=\"images\\logo.gif\" align=\"left\" width=\"150\" height=\"60\"><br>";
echo "<center><font color=\"#19449b\" font-size=\"12\"><b>Reliance Dairy Foods Ltd.,Sarsa</b></font><hr width=\"240\" color=\"#acacff\"></center>";
echo "</div></div><br>";
//echo "<body bgcolor=#ddddff><font color=#hhhhhh weight=\"10\"><center><b>Reliance Dairy Foods Ltd.,Sarsa</b></center></font><hr width=\"270\" color=#acacff>";
echo "<form method=\"post\" action=\"rdfltest2.php\">";
echo "<input type=\"hidden\" name=\"post\" value=\"true\">";
echo "<table border=\"3\" align=\"center\">";
echo "<tr><th width=\"15%\" nowrap><b>DATE:</b></th>";
echo "<td width=\"15%\"><input type=\"text\" name=\"date\" value=\"$date\" disabled=\"disable\"></td>";
echo "<th width=\"10%\" nowrap><b>SHIFT:</b></th>";
echo "<td width=\"15%\"><input type=\"text\" name=\"shift\" value=\"$shift\" readonly></td>";
echo "</tr>";
echo "</table><hr color=#acacac>";
echo "<table border=\"3\" width=\"45%\" align=\"left\">";
echo "<tr><th width=\"30%\" nowrap><b>CODE:</b></th><td width=\"70%\" align=\"center\">
      <input type=\"text\" name=\"code\" size=\"20\" maxlength=\"8\" value=\"$code\" readonly><br></td></tr>";
echo "<tr><th width=\"30%\" nowrap><b>FAT:</b></th><td width=\"70%\" align=\"center\">
      <input type=\"text\" name=\"fat\" size=\"20\" maxlength=\"3\" value=\"$fat\" readonly><br></td></tr>";
echo "<tr><th width=\"30%\" nowrap><b>SNF:</b></th><td width=\"70%\" align=\"center\">
      <input type=\"text\" name=\"snf\" size=\"20\" maxlength=\"3\" value=\"$snf\" readonly><br></td></tr>";
echo "<tr><th width=\"30%\" nowrap><b>RATE:</b></th><td width=\"70%\" align=\"center\">
      <input type=\"text\" name=\"rate\" size=\"20\" maxlength=\"4\" value=\"$rrate\" readonly><br></td></tr>";
echo "<tr><th width=\"30%\" nowrap><b>QUANTITY:</b></th><td width=\"70%\" align=\"center\">
      <input type=\"text\" name=\"qty\" size=\"20\" maxlength=\"7\" value=\"$qty\" readonly><br></td></tr>";
echo "<tr><th width=\"30%\" nowrap><b>AMOUNT:</b></th><td width=\"70%\" align=\"center\">
      <input type=\"text\" name=\"total\" size=\"20\" maxlength=\"5\" value=\"$total\" readonly></td></tr>";
echo "</table>";
echo "<table border=\"3\" width=\"45%\" align=\"right\">";
echo "<tr><th nowrap>Counting Of Total Members Poured This Shift</th></tr>";
echo "<tr><td align=\"center\">
          <input type=\"text\" name=\"count\" value=\"$count\" size=\"20\" readonly></td></tr>";
echo "<tr><th nowrap>Quantity Of Total Milk Poured This Shift</th></tr>";
echo "<tr><td align=\"center\">
          <input type=\"text\" name=\"shft_tot_qty\" value=\"$shft_tot_qty\" size=\"20\" readonly></td></tr>";
echo "<tr><th nowrap>Sum Of Total Amount For This Shift</th></tr>";
echo "<tr><td align=\"center\">
          <input type=\"text\" name=\"shft_tot_amt\" value=\"$shft_tot_amt\" size=\"20\" readonly></td></tr>";
echo "</table>";
echo "<table border=\"3\" width=\"100%\" align=\"bottom\">";
echo "<tr><th colspan=\"2\"><input type=\"submit\" value=\"Ok\">
       <input type=\"button\" value=\"Cancel\" onclick=\"javascript:window.location.href='rdfltest.php';\">";
echo "</table>";
echo "</form>";
echo "</body>";
echo "</html>";

?>