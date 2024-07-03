$(document).ready( async function () {
    myLatLng = {lat: 35.77799, lng: 10.82617};
    const {Map, Marker} = await google.maps.importLibrary("maps");

    let map = new Map(document.getElementById("map"), {
        center: myLatLng,
        zoom: 8,
    });

//markers
new google.maps.Marker({
    position: myLatLng,
    map: map,
    title: "Hello World!",
});

let request = {
    location:myLatLng,
    radius: '500',
    types: ['school']
};

service = new google.maps.places.PlacesService(map);
service.getDetails(request, callback);

function callback(results, status) {
    console.log(results);
    /* if (status === google.maps.places.PlacesServiceStatus.OK) {
         var marker = new google.maps.Marker({
             map: map,
             place: {
                 placeId: results[0].place_id,
                 location: results[0].geometry.location
             }
         });
     }*/
}
});