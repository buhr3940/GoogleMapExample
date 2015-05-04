<?php  

// Get parameters from URL
$center_lat = ( isset( $_SESSION['lat'] ) ? $_SESSION['lat'] : 47.6145); # You could replace these "0"s with the
$center_lng = ( isset( $_SESSION['lng'] ) ? $_SESSION['lng'] : -122.3418 ); # Lat/Lng of a default location.
$radius     = ( isset( $_POST['radiusSelect'] ) ? $_POST['radiusSelect'] : 10); # Again, default radius.
//var_dump ($_POST);
//$radius = htmlspecialchars($_POST['radiusSelect']);
//echo $radius;
// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a mySQL server
mysql_connect("localhost", "llhosts_ericbuhr", "v9SPf1faFqgn") or die("Could not connect to db");
mysql_select_db("llhosts_ericbuhr") or die("Could not connect to db");
//error reporting(0);
//$resource = mysql_query("SELECT * FROM markers");

// Search the rows in the markers table
$query = sprintf("SELECT address, name, lat, lng, ( 3959 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM markers HAVING distance <= '%s' ORDER BY distance LIMIT 10",
  mysql_real_escape_string($center_lat),
  mysql_real_escape_string($center_lng),
  mysql_real_escape_string($center_lat),
  mysql_real_escape_string($radius));


$result = mysql_query($query);
if (!$result) {
  die("Invalid query: " . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name", $row['name']);
  $newnode->setAttribute("address", $row['address']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['lng']);
  $newnode->setAttribute("distance", $row['distance']);
}

echo $dom->saveXML();
?>