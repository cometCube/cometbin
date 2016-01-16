<?php

echo "<html>";
echo "<head><title>RDFL Import Rate-Chart</title></head>";
echo "<body bgcolor=\"#f1f1f1\">";
echo "<div align=\"center\">";
echo "<div style=\"margin-top=5px;width:500px;height:65px;background-image:url('images/logo_main.jpg');background-repeat:no-repeat;position:relative;\" >";
echo "<img src=\"images\\logo.gif\" align=\"left\" width=\"150\" height=\"65\"><br>";
echo "<center><font color=\"#19449b\" font-size=\"12\"><b>Reliance Dairy Foods Ltd.,Sarsa</b></font><hr width=\"240\" color=\"#acacff\"></center>";
echo "</div></div><br><br>";
echo "<form enctype=\"multipart/form-data\" action=\"import_rate_chart.php\" method=\"post\" align=\"center\">";
echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"2000000\">";
echo "Select New Rate-Chart:<input type=\"file\" name=\"userfile\">";
echo "<input type=\"submit\" value=\"Import\">";
echo "</form>";
echo "</body>";
echo "</html>";

?>