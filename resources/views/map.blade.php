    @extends('layout.template')

    @section('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">

        <!-- Leaflet Search CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

        <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Leaflet MiniMap CSS & JS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet-minimap/dist/Control.MiniMap.min.css" />

        {{-- Font --}}
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

        <style>
            .leaflet-control-custom {
                box-shadow: 0 1px 5px rgba(0, 0, 0, 0.65);
                border-radius: 4px;
                text-align: center;
                line-height: 34px;
            }
        </style>

        <!-- MINIMAP -->
        <style>
            /* BOX INSET MAP */
            .inset-map-box {
                position: absolute;
                bottom: 20px;
                left: 20px;
                z-index: 1000;
                background-color: #ffffff;
                border: 2px solid #00188e;
                border-radius: 8px;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
                padding: 10px 8px 8px 8px;
                width: 190px;
            }

            /* JUDUL INSET */
            .inset-map-box h4 {
                font-size: 14px;
                margin: 0 0 6px 0;
                text-align: center;
                color: #00188e;
                font-weight: bold;
            }

            /* PETA KECIL */
            #insetMap {
                height: 130px;
                width: 100%;
                border: 1px solid #00188e;
                border-radius: 5px;
            }

            /* CUSTOM TOGGLE ICON MINIMAP */
            .leaflet-control-minimap-toggle-display {
                background-image: none !important;
                background-color: #ffffff;
                border: 1px solid #aaa;
                font-family: "Font Awesome 6 Free";
                font-weight: 900;
                font-size: 18px;
                color: #00188e;
                width: 28px;
                height: 28px;
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 4px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
                cursor: pointer;
                transition: 0.3s ease;
            }

            .leaflet-control-minimap-toggle-display:hover {
                background-color: #f0f0f0;
            }

            .leaflet-control-minimap-toggle-display::before {
                content: "\f279";
                /* fa-map icon */
            }

            /* Responsive */
            @media (max-width: 576px) {
                .inset-map-box {
                    bottom: 15px;
                    left: 10px;
                    width: 160px;
                }

                #insetMap {
                    height: 100px;
                }

                .inset-map-box h4 {
                    font-size: 12px;
                }
            }

            /* DESAIN LAYERS CONTROL */
            .leaflet-control-layers {
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
                font-family: 'Poppins', sans-serif;
                font-size: 14px;
            }

            .leaflet-control-layers-expanded {
                padding: 10px;
            }

            .leaflet-control-layers label {
                display: block;
                padding: 6px 8px;
                border-radius: 4px;
                cursor: pointer;
                transition: background-color 0.2s;
            }

            .leaflet-control-layers label:hover {
                background-color: #e8f0fe;
            }

            .leaflet-control-layers-selector {
                margin-right: 6px;
            }

            .leaflet-control-layers-separator {
                margin: 8px 0;
                border-top: 1px solid #ccc;
            }
        </style>

        <style>
            /* Font pada semua elemen Leaflet Layer Switcher */
            .leaflet-control-layers {
                font-family: 'Poppins', sans-serif;
                font-size: 14px;
            }
        </style>

        {{-- SIDE BAR A.K.A LAYOUT MAP --}}
        <style>
            /* Tombol Toggle Sidebar */
            .sidebar-toggle {
                position: fixed;
                top: 280px;
                right: 25px;
                z-index: 1100;
                background-color: #00188e;
                color: white;
                padding: 8px 16px;
                border-radius: 8px;
                font-family: 'Poppins', sans-serif;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
                transition: background-color 0.3s ease, transform 0.3s ease;
            }

            .sidebar-toggle:hover {
                background-color: #0033cc;
                transform: translateY(-2px);
            }

            /* Sidebar Konten */
            .map-sidebar {
                position: fixed;
                top: 330px;
                /* Geser sedikit lebih turun agar tidak dempet layer control */
                right: 25px;
                width: 260px;
                background: #ffffff;
                border: 2px solid #00188e;
                border-radius: 10px;
                padding: 20px 18px;
                font-family: 'Poppins', sans-serif;
                font-size: 13px;
                line-height: 1.6;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
                transform: translateX(110%);
                opacity: 0;
                transition: transform 0.4s ease, opacity 0.4s ease;
                z-index: 1000;
            }

            .map-sidebar.active {
                transform: translateX(0%);
                opacity: 1;
            }

            .map-sidebar h4 {
                font-size: 15px;
                font-weight: 700;
                margin: 12px 0 6px 0;
                color: #00188e;
            }

            .map-sidebar p,
            .map-sidebar li {
                font-size: 13px;
                margin-bottom: 6px;
                color: #333;
            }

            .map-sidebar ul {
                padding-left: 20px;
                margin: 6px 0 12px 0;
            }

            .map-sidebar ul li span {
                margin-right: 6px;
            }

            /* Responsive: pindah ke kanan bawah di layar kecil */
            @media (max-width: 768px) {
                .sidebar-toggle {
                    top: auto;
                    bottom: 20px;
                    right: 20px;
                    left: auto;
                }

                .map-sidebar {
                    top: auto;
                    bottom: 80px;
                    right: 20px;
                    left: auto;
                    width: 90%;
                    max-width: 300px;
                }
            }
        </style>

        <style>
            #map {
                width: 100%;
                height: calc(100vh - 56px);
            }
        </style>
    @endsection


    @section('content')
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div id="map"></div>



        <!-- Toggle Button -->
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-info-circle me-1"></i> Info Peta
        </div>

        <!-- Sidebar Konten -->
        <div id="sidebar" class="map-sidebar" class="text-center">
            <h4><strong>POLIMAP</strong></h4>

            <h4><strong>Keterangan</strong></h4>
            <ul style="padding-left: 18px;">
                <li><span style="color: blue;">●</span> Fasilitas Polisi</li>
                <li><span style="color: rgb(87, 96, 229);">▬</span> Jarak </li>
                <li><span style="color: yellow;">■</span> Kecamatan </li>
            </ul>

            <h4><strong>Proyeksi</strong></h4>
            <p>EPSG:4326 - WGS 84</p>

            <h4><strong>Dibuat oleh</strong></h4>
            <p>Sheryn Alya Azzahra</p>
            <p>23/515601/SV/22583</p>

            <h4><strong>Instansi</strong></h4>
            <p>Universitas Gadjah Mada</p>
        </div>

        <!-- Modal Create Point-->
        <div class="modal fade" id="createpointModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Point</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('points.store') }}" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Fill point name">
                            </div>


                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="geom_point" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geom_point" name="geom_point" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="image_point" name="image"
                                    onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                                <img src="" alt="" id="preview-image-point" class="img-thumbnail"
                                    width="400">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Create Polyline-->
        <div class="modal fade" id="createpolylineModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polyline</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('polylines.store') }}" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Fill point name">
                            </div>


                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="geom_polyline" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geom_polyline" name="geom_polyline" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="image_polyline" name="image"
                                    onchange="document.getElementById('preview-image-polyline').src = window.URL.createObjectURL(this.files[0])">
                                <img src="" alt="" id="preview-image-polyline" class="img-thumbnail"
                                    width="400">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Create Polygon-->
        <div class="modal fade" id="createpolygonModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polygon</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('polygons.store') }}" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Fill point name">
                            </div>


                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="geom_polygon" class="form-label">Geometry</label>
                                <textarea class="form-control" id="geom_polygon" name="geom_polygon" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="image_polygon" name="image"
                                    onchange="document.getElementById('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])">
                                <img src="" alt="" id="preview-image-polygon" class="img-thumbnail"
                                    width="400">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <script src="https://unpkg.com/@terraformer/wkt"></script>

        <!-- Leaflet Search JS -->
        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

        <!-- Leaflet Routing Machine JS -->
        <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.min.js"></script>

        <script src="https://unpkg.com/leaflet.heat/dist/leaflet-heat.js"></script>

        <!-- Leaflet MiniMap CSS & JS -->
        <script src="https://unpkg.com/leaflet-minimap/dist/Control.MiniMap.min.js"></script>




        <script>
            const initialCenter = [-0.947083, 100.417181];
            const initialZoom = 12;

            var map = L.map('map').setView(initialCenter, initialZoom);

            // Tile layer
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // Tombol Beranda
            const homeButton = L.control({
                position: 'topleft'
            });

            homeButton.onAdd = function(map) {
                const btn = L.DomUtil.create('button', 'leaflet-bar leaflet-control leaflet-control-custom');
                btn.innerHTML = '<i class="fa fa-home"></i>';
                btn.style.backgroundColor = 'white';
                btn.style.width = '34px';
                btn.style.height = '34px';
                btn.style.cursor = 'pointer';

                btn.onclick = function() {
                    map.setView(initialCenter, initialZoom);
                };

                return btn;
            };

            homeButton.addTo(map);

            //CONTROL LAYER
            var baseMaps = {
                "OpenStreetMap": L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }),
                "Google Satellite": L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                }),
                "Google Terrain": L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                }),
                "Google Hybrid": L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                })
            };

            // Tambahkan satu basemap default ke peta
            baseMaps["OpenStreetMap"].addTo(map);

            // Layer control collapsible saat diklik
            L.control.layers(baseMaps, null, {
                collapsed: true, // Penting agar hanya muncul saat DIKLIK
                position: 'topright'
            }).addTo(map);


            // === INSERT MAP (MINIMAP) DENGAN GOOGLE SATELLITE ===
            var miniMapLayer = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                maxZoom: 13,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            });

            var miniMap = new L.Control.MiniMap(miniMapLayer, {
                toggleDisplay: true,
                minimized: false,
                position: 'bottomleft', // kiri bawah
                width: 200,
                height: 200,
                zoomLevelOffset: -4,
                aimingRectOptions: {
                    color: "red",
                    weight: 1,
                    clickable: false
                },
            }).addTo(map);

            // MENAMBAHKAH FITUR ALLOW LOCATION DEVICE
            // let userLatLng = null;

            // // Minta lokasi pengguna
            // if (navigator.geolocation) {
            //     navigator.geolocation.getCurrentPosition(function(position) {
            //         userLatLng = L.latLng(position.coords.latitude, position.coords.longitude);

            //         // Tambahkan marker lokasi pengguna (opsional)
            //         L.marker(userLatLng, {
            //                 title: "Lokasi Anda"
            //             })
            //             .addTo(map)
            //             .bindPopup("Lokasi Anda saat ini")
            //             .openPopup();
            //     }, function(error) {
            //         alert("Gagal mendapatkan lokasi: " + error.message);
            //     });
            // } else {
            //     alert("Geolocation tidak didukung oleh browser Anda.");
            // }

            // Load GeoJSON admin kecamatan Kota Padang (garis)
            fetch('/geojson/adminKec_Padang.geojson')
                .then(response => response.json())
                .then(data => {
                    var boundaryLayer = L.geoJSON(data, {
                        style: {
                            color: "YELLOW",
                            weight: 2,
                            fillOpacity: 0.2
                        },
                        onEachFeature: function(feature, layer) {
                            if (feature.properties && feature.properties.NAMOBJ) {
                                // Buat tooltip tapi jangan tampilkan langsung
                                const tooltip = L.tooltip({
                                    direction: 'center',
                                    opacity: 0.9,
                                    permanent: false
                                }).setContent(feature.properties.NAMOBJ);

                                // Tampilkan tooltip saat diklik
                                layer.on('click', function(e) {
                                    tooltip.setLatLng(e.latlng);
                                    map.openTooltip(tooltip);
                                });
                            }
                        }
                    }).addTo(map);
                    //map.fitBounds(boundaryLayer.getBounds()); // Auto-zoom ke area Padang
                });

            // Load GeoJSON Batas Kota Padang (area )
            fetch('/geojson/Ar_kotPadang.geojson')
                .then(response => response.json())
                .then(data => {
                    var boundaryLayer = L.geoJSON(data, {
                        style: {
                            color: "blue",
                            weight: 2,
                            fillOpacity: 0.2
                        }
                    }).addTo(map);
                    //map.fitBounds(boundaryLayer.getBounds()); // Auto-zoom ke area Padang
                });

            // Tambahkan control geocoder (search bar)
            L.Control.geocoder({
                    defaultMarkGeocode: false
                })
                .on('markgeocode', function(e) {
                    var bbox = e.geocode.bbox;
                    var bounds = L.latLngBounds(bbox.getSouthEast(), bbox.getNorthWest());
                    map.fitBounds(bounds);

                    // Tambahkan marker pencarian
                    L.marker(e.geocode.center)
                        .addTo(map)
                        .bindPopup(e.geocode.name)
                        .openPopup();
                })
                .addTo(map);

            /* Digitize Function */
            var drawnItems = new L.FeatureGroup();
            map.addLayer(drawnItems);

            var drawControl = new L.Control.Draw({
                draw: {
                    position: 'topleft',
                    polyline: true,
                    polygon: false,
                    rectangle: false,
                    circle: false,
                    marker: true,
                    circlemarker: false
                },
                edit: false
            });

            map.addControl(drawControl);
            map.on('draw:created', function(e) {
                var type = e.layerType,
                    layer = e.layer;
                console.log(type);
                var drawnJSONObject = layer.toGeoJSON();
                var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);
                console.log(drawnJSONObject);
                // console.log(objectGeometry);
                if (type === 'polyline') {
                    console.log("Create " + type);
                    $('#geom_polyline').val(objectGeometry);
                    //nanti memunculkann modal create polyline
                    $('#createpolylineModal').modal('show');
                } else if (type === 'polygon' || type === 'rectangle') {
                    console.log("Create " + type);
                    $('#geom_polygon').val(objectGeometry);
                    $('#createpolygonModal').modal('show');
                } else if (type === 'marker') {
                    console.log("Create " + type);

                    $('#geom_point').val(objectGeometry);
                    $('#createpointModal').modal('show');
                } else {
                    console.log('__undefined__');
                }

                drawnItems.addLayer(layer);
            });

            // GeoJSON Points
            var point = L.geoJson(null, {
                onEachFeature: function(feature, layer) {

                    var routedelete = "{{ route('points.destroy', ':id') }}";
                    routedelete = routedelete.replace(':id', feature.properties.id);

                    var routeedit = "{{ route('points.edit', ':id') }}";
                    routeedit = routeedit.replace(':id', feature.properties.id);

                    var popupContent = `
            <div style="
                font-family: 'Segoe UI', sans-serif;
                max-width: 270px;
                background-color: #e8f4fd;
                border: 1px solid #007bff;
                border-radius: 10px;
                padding: 12px;
                box-shadow: 0 2px 6px rgba(0, 123, 255, 0.2);
                font-size: 13px;
                line-height: 1.4;
                color: #003366;
            ">
                <div style="font-weight: 700; font-size: 15px; margin-bottom: 6px; color: #0056b3;">
                    ${feature.properties.name}
                </div>
                <div><strong>Deskripsi:</strong> ${feature.properties.description}</div>
                <div><strong>Diubah:</strong> ${feature.properties.created_at}</div>

                <img src="{{ asset('storage/images') }}/${feature.properties.image}"
                    alt="" style="width: 100%; height: auto; margin-top: 8px; border-radius: 6px; object-fit: cover; border: 1px solid #007bff;" />

                <div class="row" style="margin-top: 10px; display: flex; gap: 6px;">
                    <div class="col-6" style="flex: 1;">
                        <a href="${routeedit}" class="btn btn-sm w-100"
                            style="background-color: #007bff; color: white; border: none; border-radius: 5px; font-size: 12px; padding: 6px;">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                    </div>
                    <div class="col-6 text-end" style="flex: 1;">
                        <form method="POST" action="${routedelete}"
                            onsubmit="return confirm('Yakin akan dihapus?')" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm w-100"
                                style="background-color: #dc3545; color: white; border: none; border-radius: 5px; font-size: 12px; padding: 6px;">
                                <i class="fa-solid fa-trash-can"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>

                <div class="mt-2 text-muted" style="font-size: 12px; margin-top: 8px; color: #003366;">
                    <strong>Dibuat oleh:</strong> ${feature.properties.user_created}
                </div>
            </div>
        `;

                    layer.on({
                        click: function(e) {
                            point.bindPopup(popupContent);
                        },
                        mouseover: function(e) {
                            point.bindTooltip(feature.properties.name);
                        },
                    });
                },
            });

            $.getJSON("{{ route('api.points') }}", function(data) {
                point.addData(data);
                map.addLayer(point);
            });

            // GeoJSON Polylines
            var polyline = L.geoJson(null, {
                onEachFeature: function(feature, layer) {

                    var routedelete = "{{ route('polylines.destroy', ':id') }}";
                    routedelete = routedelete.replace(':id', feature.properties.id);

                    var routeedit = "{{ route('polylines.edit', ':id') }}";
                    routeedit = routeedit.replace(':id', feature.properties.id);

                    var popupContent = `
            <div style="
                font-family: 'Segoe UI', sans-serif;
                max-width: 270px;
                background-color: #e8f4fd;
                border: 1px solid #007bff;
                border-radius: 10px;
                padding: 12px;
                box-shadow: 0 2px 6px rgba(0, 123, 255, 0.2);
                font-size: 13px;
                line-height: 1.4;
                color: #003366;
            ">
                <div style="font-weight: 700; font-size: 15px; margin-bottom: 6px; color: #0056b3;">
                    ${feature.properties.name}
                </div>
                <div><strong>Deskripsi:</strong> ${feature.properties.description}</div>
                <div><strong>Panjang:</strong> ${feature.properties.length_km.toFixed(2)} km</div>
                <div><strong>Dibuat:</strong> ${feature.properties.created_at}</div>

                <img src="{{ asset('storage/images') }}/${feature.properties.image}"
                    alt="" style="width: 100%; height: auto; margin-top: 8px; border-radius: 6px; object-fit: cover; border: 1px solid #007bff;" />

                <div class="row" style="margin-top: 10px; display: flex; gap: 6px;">
                    <div class="col-6" style="flex: 1;">
                        <a href="${routeedit}" class="btn btn-sm w-100"
                            style="background-color: #007bff; color: white; border: none; border-radius: 5px; font-size: 12px; padding: 6px;">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </div>
                    <div class="col-6 text-end" style="flex: 1;">
                        <form method="POST" action="${routedelete}" style="margin: 0;"
                            onsubmit="return confirm('Yakin akan dihapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm w-100"
                                style="background-color: #dc3545; color: white; border: none; border-radius: 5px; font-size: 12px; padding: 6px;">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div style="margin-top: 8px; font-size: 12px; color: #003366;">
                    <strong>Dibuat oleh:</strong> ${feature.properties.user_created}
                </div>
            </div>
        `;

                    layer.on({
                        click: function(e) {
                            polyline.bindPopup(popupContent);
                        },
                        mouseover: function(e) {
                            polyline.bindTooltip(feature.properties.name);
                        },
                    });
                },
            });

            $.getJSON("{{ route('api.polylines') }}", function(data) {
                polyline.addData(data);
                map.addLayer(polyline);
            });


            // GeoJSON Polygons
            var polygon = L.geoJson(null, {
                onEachFeature: function(feature, layer) {

                    var routedelete = "{{ route('polygons.destroy', ':id') }}";
                    routedelete = routedelete.replace(':id', feature.properties.id);

                    var routeedit = "{{ route('polygons.edit', ':id') }}";
                    routeedit = routeedit.replace(':id', feature.properties.id);

                    var popupContent = `
                                                <div class="popup-content" style="max-width: 250px; font-size: 14px;">
                                                    <div class="mb-1"><strong>Nama:</strong> ${feature.properties.name}</div>
                                                    <div class="mb-1"><strong>Deskripsi:</strong> ${feature.properties.description}</div>
                                                    <div class="mb-1"><strong>Luas:</strong> ${feature.properties.area_ha.toFixed(2)} ha</div>
                                                    <div class="mb-1"><strong>Tanggal dibuat:</strong> ${feature.properties.created_at}</div>

                                                    <div class="text-center my-2">
                                                        <img src="{{ asset('storage/images') }}/${feature.properties.image}"
                                                            alt="Gambar" class="img-fluid" style="max-width: 200px; border-radius: 8px;">
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-6">
                                                            <a href="${routeedit}" class="btn btn-warning btn-sm w-100">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-6 text-end">
                                                            <form method="POST" action="${routedelete}"
                                                                onsubmit="return confirm('Yakin akan dihapus?')" class="m-0">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm w-100">
                                                                    <i class="fa-solid fa-trash-can"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <div class="mb-1 text-muted"><small><strong>Dibuat oleh:</strong> ${feature.properties.user_created}</small></div>
                                                </div>
                                            `;


                    // "Luas: " + feature.properties
                    //     .area_ha.toFixed(2) + " ha" + "<br>" +
                    // "Dibuat: " + feature.properties.created_at;
                    layer.bindPopup(popupContent);

                    layer.on({
                        click: function(e) {
                            polygon.bindPopup(popupContent);
                        },
                        mouseover: function(e) {
                            polygon.bindTooltip(feature.properties.name);
                        },
                    });
                },
            });
            $.getJSON("{{ route('api.polygons') }}", function(data) {
                polygon.addData(data);
                map.addLayer(polygon);
            });
        </script>

        <script>
            function toggleSidebar() {
                const sidebar = document.querySelector('.map-sidebar');
                sidebar.classList.toggle('active');
            }
        </script>
    @endsection

    </html>
