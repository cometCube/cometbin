<?php
include "rdfl_connect.inc";

echo "<html>";
echo "<head><title>RDFL Import Rate-Chart</title></head>";
echo "<body bgcolor=#f1f1f1><font color=#hhhhhh weight=\"10\">
<center><b>Reliance Dairy Foods Ltd.,Sarsa</b></center></font><hr width=\"270\" color=#acacff><br>";
echo "</body>";
echo "</html>";

//$userfile = $_FILES['userfile']['tmp_name'];
$userfile_name = $_FILES['userfile']['name'];
$userfile_size = $_FILES['userfile']['size'];
$userfile_type = $_FILES['userfile']['type'];
$userfile_error = $_FILES['userfile']['error'];

if($userfile_error > 0)
{
 switch($userfile_error)
 {
  case 1:error_message("File Exceeded upload_max_filesize");break;
  case 2:error_message("File Exceeded max_file_size");break;
  case 3:error_message("File Uploaded Partially");break;
  case 4:error_message("No File Selected For Uploading ?");break;
 }
}

if($userfile_type != 'text/xml')
{
 error_message("File Is Not In XML Format ?");
}

$source = "c:\\xampp\\htdocs\\test\\".$userfile_name;
$destination = "c:\\xampp\\htdocs\\rdfl\\RC.xml";

if(!copy($source,$destination))
{
 echo "<script>javascript:window.alert(\"Sorry ! Some Problem Encountered While Importing New Rate-Chart,Please try Again.....\");history.go(-1);</script>";
}
else
{
 echo "<script>javascript:window.alert(\"New Rate-Chart Imported Successfully !\");
                          window.close();</script>";
}

/*$fp = fopen(basename($destination),'r');
$contents = fread($fp,filesize(basename($destination)));
fclose($fp);

$contents = strip_tags($contents);
$fp = fopen(basename($destination),'w');
fwrite($fp,$contents);
fclose($fp);

echo "Preview Your Uploaded File:<br><br>\n";
echo $contents;
echo "<br><br>";*/
?>


