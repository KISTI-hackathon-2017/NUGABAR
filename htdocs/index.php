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
		$JSONres = array
		(
			"BLOCK" => urlencode($row['BLOCK']),
			"HUM" => urlencode($row['HUM']),
			"LNG" => urlencode($row['LNG']),
			"TIME" => urlencode($row['TIME']),
			"CO" => urlencode($row['CO']),
			"NO2" => urlencode($row['NO2']),
			"TEMP" => urlencode($row['TEMP']),
			"SO2" => urlencode($row['SO2']),
			"PM2_5" => urlencode($row['PM2_5']),
			"PM10" => urlencode($row['PM10']),
			"MCP" => urlencode($row['MCP']),
			"LAT" => urlencode($row['LAT']),
			"NODE_ID" => urlencode($row['NODE_ID']),
			"AQI" => urlencode($row['AQI'])
		);
		array_push($rows, $JSONres);
	}
echo(strip_tags(urldecode(json_encode($rows))));
?>