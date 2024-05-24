$(document).ready(function () {
 const leaflet = L.map("map");
 const map = leaflet.setView([48.8566, 2.3522], 13);

 L.tileLayer(
    "https://tile.openstreetmap.org/{z}/{x}/{y}.png"
 ).addTo(map);

 L.control
    .fullscreen({
       position: "topright",
       content: null,
       forceSeparateButton: true,
       forcePseudoFullscreen: true,
       fullscreenElement: false,
    })
    .addTo(map);

 $(".listing-map-box").each(function (index, selector) {
    setMapMarker(this, true);
 });

 $(document).on("click", ".listing-map-box", function () {
    setMapMarker(this, false);
 });

 function setMapMarker(selector, isNew = false) {
    let lat = $(selector).data("lat");
    let long = $(selector).data("long");
    let title = $(selector).data("title");
    let location = $(selector).data("location");
    let image = $(selector).data("image");
    let route = $(selector).data("route");
    leaflet.setView([lat, long], 13);
    if (isNew) {
       new L.marker([lat, long]).addTo(map).bindPopup(`<div>
<img class="" src="${image}"/>
<a href="${route}" target="_blank">${title}</a>
<p><i class="fas fa-map-marker-alt fa-fw text-dark"></i> ${location}</p>
</div>`);
    } else {
       L.marker([lat, long])
          .addTo(map)
          .bindPopup(
             `<div>
<img class="" src="${image}"/>
<a href="${route}" target="_blank">${title}</a>
<p><i class="fas fa-map-marker-alt fa-fw text-dark"></i> ${location}</p>
</div>`
          )
          .openPopup();
    }
 }

});
