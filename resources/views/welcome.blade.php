@extends('layouts.homepage')
@section('content')
<main>
    <section class="section-hero">
        <!-- Slider main container -->
        <div class="headline-text">
            <div class="row g-0 gap-4 align-items-center">
                <div class="col-12 col-md-5">
                    <img src="{{ asset('/img/hero-house.png') }}" alt="">
                </div>
                <div class="col-12 col-md-6 heading-hero d-sm-inline-block">
                    <h1 class="mb-4">Go-Kost Tempat Terbaik Menemukan Kost Anda</h1>
                    <p class="opacity-75">Hai Gokers, selamat databg di website kami. Layanan yang memberikan informasi seputar kost di Pekanbaru. Registrasi akun baru untuk menggunakan layanan kami.</p>
                </div>
            </div>
        </div>
        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
            <!-- Slides -->
                <div class="swiper-slide"><img src="{{ asset('/img/house.jpeg') }}" alt="image-house"></div>
                <div class="swiper-slide"><img src="{{ asset('/img/house-2.jpeg') }}" alt="image-house"></div>
                <div class="swiper-slide"><img src="{{ asset('/img/house-3.jpeg') }}" alt="image-house"></div>
            </div>
        </div>
    </section>

    <section class="section-about">
        <div class="row g-0 gap-5 justify-content-center">
            <h1 class="text-center">Tentang Kami</h1>
                <div class="row align-items-center">
                    <div class="col-12 col-lg-5 text-center text-lg-end mb-5 mb-lg-0">
                        <img src="{{ asset('/icon/my-location.svg') }}" width="50%" alt="">
                    </div>
                    <div class="col-12 col-lg-5 d-inline-block">
                        <p>GO-Kost merupakan sebuah layanan website yang memudahkan anda mencari dan memilih kost yang sesuai dengan keinginan anda. GO-Kost saat ini menyediakan tempat-tempat kost disekitaran Kota Pekanbaru. </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-flow">
        <div class="content-wrapper">
            <div class="row g-0">
                <h1>Kenapa sih harus GO-Kost ?</h1>
            </div>
            <div class="wrapper-img-why g-0">
                <div class="img-why">
                    <img src="{{ asset('/img/flow-image-1.jpeg') }}" alt="">
                    <h2>Mudah</h2>
                    <p>Dengan GO-Kost anda tidak perlu ribet datang ketempat kosnya langsung. Anda dapat mencari informasi seputar kos dan menghubungi penyedia kost tersebut di deskripsi kosnya.</p>
                </div>
                <div class="img-why">
                    <img src="{{ asset('/img/flow-image-2.jpeg') }}" alt="">
                    <h2>Cepat</h2>
                    <p>Sekarang anda dapat memesan kost anda dari GO-Kost langsung dan siap menempati kost impian anda setelah prosedur telah selesai dilakukan.</p>
                </div>
                <div class="img-why">
                    <img src="{{ asset('/img/flow-image-3.jpeg') }}" alt="">
                    <h2>Aksebility</h2>
                    <p>Tenang kok, tak semua layanan GO-Kost sangat bisa anda mengakses nya dimana saja, baik laptop, smartphone bahkan di Smart TV anda sekalipun.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-testimoni">
        <div class="content-wrapper">
            <div class="row">
                <h1 class="text-center">Apa kata mereka ?</h1>
            </div>
            <div class="swiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <img src="{{ asset('/img/testimoni/profile-1.jpeg') }}" alt="">
                        <div class="start-wrapper">
                            <img src="{{ asset('/icon/star.svg') }}" alt="">
                            <img src="{{ asset('/icon/star.svg') }}" alt="">
                            <img src="{{ asset('/icon/star.svg') }}" alt="">
                            <img src="{{ asset('/icon/star.svg') }}" alt="">
                            <img src="{{ asset('/icon/star.svg') }}" alt="">
                        </div>
                        <figure class="text-center">
                            <blockquote class="blockquote">
                                <p>GO-Kost sangat saya rekomendasi buat teman-teman, selain pelayanan yang cepat, pemilik kost juga sangat ramah-ramah. Terimakasih Go-Kost sudah memberikan pelayanan ini.</p>
                            </blockquote>
                            <figcaption class="blockquote-footer">
                                <strong>William Sinaga</strong> <cite title="Source Title">Guru Besar PelitaInSaja</cite>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('/img/testimoni/profile-3.jpeg') }}" alt="">
                        <div class="start-wrapper">
                            <img src="{{ asset('/icon/star.svg') }}" alt="">
                            <img src="{{ asset('/icon/star.svg') }}" alt="">
                            <img src="{{ asset('/icon/star.svg') }}" alt="">
                            <img src="{{ asset('/icon/star.svg') }}" alt="">
                            <img src="{{ asset('/icon/star.svg') }}" alt="">
                        </div>
                        <figure class="text-center">
                            <blockquote class="blockquote">
                                <p>Sering kali kesusahan mencari tempat-tempat kost, akhir nya saya di rekomendasikan teman untuk kunjungi Go-Kost. Dan benar, pelayanan cepat dan mudah. Terimakasih GO-Kost semoga pelayanan terus baik.</p>
                            </blockquote>
                            <figcaption class="blockquote-footer">
                                <strong>Tania Sihotang</strong> <cite title="Source Title">Admin Santet & Marketing</cite>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('/img/testimoni/profile-4.jpeg') }}" alt="">
                        <div class="start-wrapper">
                            <img src="{{ asset('/icon/star.svg') }}" alt="">
                            <img src="{{ asset('/icon/star.svg') }}" alt="">
                            <img src="{{ asset('/icon/star.svg') }}" alt="">
                            <img src="{{ asset('/icon/star.svg') }}" alt="">
                            <img src="{{ asset('/icon/star.svg') }}" alt="">
                        </div>
                        <figure class="text-center">
                            <blockquote class="blockquote">
                                <p>Selama saya pakai GO-Kost saya mendapatkan pelayanan yang baik. Kita bisa memilih kost yang murah dan pemilik kost juga fast respon. Terimakasih GO-Kost sudah menyediakan layanan ini.</p>
                            </blockquote>
                            <figcaption class="blockquote-footer">
                                <strong>Keshia Netta</strong> <cite title="Source Title">Relavan CreativeYounger</cite>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
            
            </div>
        </div>
    </section>

    <section class="section-qna">
        <div class="content-wrapper">
            <h1>Sering ditanyakan</h1>
            <h5 class="text-muted fw-light">Pengguna sering menanyakan hal ini ke kami, mungkin anda salah satunya </h5>
            <div class="row g-0 gap-3 justify-content-between wrapper-img">
                <div class="col-12 col-lg-4">
                    <img src="{{ asset('/icon/omega.svg') }}" width="100%" alt="">
                </div>
                <div class="col-12 col-lg-7">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Apakah saya bisa memesan kost tanpa harus login ?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Mengenai perihal tersebut, anda diwajibkan untuk login terlebih dahulu, agar sistem kami dapat merecord pengguna yang memesan kost dalam sistem kami. Jika anda tidak memiliki akun sebelumnya silahkan registrasi sebagai pengunjung.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Apa saya perlu bayar DP (Uang Muka) tiap kali saya mesan kosan ?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <p>Ya. Untuk memberikan kepercayaan anda kepada kami, maka anda wajib memberikan uang muka ke pemilik kost sebagai tanda bahwa anda akan bener memesan kosan pemilik kosnya. Jika anda sudah membayar uang muka maka jangan lupa untuk memberikan bukti pembayaran dengan mengupload bukti bayar anda.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Apakah saya bisa menghubungi pemilik kos ?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <p>Silahkan menghubungi nomor pemilik kos untuk memastikan ketersediaan kos, hal ini bertujuan untuk memastikan pemilik kos benar memberikan informasi kosan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@include('components.footer')

@endsection