<?php

// Get access to WordPress
define( 'SHORTINIT', true );
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

?>
<!DOCTYPE html>
<html>
<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">
	<title>Postcrossing API</title>

	<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
	
	<script async defer src='https://maps.googleapis.com/maps/api/js?key=[// YOUR GOOGLE MAPS API KEY GOES HERE //]&callback=initMap'></script>

	<style>
		html, body {
			width: 100%;
			height: 100%;
			margin: 0;
			padding: 0;
		}

		#map {
			width: 100%;
			height: 100%;
		}
	</style>

</head>
<body>
	
	<div id='map'></div>
	
	<script>

	// this function creates the map
	// then calls the API and gets the list of all the geopins
	function initMap(){
		// create center location
		var downtown = new google.maps.LatLng(
			43.630433,
			-79.424798
		);
		var bogota = new google.maps.LatLng(
			4.6482837,
			-74.0504425
		);
		// create options
		var mapOptions = {
			zoom: 3,
			center: bogota
		};
		// create a new map
		var map = new google.maps.Map(
			document.getElementById('map'),
			mapOptions
		);

		// create an info window
		var infoWindow = new google.maps.InfoWindow({
			maxWidth: 200,
		});

		// call the API and get geopins
		$.ajax({
			url: '/api/list/',
			dataType : 'json'
		}).success(function(data){
			// get reference to result
			var stores = data;
			console.log(stores);
			// loop over the result
			for( s in stores ) {
				// get store
				var store = stores[s];

				var html = '<IMG BORDER="0" ALIGN="Left" SRC="'+store.url+'" width=100%;>';
				html += "<h3>" + store.name + "</h3>";
				html += store.title + "<br/>";

				// create store location
				var storeLatLng = new google.maps.LatLng(
					store.latitude,
					store.longitude

// 					latitude
// :
// "4.676553"
// longitude
// :
// "-74.0496018"
				);

				// create marker
				var marker = new google.maps.Marker({
					map: map,
					title: store.name,
					position: storeLatLng,
					myHTML: html
				});

				// add event listener
				google.maps.event.addListener(
					marker,
					'click',
					function(){
						infoWindow.setOptions({
							content: this.myHTML
						});
						infoWindow.open( map, this );
					}
				);
							console.log(storeLatLng);


			}

			// add each store to the list

			console.log("OK",data);
		}).fail(function(xhr){
			console.log("SHOOT",xhr);
		});

	}
	</script>
</body>
</html>







