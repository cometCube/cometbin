<?php
include "common_db.inc";
$dbname = 'rdfl_db';

$rdfl_admin_table='rdfl_admin';
$rdfl_admin_table_def="admin_num MEDIUMINT(1) NOT NULL AUTO_INCREMENT,";
$rdfl_admin_table_def.="admin_id VARCHAR(10) NOT NULL,";
$rdfl_admin_table_def.="admin_passwd VARCHAR(41) NOT NULL,";
$rdfl_admin_table_def.="name VARCHAR(25) NOT NULL,";
$rdfl_admin_table_def.="PRIMARY KEY (admin_num),";
$rdfl_admin_table_def.="UNIQUE admin_id (admin_id)";

$pooling_pt_table = 'pooling_pt';
$pooling_pt_table_def = "code VARCHAR(8) NOT NULL DEFAULT '1',";
$pooling_pt_table_def .= "date VARCHAR(10) NOT NULL,";
$pooling_pt_table_def .= "shift ENUM('Mor','Eve') NOT NULL DEFAULT 'Mor',";
$pooling_pt_table_def .= "fat MEDIUMINT(3) NOT NULL,";
$pooling_pt_table_def .= "snf MEDIUMINT(3) NOT NULL,";
$pooling_pt_table_def .= "quantity FLOAT NOT NULL,";
$pooling_pt_table_def .= "amount FLOAT NOT NULL,";
$pooling_pt_table_def .= "status ENUM('Open','Closed') NOT NULL DEFAULT 'Open'";

$pooling_mem_table = 'pooling_mem';
$pooling_mem_table_def = "code MEDIUMINT(8) NOT NULL AUTO_INCREMENT,";
$pooling_mem_table_def .= "name VARCHAR(25) NOT NULL,";
$pooling_mem_table_def .= "fname VARCHAR(25) NOT NULL,";
$pooling_mem_table_def .= "ph_no VARCHAR(10),";
$pooling_mem_table_def .= "PRIMARY KEY (code)";

$link_id = db_connect();
if(!$link_id)
 die(sql_error());

if(!mysql_query("CREATE DATABASE $dbname"))
 die(sql_error());
echo "Database $dbname Created Successfully.<br>";

if(!mysql_select_db($dbname))
 die(sql_error());

if(!mysql_query("CREATE TABLE $rdfl_admin_table ($rdfl_admin_table_def)"))
 die(sql_error());

if(!mysql_query("CREATE TABLE $pooling_pt_table ($pooling_pt_table_def)"))
 die(sql_error());

if(!mysql_query("CREATE TABLE $pooling_mem_table ($pooling_mem_table_def)"))
 die(sql_error());
echo "Tables $rdfl_admin_table,$pooling_pt_table And $pooling_mem_table For Database $dbname Created Successfully.";
?>