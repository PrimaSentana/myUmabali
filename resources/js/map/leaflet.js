import L from 'leaflet';

export function leafletMap() {
    const defaultLat = -8.409518; // tengah Bali
    const defaultLng = 115.188919;
    const defaultZoom = 10;

    const map = L.map('map').setView([defaultLat, defaultLng], defaultZoom);

    // pakai OSM tiles (no key)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // marker draggable — tempat user pilih lokasi
    const marker = L.marker([defaultLat, defaultLng], {draggable: true}).addTo(map);

    // setTimeout(() => {
    //     map.invalidateSize();
    // }, 100);

    // kalau klik map, pindahkan marker
    map.on('click', (e) => {
        marker.setLatLng(e.latlng);
        setInputs(e.latlng.lat, e.latlng.lng);
    });

    // update inputs saat marker dipindah
    marker.on('dragend', function (e) {
        const position = e.target.getLatLng();
        console.log(position.lat, position.lng);
    });

    // isi input hidden
    function setInputs(lat, lng){
        document.getElementById('latitude').value = lat.toFixed(7);
        document.getElementById('longitude').value = lng.toFixed(7);
    }

    // jika ada nilai lama (edit), set marker ke posisi itu
    const latInput = document.getElementById('latitude').value;
    const lngInput = document.getElementById('longitude').value;
    if(latInput && lngInput){
        const lat = parseFloat(latInput), lng = parseFloat(lngInput);
        marker.setLatLng([lat, lng]);
        map.setView([lat,lng], 14);
    }
}