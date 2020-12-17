function initialize() {
			var Y_point			= 37.500760;
			var X_point			= 127.026822;
			var zoomLevel		= 16;
			var markerTitle		= "wholenet";
			var markerMaxWidth	= 300;
			var contentString	= '<div>' +
			'<h2>wholenet</h2>'+
			'<p>힐링여행</p>' +
			'</div>';
			var myLatlng = new google.maps.LatLng(Y_point, X_point);
			var mapOptions = {
								zoom: zoomLevel,
								center: myLatlng,
								mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			var map = new google.maps.Map(document.getElementById('map_view'), mapOptions);

			var marker = new google.maps.Marker({
													position: myLatlng,
													map: map,
													title: markerTitle
			});

			var infowindow = new google.maps.InfoWindow(
														{
															content: contentString,
															maxWidth: markerMaxWidth
														}
			);

			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map, marker);
			});
		}
