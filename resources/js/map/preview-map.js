import L from 'leaflet';

export function previewMap() {
    if (!window.listingLocation) return;

    const { lat, lng } = window.listingLocation;

    const map = L.map('preview-map').setView([lat, lng], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const marker = L.marker([lat, lng]).addTo(map).bindPopup('Penginapan Anda!').openPopup();
}