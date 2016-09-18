/* 
 * @author: sintret@gmail.com
 * display photo in bootstrap modal
 * latitude and longitude provides
 */

var lat = $("#map").data("latitude");
var lon = $("#map").data("longitude");
var title = $("#map").data("title");


$(".photo-modal").on("click", function () {
    var latitude = $(this).data("latitude");
    var longitude = $(this).data("longitude");
    var image = $(this).data("image");
    var t = $(this).data("title");

    $(".map").data("latitude", latitude);
    $(".map").data("longitude", longitude);

    lat = latitude;
    lon = longitude;
    title = t;

    $(".modal-title").html(title);
    //$(".modal-body").html(latitude);
    
    //open modal photo
    $(".modal-image").attr("src",image);
    $('#modalPhoto').modal('show');

});

function initMap() {
    var lokasi = new google.maps.LatLng(parseFloat(lat), parseFloat(lon));
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: lokasi,
        mapTypeId: 'terrain'
    });

    var marker = new google.maps.Marker({
        position: lokasi,
        map: map,
        title: title
    });
    // To add the marker to the map, call setMap();
    marker.setMap(map);
}