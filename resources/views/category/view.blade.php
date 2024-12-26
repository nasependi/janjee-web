<!doctype html>
<html lang="en">
@php
    use Illuminate\Support\Facades\Storage;
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Swiper Thumbnail Gallery</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ asset('assets/lapang.css') }}">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('logojanjee/janjee-logo-text.svg') }}" width="100" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form class="d-flex search-bar ms-auto">
                    <input class="form-control me-2" type="search" placeholder="Cari lapang.." aria-label="Search">
                </form>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link btn btn-sm btn-outline-warning me-3" href="{{ route('filament.admin.auth.login') }}">Masuk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <!-- Main Swiper -->
        <div class="swiper swiper-main mt-4">
            <div class="swiper-wrapper">
                @forelse($category->place as $key => $place)
                    <div class="swiper-slide"><img src="{{ Storage::url($place->image) }}" alt="Item {{ $key + 1 }}">
                        <div class="aku">
                            <div class="text-white h3 fw-bold ms-2">{{ $place->name }}</div>
                            <div class="text-white h5 ms-2">{{ $place->address }}</div>
                            <ul class="list-unstyled list-inline ms-2 mt-2">
                                <a href="{{ route('booking.view',[$category->slug, $place->slug]) }}" class="btn btn-outline-warning text-white px-5">Boking</a>
                            </ul>
                        </div>
                    </div>
                @empty
                    Belum ada tempat
                @endforelse
            </div>
        </div>

        <!-- Thumbnail Swiper -->
        <div class="swiper swiper-thumb mt-2">
            <div class="swiper-wrapper">
                @foreach ($category->place as $key => $place)
                    <div class="swiper-slide"><img src="{{ Storage::url($place->image) }}" alt="Thumbnail {{ $key + 1 }}"></div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Initialize thumbnail Swiper
        var swiperThumb = new Swiper(".swiper-thumb", {
            spaceBetween: 10,
            slidesPerView: 5,
            freeMode: true,
            watchSlidesProgress: true,
        });

        // Initialize main Swiper with thumbs and autoplay
        var swiperMain = new Swiper(".swiper-main", {
            spaceBetween: 10,
            thumbs: {
                swiper: swiperThumb,
            },
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
        });

        // Menampilkan loader
        document.querySelector('.loader').style.display = 'block';

        // Menyembunyikan loader (contoh setelah 3 detik)
        setTimeout(() => {
            document.querySelector('.loader').style.display = 'none';
        }, 1000);
    </script>
</body>

</html>
