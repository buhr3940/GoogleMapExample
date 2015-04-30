<?php
  header('Content-Type: text/javascript; charset=UTF-8');
?>
//JS function to not load the pins too early
function loadpins(map){

  <?php    for ( $i = 10 ; $i >= 0; $i--) {  ?>
  var marker<?php echo $i; ?> = new google.maps.Marker({
      position: new google.maps.LatLng(44.9<?php echo $i; ?>5766,-93.171616),
      map: map,
      title: 'Hello <?php echo $i; ?>!'
  });

  <?php
    }; //end for loop
  ?>
}