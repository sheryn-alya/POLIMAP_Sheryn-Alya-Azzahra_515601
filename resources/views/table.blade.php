@extends('layout.template')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        /* === BACKGROUND IMAGE WRAPPER === */
        .table-wrapper-with-bg {
            position: relative;
            width: 100%;
            min-height: 100vh;
            background-image: url('{{ asset('images/adat3.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Overlay untuk dark mode */
        .table-wrapper-with-bg .overlay-darkmode {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0);
            /* default transparan */
            transition: background-color 0.5s ease;
            z-index: 0;
        }

        .dark-mode .table-wrapper-with-bg .overlay-darkmode {
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* .table-wrapper-with-bg .container {
                position: relative;
                z-index: 1;
                padding-top: 60px;
                padding-bottom: 60px;
                background-color: rgba(255, 255, 255, 0.15);
                /* semi transparan */
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        /* untuk Safari */
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        */

        /* === DARK MODE STYLING === */
        body {
            transition: background-color 0.5s, color 0.5s;
        }

        .dark-mode {
            background-color: #121212 !important;
            color: #f1f1f1 !important;
        }

        .dark-mode .card,
        .dark-mode .card-body,
        .dark-mode .card-header {
            background-color: rgba(30, 30, 30, 0.95) !important;
            color: #f1f1f1 !important;
            border-color: #444;
        }

        .dark-mode table.dataTable thead th {
            background-color: #333 !important;
            color: #f1f1f1 !important;
        }

        .dark-mode table.dataTable tbody tr:nth-child(even),
        .dark-mode table.dataTable tbody tr:nth-child(odd) {
            background-color: rgba(50, 50, 50, 0.9) !important;
            color: #f1f1f1;
        }

        .dark-mode .table img.img-thumbnail {
            border-color: #666;
        }

        /* === TABLE STYLING === */
        .card {
            border: 1px solid #00188e;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background-color: rgba(255, 255, 255, 0.9);
            /* semi transparan */
        }

        .card-header {
            background-color: #00188e;
            color: white;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 600;
            padding: 10px 20px;
        }

        .card-header h4 {
            margin: 0;
            font-size: 18px;
        }

        .card-body {
            padding: 16px 20px;
        }

        table.dataTable {
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            width: 100%;
            animation: fadeIn 0.4s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        table.dataTable thead th {
            background-color: #00188e;
            color: white;
            text-align: center;
        }

        table.dataTable tbody tr:nth-child(even) {
            background-color: #f4f6fa;
        }

        table.dataTable tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        table.dataTable tbody tr:hover {
            background-color: #e6f0ff !important;
            transform: scale(1.005);
            transition: all 0.2s ease-in-out;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .table img.img-thumbnail {
            border: 2px solid #00188e;
            border-radius: 8px;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        /* Dark Mode Toggle Button */
        #toggle-darkmode {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 2;
        }
    </style>
@endsection

@section('content')
    {{-- === DARK MODE TOGGLE === --}}
    <div class="table-wrapper-with-bg">
        <div class="overlay-darkmode"></div>

        <div class="text-end p-3">
            <button id="toggle-darkmode" class="btn btn-dark">
                🌙 Dark Mode
            </button>
        </div>

        <div class="container">

            {{-- Points Table --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Points Table</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="pointstable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Alamat</th>
                                <th>Gambar</th>
                                <th>Dibuat pada</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($points as $p)
                                <tr>
                                    <td>{{ $p->id }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->description }}</td>
                                    <td>
                                        <img src="{{ asset('storage/images/' . $p->image) }}" alt=""
                                            class="img-thumbnail map-image" style="width: 200px; height: auto;"
                                            title="{{ $p->image }}" data-lat="{{ $p->latitude }}"
                                            data-lng="{{ $p->longitude }}">

                                    </td>
                                    <td>{{ $p->created_at }}</td>
                                    <td>{{ $p->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Polyline Table --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Data Polylines</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="polylinestable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Tujuan</th>
                                <th>Gambar</th>
                                <th>Dibuat pada</th>
                                <th>Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($polylines as $p)
                                <tr>
                                    <td>{{ $p->id }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->description }}</td>
                                    <td>
                                        <img src="{{ asset('storage/images/' . $p->image) }}" alt=""
                                            class="img-thumbnail" style="width: 200px; height: auto;"
                                            title="{{ $p->image }}">
                                    </td>
                                    <td>{{ $p->created_at }}</td>
                                    <td>{{ $p->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
    <script>
        let pointstable = new DataTable('#pointstable');
        let polylinestable = new DataTable('#polylinestable');
    </script>

    <script>
        // Toggle Dark Mode
        document.getElementById('toggle-darkmode').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            this.textContent = document.body.classList.contains('dark-mode') ? '☀️ Light Mode' : '🌙 Dark Mode';
        });
    </script>

@endsection
