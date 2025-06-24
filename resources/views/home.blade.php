@extends('layout.template')

@section('content')
<style>
    /* HERO SECTION */
    .hero-background {
        background-image: url('{{ asset('images/adat2.png') }}');
        background-size: cover;
        background-position: center;
        height: 100vh;
        position: relative;
        overflow: hidden;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 2rem;
        text-align: center;
        color: white;
    }

    .hero-overlay h1 {
        font-size: 2.8rem;
        font-weight: bold;
        font-family: 'Merriweather', serif;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
    }

    .hero-overlay p {
        font-size: 1.2rem;
        max-width: 600px;
        margin-bottom: 1rem;
        color: #f1f1f1;
    }

    .btn-map {
        background-color: #ffc107;
        color: #000;
        font-weight: 600;
        border: none;
        border-radius: 30px;
        padding: 10px 25px;
        font-size: 1rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-map:hover {
        background-color: #e0a800;
        color: white;
    }

    /* LOGO */
    .logo-fixed {
        position: absolute;
        top: 80px;
        left: 20px;
        z-index: 10;
        display: flex;
        align-items: center;
    }

    .logo-fixed img {
        height: 50px;
        width: auto;
    }

    .logo-fixed .text {
        margin-left: 10px;
        color: white;
        font-weight: bold;
        line-height: 1.2;
        font-size: 1.2rem;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);
    }

    @media (max-width: 768px) {
        .logo-fixed {
            top: 40px;
            left: 15px;
        }

        .logo-fixed img {
            height: 45px;
        }

        .logo-fixed .text {
            font-size: 1rem;
        }
    }

    /* BERITA SECTION */
    .berita-container {
        padding: 3rem 2rem;
        background-color: #f8f9fa;
    }

    .berita-heading {
        text-align: center;
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .berita-subtitle {
        text-align: center;
        font-size: 1.1rem;
        color: #555;
        margin-bottom: 2rem;
    }

    .berita-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .berita-card {
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    .berita-card:hover {
        transform: translateY(-5px);
    }

    .berita-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .berita-tanggal {
        background-color: #212529;
        color: white;
        font-size: 0.9rem;
        padding: 0.5rem;
        text-align: center;
    }

    .berita-judul {
        padding: 1rem;
        font-weight: 600;
        text-align: center;
        font-size: 1rem;
        min-height: 80px;
        color: #333;
    }

    /* CAROUSEL SECTION */
    .carousel-container {
        background-color: #fefefe;
        padding: 3rem 2rem;
        text-align: center;
    }

    .carousel-inner img {
        width: 100%;
        height: 300px;
        object-fit: contain;
        border-radius: 10px;
        background-color: #fff;
    }

    .carousel {
        width: 80%;
        max-width: 700px;
        margin: 2rem auto 0;
    }
</style>

<!-- HERO -->
<div class="hero-background">
    <div class="hero-overlay">
        <h1>POLIMAP PADANG</h1>
        <p>Peta Interaktif yang menampilkan Lokasi kantor Kepolisian di sekitar Kota padang
            termasuk pos polisi lalu lintas hingga kantor pusat Kepolisisan
        </p>
        <a href="/map" class="btn btn-map mt-3">
            <i class="fas fa-map-marker-alt me-2"></i> Lihat Peta Keamanan
        </a>
    </div>
</div>

<!-- LOGO -->
<div class="logo-fixed">
    <img src="{{ asset('images/polisi1.png') }}" alt="Logo">
    <div class="text">KEPOLISIAN <br>PADANG</div>
</div>

<!-- BERITA -->
<div id="peta-section" class="berita-container">
    <div class="berita-heading">BERITA <span style="color: orange;">TERKINI</span></div>
    <div class="berita-subtitle">
        Berita Terkini Kepolisian Negara Republik Indonesia Daerah Sumatera Barat Resor Kota Padang
    </div>

    <div class="berita-grid">
        <!-- Card 1 -->
        <div class="berita-card">
            <a href="https://tribratanews.sumbar.polri.go.id/2025/06/13/kapolda-sumbar-dan-kapolresta-padang-hadiri-pelantikan-rektor-dan-para-dekan-baru-upi" target="_blank">
                <img src="{{ asset('images/berita1.jpg') }}" alt="Berita 1">
            </a>
            <div class="berita-tanggal">Jumat, 13 Juni 2025 || Pukul 13:04:44 WIB</div>
            <a href="https://tribratanews.sumbar.polri.go.id/2025/06/13/kapolda-sumbar-dan-kapolresta-padang-hadiri-pelantikan-rektor-dan-para-dekan-baru-upi" target="_blank" class="text-decoration-none">
                <div class="berita-judul">Kapolda Sumbar dan Kapolresta Padang Hadiri Pelantikan Rektor dan Para Dekan Baru UPI</div>
            </a>
        </div>

        <!-- Card 2 -->
        <div class="berita-card">
            <a href="https://youtu.be/34wpOTzAW-Y?si=zKnQTCvfwtXD3SrR" target="_blank">
                <img src="{{ asset('images/berita2.jpg') }}" alt="Berita 2">
            </a>
            <div class="berita-tanggal">Senin, 23 Juni 2025 || JAM 16:48:00 WIB</div>
            <a href="https://youtu.be/34wpOTzAW-Y?si=zKnQTCvfwtXD3SrR" target="_blank" class="text-decoration-none">
                <div class="berita-judul">Polisi melepsakan tembakan peringatan saat merazia preman di kawasan Pasaraya, Kota Padang.</div>
            </a>
        </div>

        <!-- Card 3 -->
        <div class="berita-card">
            <a href="https://www.msn.com/id-id/berita/nasional/fakta-kasus-pembunuhan-berantai-dan-mutilasi-di-padang-pariaman/ar-AA1HdMZQ?ocid=BingNewsVerp" target="_blank">
                <img src="{{ asset('images/berita3.jpg') }}" alt="Berita 3">
            </a>
            <div class="berita-tanggal">23 Juni 2025 || JAM 15:33:00 WIB</div>
            <a href="https://www.msn.com/id-id/berita/nasional/fakta-kasus-pembunuhan-berantai-dan-mutilasi-di-padang-pariaman/ar-AA1HdMZQ?ocid=BingNewsVerp" target="_blank" class="text-decoration-none">
                <div class="berita-judul">Fakta Kasus Pembunuhan Berantai dan Mutilasi di Padang Pariaman</div>
            </a>
        </div>
    </div>
</div>

<!-- CAROUSEL -->
<div class="carousel-container">
    <h2>Galeri <span style="color: orange;">Dokumentasi</span></h2>
    <div id="carouselDokumentasi" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/image1.jpg') }}" class="d-block mx-auto" alt="Dokumentasi 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/image2.jpg') }}" class="d-block mx-auto" alt="Dokumentasi 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/image3.jpg') }}" class="d-block mx-auto" alt="Dokumentasi 3">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/image4.jpg') }}" class="d-block mx-auto" alt="Dokumentasi 4">
            </div>
        </div>
    </div>
</div>

<!-- SMOOTH SCROLL SCRIPT -->
<script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({ behavior: "smooth" });
            }
        });
    });
</script>
@endsection
