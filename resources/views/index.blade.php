<x-app-layout>
    <!-- home -->
    <section class="home" id="home">
        <div class="home-container container grid">
            <img src="logojanjee/bg.png" alt="" class="home-img">

            <div class="home-data">
                <h1 class="home-title">
                    Janjee <br> Indonesia
                </h1>
                <p class="home-description">
                    Satu aplikasi untuk reservasi beragam layanan yang kamu butuhkan.
                    <br> <span class="">"Skip the Wait, Know Before You Go."</span>
                </p>
                <a href="#steps" class="button button--flex">
                    Mulai <i class="ri-arrow-right-line button-icon"></i>
                </a>
            </div>

            <div class="home-social">
                <span class="home-social-follow">Follow Us</span>

                <div class="home-social-links">
                    <a href="https://www.instagram.com/janjee.indonesia/" target="_blank" class="home-social-link">
                        <i class="ri-instagram-fill"></i>
                    </a>
                    <a href="https://www.instagram.com/janjee.indonesia/" target="_blank" class="home-social-link">
                        <i class="ri-facebook-line"></i>
                    </a>
                    <a href="https://www.instagram.com/janjee.indonesia/" target="_blank" class="home-social-link">
                        <i class="ri-twitter-fill"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- steps -->
    <section class="steps section container" id="steps">
        <div class="steps-bg">

            <h3 class="section-title-center steps-title">
                Pilih Kategori
            </h3>
            <div class="steps-container grid">
                @foreach ($category as $key => $value)
                    <a href="{{ route('category.view', $value->slug) }}" class="steps-card">
                        <img src="{{ asset($value->image) }}" alt="{{ $value->name }}">
                        <h3 class="steps-card-title">{{ $value->name }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- about -->
    <section class="about section-about container" style="margin-top: 80px!important;" id="about">
        <div class="about-container grid">
            <img src="logojanjee/kelebihan.jpg" alt="" class="about-img">

            <div class="about-data">
                <h2 class="section-title about-title tagline">
                    Jadwalkan waktumu <br> Maksimalkan aktivitasmu
                </h2>

                <p class="about-description">
                    Dengan JanJee, kamu tidak perlu lagi membuang waktu untuk mengantri. Atur jadwal serta aktivitas lainnya dengan mudah. Lihat langsung ketersediaan mereka, sehingga kamu bisa memanfaatkan waktumu untuk hal lain yang lebih produktif.
                </p>

                <div class="about-details">
                    <p class="about-details-description">
                        <i class="ri-checkbox-fill about-details-icon"></i>
                        We always deliver on time.
                    </p>
                    <p class="about-details-description">
                        <i class="ri-checkbox-fill about-details-icon"></i>
                        We give you guides to protect and care for your plants.
                    </p>
                    <p class="about-details-description">
                        <i class="ri-checkbox-fill about-details-icon"></i>
                        We always come over for a check-up after sale.
                    </p>
                    <p class="about-details-description">
                        <i class="ri-checkbox-fill about-details-icon"></i>
                        100% money back guaranteed.
                    </p>
                </div>

                <a href="#" class="button--link button--flex">
                    Mulai sekarang <i class="ri-arrow-right-down-line button-icon"></i>
                </a>
            </div>
        </div>
    </section>


    <!-- products -->
    <section class="product section container" style="margin-bottom: 80px!important;" id="products">

        <div class="container" style="margin-top: 20px;">
            <h2 class="section-title-center">
                Event Terbaru
            </h2>

            <p class="product-description">
                Beberapa event atau competition yang ada di garut
            </p>
            <div class="cards">
                <!-- Card 1 -->
                <div class="card">
                    <img src="assets/img/event.jpg" alt="Trofeo Persib" class="card-image">
                    <div class="card-content">
                        <span class="badge">Futsal & Badminton</span>
                        <h3>Piala Rektor</h3>
                        <p><strong>📅</strong> 28-30 November 2024</p>
                        <p><strong>📍</strong> Gordah & Gor Pesona Intan</p>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="card">
                    <img src="assets/img/event2.jpg" alt="Weekend Fun Futsal" class="card-image">
                    <div class="card-content">
                        <span class="badge">Futsal</span>
                        <h3>Himatif ITG Competition</h3>
                        <p><strong>📅</strong> 28-30 Oktober 2024</p>
                        <p><strong>📍</strong> Gordah</p>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="card">
                    <img src="assets/img/event3.jpg" alt="Turnamen Badminton" class="card-image">
                    <div class="card-content">
                        <span class="badge">Futsal</span>
                        <h3>Noctur Championship</h3>
                        <p><strong>📅</strong> 5-7 Januari 2024</p>
                        <p><strong>📍</strong> SOR RAA Adiwijaya</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Contact-->
    <section class="contact section-contact container" id="contact">
        <div class="contact-container grid">
            <div class="contact-box">
                <div class="contact-data">
                    <div class="contact-information">
                        <h3 class="contact-subtitle">Call us for instant support</h3>
                        <span class="contact-description">
                            <i class="ri-phone-line contact-icon"></i>
                            +62 878-9231-2759
                        </span>
                    </div>

                    <div class="contact-information">
                        <h3 class="contact-subtitle">Write me by mail</h3>
                        <span class="contact-description">
                            <i class="ri-mail-line contact-icon"></i>
                            janjee@gmail.com
                        </span>
                    </div>
                </div>
            </div>

            <form action="" class="contact-form">
                <div class="contact-inputs">
                    <div class="contact-content">
                        <input type="email" placeholder=" " class="contact-input">
                        <label for="" class="contact-label">Email</label>
                    </div>

                    <div class="contact-content">
                        <input type="text" placeholder=" " class="contact-input">
                        <label for="" class="contact-label">Subject</label>
                    </div>

                    <div class="contact-content contact-area">
                        <textarea name="message" placeholder=" " class="contact-input"></textarea>
                        <label for="" class="contact-label">Message</label>
                    </div>
                </div>

                <button class="button button--flex">
                    Send Message
                    <i class="ri-arrow-right-up-line button-icon"></i>
                </button>
            </form>
        </div>
    </section>
</x-app-layout>
