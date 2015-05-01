<?php
$header = header('Content-Type:text/html; charset=UTF-8');
mysql_connect("localhost", "llhosts_ericbuhr", "v9SPf1faFqgn") or die("Could not connect to db");
mysql_select_db("llhosts_ericbuhr") or die("Could not connect to db");
//error reporting(0);
$resource = mysql_query("SELECT * FROM users limit 10");
if ($resource) {
    while ($row = mysql_fetch_assoc($resource)) {
        $data[] = $row; 
    }
}
//print_r($data);
die;
?>
