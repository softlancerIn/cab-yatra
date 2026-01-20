<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_UGwOg_RtIiwUp3DkMCi2cpNvo2gpWAo&libraries=places"></script>
    <script>
      function calculateDistance() {
        var originCity = document.getElementById('originCity').value;
        var destinationCity = document.getElementById('destinationCity').value;
        var service = new google.maps.DistanceMatrixService();

        service.getDistanceMatrix(
          {
            origins: [originCity],
            destinations: [destinationCity],
            travelMode: 'DRIVING', // You can change this to WALKING, BICYCLING, or TRANSIT
            unitSystem: google.maps.UnitSystem.METRIC, // Use METRIC for kilometers and IMPERIAL for miles
          },
          function (response, status) {
            if (status === 'OK') {
              var origin = response.originAddresses[0];
              var destination = response.destinationAddresses[0];
              if (response.rows[0].elements[0].status === "ZERO_RESULTS") {
                alert("No route found between " + origin + " and " + destination);
              } else {
                var distance = response.rows[0].elements[0].distance.text; // The distance value
                var duration = response.rows[0].elements[0].duration.text; // The travel time
                console.log('Distance: ' + distance);
                console.log('Duration: ' + duration);
                document.getElementById('result').innerHTML =
                  'Distance from ' + origin + ' to ' + destination + ' is ' + distance + '. Estimated travel time: ' + duration;
              }
            } else {
              console.error('Error fetching data from Distance Matrix: ' + status);
            }
          }
        );
      }
    </script>
