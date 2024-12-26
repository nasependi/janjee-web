<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ asset('assets/booking.css') }}">
    <title>{{ $place->name }}</title>
</head>
@php
    use Illuminate\Support\Facades\Storage;

@endphp

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('logojanjee/janjee-logo-text.svg') }}" width="100" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link btn btn-sm btn-outline-warning me-3" href="{{ route('filament.admin.auth.login') }}">Masuk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <img src="{{ asset('assets/img/bg-futsal.jpg') }}" class="image-container mt-3" alt="">
        <div class="centered h1">{{ $place->name }}</div>
    </div>

    <section class="booking-lapang">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="swiper mySwiper mt-3 mb-2">
                        <div class="swiper-wrapper">
                            @foreach ($place->field as $key => $value)
                                <div class="swiper-slide">
                                    <img src="{{ Storage::url($value->image) }}" alt="Image {{ $key + 1 }}" class="swiper-img">
                                </div>
                            @endforeach
                        </div>
                        <!-- Navigation buttons -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="accordion mt-3" id="accordionExample">
                        @php
                            use App\Models\Booking;
                            $startTime = 9; // Mulai jam 09
                            $endTime = 20; // Hingga jam 20
                        @endphp
                        @forelse($place->field as $key => $value)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $value->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $value->id }}" aria-expanded="false" aria-controls="collapse{{ $value->id }}">
                                        {{ $value->name }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $value->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $value->id }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <table class="table table-bordered mt-3 mb-2">
                                            <tr class="bg-warning text-white">
                                                <th>Hari</th>
                                                <th>Jam</th>
                                                <th>Boking</th>
                                            </tr>
                                            @for ($hour = $startTime; $hour < $endTime; $hour++)
                                                @php
                                                    $startAt = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00:00'; // Format waktu: 09:00:00
                                                    $endAt = str_pad($hour + 1, 2, '0', STR_PAD_LEFT) . ':00:00'; // Format waktu: 10:00:00
                                                @endphp
                                                <tr>
                                                    @if ($hour == $startTime)
                                                        <td rowspan="{{ $endTime - $startTime }}">{{ $hari }}</td>
                                                    @endif
                                                    <td>{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00 - {{ str_pad($hour + 1, 2, '0', STR_PAD_LEFT) }}:00</td>
                                                    <td>
                                                        @if (Booking::where('field_id', $value->id)->where('date', date('Y-m-d'))->where('start_at', $startAt)->exists())
                                                            <button disabled="disabled" class="btn btn-xs btn-danger">Full Booking</button>
                                                        @else
                                                            <button type="button" class="btn btn-success btn-xs" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $value->id }}{{ $hour }}">
                                                                Booking via WhatsApp
                                                            </button>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="bookingModal{{ $value->id }}{{ $hour }}" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="bookingModalLabel">Data Pelanggan</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="bookingForm">
                                                                                <div class="mb-3 text-start">
                                                                                    <label for="customerName" class="form-label">Nama Anda</label>
                                                                                    <input type="text" class="form-control" id="customerName" placeholder="Masukkan nama Anda" required>
                                                                                    <input type="hidden" name="fieldId" id="fieldId" value="{{ $value->id }}">
                                                                                    <input type="hidden" id="lapangName" value="{{ $value->name }}">
                                                                                    <label for="customerName" class="form-label mt-2">Nomor Telepon</label>
                                                                                    <input type="text" class="form-control" id="customerPhone" placeholder="Masukkan Nomor Telepon" required>
                                                                                    <input type="hidden" name="jamId" id="jamId" value="{{ $hour }}">
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                                                                                Tutup
                                                                            </button>
                                                                            <button type="button" class="btn btn-sm btn-success" id="waButton">
                                                                                Booking via WhatsApp
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endfor
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @empty
                            Belum ada Lapang
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Initialize Swiper
        const swiper = new Swiper(".mySwiper", {
            slidesPerView: 3, // Jumlah slide yang terlihat
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            loop: true,
        });

        // Handle click to toggle class
        document.querySelectorAll(".swiper-img").forEach((img) => {
            img.addEventListener("click", () => {
                img.classList.toggle("clicked");
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const waButton = document.getElementById('waButton');

            waButton.addEventListener('click', function() {
                const name = document.getElementById('customerName').value;
                const fieldId = document.getElementById('fieldId').value;
                const phoneNumber = document.getElementById('customerPhone').value;
                const hour = document.getElementById('jamId').value;
                const lapang = document.getElementById('lapangName').value;

                fetch('/booking-create', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            name: name,
                            fieldId: fieldId,
                            hour: hour,
                            phone_number: phoneNumber
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        const waUrl = `https://wa.me/{{ $place->user->phone_number }}?text=Halo%20saya%20${encodeURIComponent(name)}%20dari%20aplikasi%20Janjee,%20ingin%20memboking%20lapang%20(${lapang})%20dari%20jam%20(${hour+`:00`})%20apakah%20tersedia?`;
                        window.open(waUrl, '_blank');
                        window.location.reload();
                    });
            });
        });
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

</body>

</html>
