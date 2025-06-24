document.addEventListener('DOMContentLoaded', function () {
    const map = L.map('map').setView([-0.947083, 100.417181], 13);

    // Tile layer
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Simpan marker berdasarkan name
    const markersByName = {};

    // Tambahkan semua marker dari data Laravel
    window.pointsFromLaravel.forEach(point => {
        const marker = L.marker([point.latitude, point.longitude])
            .addTo(map)
            .bindPopup(`<strong>${point.name}</strong><br>${point.description}`);
        markersByName[point.name] = marker;
    });

    // Event listener untuk semua tombol "Arahkan"
    document.querySelectorAll('.arahkan-name-btn').forEach(button => {
        button.addEventListener('click', function () {
            const name = this.getAttribute('data-name');
            const marker = markersByName[name];
            if (marker) {
                map.setView(marker.getLatLng(), 17);
                marker.openPopup();
            } else {
                alert("Titik tidak ditemukan di peta.");
            }
        });
    });
});

