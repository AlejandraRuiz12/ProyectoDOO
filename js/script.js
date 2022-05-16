function iniciarMap() {
  var center = { lat: 4.6882047, lng: -74.0585927 };

  var lugares = [
    { lat: 4.6882047, lng: -74.0585927 },
    { lat: 4.6346041, lng: -74.0640678 },
    { lat: 4.6256406, lng: -74.2225912 },
    { lat: 4.6163944, lng: -74.115296 },
  ];
  var map = new google.maps.Map(document.getElementById("map"), {
    zoom: 10,
    center: center,
  });

  for (i = 0; i < lugares.length; i++) {
    var marker = new google.maps.Marker({
      position: lugares[i],
      map: map,
    });
  }
}
