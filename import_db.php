<?php

$mysqlHostName = 'localhost';
$mysqlUserName = 'root';
$mysqlPassword = 'chinkli';
$mysqlDatabaseName = 'rdfl_db';
$mysqlImportFile = 'rdfl.sql';

$query = 'mysql -u'.$mysqlUserName.' -h'.$mysqlHostName.' -p'.$mysqlPassword.' '.$mysqlDatabaseName.' < '.$mysqlImportFile;
//exec($query,$output = array(),$worked);
$result = mysql_query($query);


//switch($query_data = mysql_fetch_row($result))
if(!$result)
{
 //case 0 : echo 'Import File <b> '.$mysqlImportFile.' </b>Successfully Imported To Database<b> '.$mysqlDatabaseName.' </b>';
 //break;
 echo 'Import File <b> '.$mysqlImportFile.' </b>Successfully Imported To Database<b> '.$mysqlDatabaseName.' </b>';
}
else
{
 
 /*case 0 : echo 'Some Error Encountered While Importing<b>'.$mysqlImportFile.'</b> ?.<br/><br/>Please Make Sure That Import File Is Saved In The Same Folder As This           Script And Values Provided Below Are All Correct : <br/><br/>
           <table>
            <tr>
             <td>MySQL Host Name</td>
             <td><b>'.$mysqlHostName.'</b></td>
            </tr>
            <tr>
             <td>MySQL USer Name</td>
             <td><b>'.$mysqlUserName.'</b></td>
            </tr>
            <tr>
             <td>MySQL Password</td>
             <td><b>Not Shown(Secured)</b></td>
            </tr>
            <tr>
             <td>MySQL Database Name</td>
             <td><b>'.$mysqlDatabaseName.'</b></td>
            </tr>
            <tr>
             <td>MySQL Import File Name</td>
             <td><b>'.$mysqlImportFile.'</b></td>
            </tr>
           </table>';
 break;*/
echo 'Some Error Encountered While Importing<b>'.$mysqlImportFile.'</b> ?.<br/><br/>Please Make Sure That Import File Is Saved In The Same Folder As This           Script And Values Provided Below Are All Correct : <br/><br/>
           <table>
            <tr>
             <td>MySQL Host Name</td>
             <td><b>'.$mysqlHostName.'</b></td>
            </tr>
            <tr>
             <td>MySQL USer Name</td>
             <td><b>'.$mysqlUserName.'</b></td>
            </tr>
            <tr>
             <td>MySQL Password</td>
             <td><b>Not Shown(Secured)</b></td>
            </tr>
            <tr>
             <td>MySQL Database Name</td>
             <td><b>'.$mysqlDatabaseName.'</b></td>
            </tr>
            <tr>
             <td>MySQL Import File Name</td>
             <td><b>'.$mysqlImportFile.'</b></td>
            </tr>
           </table>';

}
?>