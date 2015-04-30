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

  var contentString<?php echo $i; ?> = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
      '<div id="bodyContent">'+
      '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
      'sandstone rock formation in the southern part of the '+
      'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) '+
      'south west of the nearest large town, Alice Springs; 450&#160;km '+
      '(280&#160;mi) by road. Kata Tjuta and Uluru are the two major '+
      'features of the Uluru - Kata Tjuta National Park. Uluru is '+
      'sacred to the Pitjantjatjara and Yankunytjatjara, the '+
      'Aboriginal people of the area. It has many springs, waterholes, '+
      'rock caves and ancient paintings. Uluru is listed as a World '+
      'Heritage Site.</p>'+
      '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
      'https://en.wikipedia.org/w/index.php?title=Uluru</a> '+
      '(last visited June 22, 2009).</p>'+
      '</div>'+
      '</div>';

  var infowindow<?php echo $i; ?> = new google.maps.InfoWindow({
      content: contentString<?php echo $i; ?>
  });


  google.maps.event.addListener(marker<?php echo $i; ?>, 'click', function() {
    infowindow<?php echo $i; ?>.open(map,marker<?php echo $i; ?>);
  });

  <?php
    }; //end for loop
  ?>
}