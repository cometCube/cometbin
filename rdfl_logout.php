<?php
 @session_unregister('$admin_id');
 @session_unregister('$admin_passwd');
 echo "<script language=\"javascript\">window.alert(\"You Have Logout Successfully !\");window.location.href='rdfl_login.php';</script>";
?>

