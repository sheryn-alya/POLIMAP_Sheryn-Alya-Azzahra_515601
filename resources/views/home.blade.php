@extends('layout.template')

@section('content')
    <div class="container mt-5">

        {{-- Card Identitas --}}
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-header bg-secondary text-white d-flex align-items-center">
                <i class="bi bi-person-circle me-2 fs-4"></i>
                <strong>Identitas Praktikan</strong>
            </div>
            <div class="card-body">
                <p class="card-text text-muted mb-1"><strong>Nama:</strong> Sheryn Alya Azzahra</p>
                <p class="card-text text-muted mb-1"><strong>Kelas:</strong> PGWL B</p>
                <p class="card-text text-muted"><strong>NIM:</strong> 23/515601/SV/22583</p>
            </div>
        </div>

        {{-- Card Praktikum --}}
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-primary text-white d-flex align-items-center">
                <i class="bi bi-globe2 me-2 fs-4"></i>
                <strong>PRAKTIKUM PEMROGRAMAN GEOSPATIAL WEB LANJUTAN</strong>
            </div>
            <div class="card-body">
                <h4 class="card-title text-primary mb-3">
                    Acara 11: Middleware Laravel dan Dashboard Penggunaan Laravel
                </h4>

                <p class="card-text text-muted mb-2">
                    <strong>Topik:</strong> Analisis dan Visualisasi Data Geospasial
                </p>

                <div class="card-text text-muted mb-3">
                    <i class="bi bi-geo-alt me-2"></i>
                    <strong>Tujuan:</strong>
                    <ul class="mt-2">
                        <li>Memahami middleware di Laravel</li>
                        <li>Mengatur hak akses user terhadap halaman web</li>
                        <li>Membuat dashboard pengguna dengan menampilkan resume data</li>
                        <li>Menampilkan data dalam bentuk tabel</li>
                    </ul>
                </div>

                <hr>

                {{-- Tombol menuju halaman map --}}
                @auth
                    <a href="{{ route('map') }}" class="btn btn-outline-primary btn-lg mt-2">
                        <i class="bi bi-map-fill me-1"></i> Buka Peta Interaktif
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-danger btn-lg mt-2">
                        <i class="bi bi-lock-fill me-1"></i> Login untuk Mengakses Peta
                    </a>
                @endauth


            </div>
        </div>

    </div>
@endsection
