<x-app-layout>
    <x-slot name="header">
        <h2 class="hidden">{{ __('Dashboard') }}</h2>
    </x-slot>

    {{-- TOAST CSS --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

    {{-- GOOGLE FONTS --}}
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Montserrat', sans-serif;
            overflow: hidden;
        }

        .background-wrapper {
            position: relative;
            width: 100%;
            height: 100vh;
            background: url('{{ asset('images/adat2.png') }}') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .overlay-dark {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.6));
            z-index: 1;
        }

        .content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: #fff;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
            padding: 20px;
        }

        .title-text {
            font-family: 'Anton', sans-serif;
            font-size: 3rem;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 15px 40px;
            border-radius: 12px;
            margin-bottom: 1rem;
            display: inline-block;
        }

        .subtitle-text {
            font-size: 1.1rem;
            font-weight: 400;
            margin-bottom: 25px;
        }

        .home-button {
            padding: 0.75rem 2rem;
            font-size: 1rem;
            background-color: #ffffffdd;
            color: #0b2e4e;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .home-button:hover {
            background-color: #0b2e4e;
            color: white;
        }

        @media (max-width: 768px) {
            .title-text {
                font-size: 2.2rem;
                padding: 10px 25px;
            }

            .subtitle-text {
                font-size: 0.95rem;
            }

            .home-button {
                font-size: 0.9rem;
                padding: 0.6rem 1.5rem;
            }
        }
    </style>

    <div class="background-wrapper">
        <div class="overlay-dark"></div>
        <div class="content">
            <div class="title-text">POLIMAP</div>
            <div class="subtitle-text">Sistem Pemetaan Keamanan</div>
            <a href="{{ route('home') }}" class="home-button">Home</a>
        </div>
    </div>

    {{-- TOAST SCRIPT --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                toastr.success(@json(session('success')), 'Sukses', {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 3000
                });
            });
        </script>
    @endif
</x-app-layout>
