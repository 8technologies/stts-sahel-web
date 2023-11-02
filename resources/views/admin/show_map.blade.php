<!DOCTYPE html>
<html>
<head>
    <title>Show Map</title>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div id="map"></div>

    <script>
        function initMap() {
            var latitude = <?php echo json_encode($latitude); ?>;
            var longitude = <?php echo json_encode($longitude); ?>;

            if (latitude !== null && longitude !== null) {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: parseFloat(latitude),
                        lng: parseFloat(longitude)
                    },
                    zoom: 14 // Adjust the zoom level as needed
                });

                var marker = new google.maps.Marker({
                    position: {
                        lat: parseFloat(latitude),
                        lng: parseFloat(longitude)
                    },
                    map: map,
                    title: 'Coordinates'
                });
            } else {
                console.error('Latitude or Longitude is null.');
            }
        }

    </script>
    <!-- Load the Google Maps API -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>
</body>
</html>
