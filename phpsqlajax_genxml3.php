<?php  

// Get parameters from URL
//$center_lat = ( isset( $_GET["lat"] ) ? $_GET["lat"] : 0 ); # You could replace these "0"s with the
//$center_lng = ( isset( $_GET["lng"] ) ? $_GET["lng"] : 0 ); # Lat/Lng of a default location.
//$radius     = ( isset( $_GET["radius"] ) ? $_GET["radius"] : 10 ); # Again, default radius.

// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a mySQL server
mysql_connect("localhost", "llhosts_ericbuhr", "v9SPf1faFqgn") or die("Could not connect to db");
mysql_select_db("llhosts_ericbuhr") or die("Could not connect to db");
//error reporting(0);
$resource = mysql_query("SELECT * FROM markers limit 10");

// Search the rows in the markers table
//$query = sprintf( "SELECT address, name, lat, lng, ( 3959 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM markers HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
 // mysql_real_escape_string( $center_lat ),
 // mysql_real_escape_string( $center_lng ),
 // mysql_real_escape_string( $center_lat ),
 //mysql_real_escape_string( $radius ) );
 
if(!$resource )
  die( "MySQL Error - Invalid query: " . mysql_error() . ' "'.$query.'"' ); # During debugging, echo the SQL Statement on Error

if( !headers_sent() )
  header( "Content-type: text/xml" );

// Iterate through the rows, adding XML nodes for each
if( mysql_num_rows( $resource ) ){
  while ($row = @mysql_fetch_assoc($resource)){
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("name", $row['name']);
    $newnode->setAttribute("address", $row['address']);
    $newnode->setAttribute("lat", $row['lat']);
    $newnode->setAttribute("lng", $row['lng']);
    $newnode->setAttribute("type", $row['type']);
  }
}else
  die( 'MySQL Error - No Records Returned "'.$query.'"' );

echo $dom->saveXML();
?>