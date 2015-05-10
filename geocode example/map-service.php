<?php if ($_POST['action'] == 'savepoint') { 
  $name = $_POST['name']; 
  $lat = $_POST['lat'];
  $lng = $_POST['lng'];
  if(empty($name)) { 
    fail('Please enter a name.'); 
  } 
} 
function fail($message) { 
  die(json_encode(array('status' => 'fail', 'message' => $message))); 
}
function map_query($query) { 
  mysql_connect('localhost', 'llhosts_ericbuhr', 'v9SPf1faFqgn') OR die(fail('Could not connect to database.'));
  mysql_select_db ('llhosts_ericbuhr'); 
  return mysql_query($query); 
}
function success($data) { 
  die(json_encode(array('status' =>'success', 'data' =>$data))); 
}
$query ="INSERT INTO locations SET name='$_POST[name]', lat='$lat', lng='$lng'"; 
$result = map_query($query); 
if ($result) { 
  success(array('lat' =>$_POST['lat'], 'lng' =>$_POST['lng'], 'name' =>$name)); 
} else { 
  fail('Failed to add point.'); 
}
if ($_GET['action'] == 'listpoints') { 
  $query ="SELECT * FROM locations"; 
  $result = map_query($query); 
  $points = array();
  while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) { 
    array_push($points, array('name' =>$row['name'], 'lat' =>$row['lat'], 'lng' =>$row['lng'])); 
  } 
  echo json_encode(array("Locations"=>$points)); 
  exit; 
}
?>