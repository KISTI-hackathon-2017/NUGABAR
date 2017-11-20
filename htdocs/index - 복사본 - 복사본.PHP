<?php  
$db_host = "localhost";
$db_user = "root";
$db_passwd = "root";
$db_name = "airstatus";

mysql_connect($db_host,$db_user,$db_passwd);
mysql_select_db($db_name);
mysql_query('set session character_set_connection=utf8;');
mysql_query('set session character_set_results=utf8;');
mysql_query('set session character_set_client=utf8;');

$result = mysql_query("SELECT * FROM daeguair");
$rows = array();

while($row = mysql_fetch_assoc($result))
	{
	echo$row['BLOCK'];
	}
?>