<?php
echo "Welcome to the OpenShift 3 Simple PHP and MySQL Smoke Test Application";

// List OpenShift Env Variables
// Or simply use a Superglobal ($_SERVER or $_ENV)
$mysql_user = $_ENV['MYSQL_USER'];
$mysql_password = $_ENV['MYSQL_PASSWORD'];
$my_database = $_ENV['MYSQL_DATABASE'];
$mysql_service_host = $_ENV['MYSQL_SERVICE_HOST'];
$mysql_service_port = $_ENV['MYSQL_SERVICE_PORT'];

echo "Connecting User: " + $mysql_user + "/" + $mysql_password + " to DB: " + $my_database + "@" + $mysql_service_host + ":" + $mysql_service_port;

$mysql_host = $mysql_service_host + ":" + $mysql_service_port;

// Connecting, selecting database
$link = mysql_connect($mysql_host, $mysql_user, $mysql_password)
or die('Could not connect: ' . mysql_error());
echo 'Connected successfully';
mysql_select_db($my_database) or die('Could not select database');

// Performing SQL query
$query = 'SELECT * FROM sample_table';
$result = mysql_query($query) or die('Query failed: ' . mysql_error());

// Printing results in HTML
echo "<table>\n";
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
echo "\t<tr>\n";
foreach ($line as $col_value) {
echo "\t\t<td>$col_value</td>\n";
}
echo "\t</tr>\n";
}
echo "</table>\n";

// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>

