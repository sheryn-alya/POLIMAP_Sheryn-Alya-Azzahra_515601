<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Profil User Card --}}
            <div class="p-6 bg-white shadow-md rounded-lg flex items-center space-x-6">
                {{-- Gambar Profil --}}
                <div class="shrink-0">
                    <img class="h-24 w-24 rounded-full object-cover border-2 border-indigo-500"
                        src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                        alt="{{ Auth::user()->name }}">
                </div>

                {{-- Info User --}}
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h3>
                    <p class="text-gray-600">{{ Auth::user()->email }}</p>
                    <p class="mt-2 text-sm text-gray-500">Bergabung sejak
                        {{ Auth::user()->created_at->translatedFormat('d F Y') }}</p>
                </div>
            </div>

            {{-- Form Update Profile --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Form Ganti Password --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Form Hapus Akun --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
