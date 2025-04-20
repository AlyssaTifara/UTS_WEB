@extends('layouts.template')

@section('content')
<div class="container-fluid mt-3">
    <div class="card elevation-3">
        <div class="card-body bg-gradient-primary text-white text-center rounded">
            <h2 class="font-weight-bold">✨ Selamat Datang di <span style="font-family: 'Georgia', serif;">Alyssa & Co. Showroom</span> – Surabaya ✨</h2>
            <p class="mb-0">📍 <strong>Jl. Basuki Rahmat No. 89, Tegalsari, Surabaya, Jawa Timur 60271</strong></p>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Carousel Gambar Mobil -->
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div id="mobilCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
                    <div class="carousel-inner rounded">
                        <div class="carousel-item active">
                            <img src="{{ asset('adminlte2/dist/img/bmw2.png') }}" class="d-block w-100" alt="bmw2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('adminlte2/dist/img/porshe.png') }}" class="d-block w-100" alt="porshe">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('adminlte2/dist/img/mazda2.png') }}" class="d-block w-100" alt="mazda2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('adminlte2/dist/img/mercy.png') }}" class="d-block w-100" alt="mercy">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('adminlte2/dist/img/range_r.png') }}" class="d-block w-100" alt="range_r">
                        </div>
                    </div>
                    <!-- Tombol Panah -->
                    <a class="carousel-control-prev" href="#mobilCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#mobilCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Deskripsi Showroom -->
        <div class="col-md-6">
            <div class="card card-outline card-info h-100">
                <div class="card-body">
                    <h4 class="text-primary font-weight-bold">Temukan Mobil Impian Anda, di Tempat yang Tepat 🚗</h4>
                    <p>Alyssa & Co. hadir di jantung kota Surabaya sebagai showroom terpercaya untuk Anda yang menginginkan <strong>mobil kelas menengah hingga premium</strong>.</p>

                    <ul class="fa-ul">
                        <li><span class="fa-li"><i class="fas fa-check-circle text-success"></i></span><strong>Koleksi Eksklusif</strong> dari brand ternama</li>
                        <li><span class="fa-li"><i class="fas fa-check-circle text-success"></i></span><strong>Kondisi Prima</strong>, siap jalan & telah lolos inspeksi</li>
                        <li><span class="fa-li"><i class="fas fa-check-circle text-success"></i></span><strong>Layanan Personal</strong> dan profesional</li>
                        <li><span class="fa-li"><i class="fas fa-check-circle text-success"></i></span><strong>Lokasi Strategis</strong> dan mudah dijangkau</li>
                    </ul>

                    <p>🔧 Setiap unit mobil yang masuk ke showroom kami akan melalui <strong>proses pemeriksaan menyeluruh oleh tim mekanik ahli</strong> yang memiliki pengalaman bertahun-tahun di industri otomotif, memastikan bahwa mobil Anda berada dalam kondisi terbaik.</p>

                    <p>📂 Kami juga <strong>memastikan seluruh dokumen kendaraan tersedia dan sah</strong>, mulai dari BPKB, STNK, faktur pembelian, hingga riwayat servis, agar Anda merasa tenang dan yakin dengan setiap pembelian.</p>

                    <p>🧯 <strong>Proses inspeksi kami menggunakan alat modern dan checklist komprehensif</strong>, mencakup segala aspek penting seperti mesin, transmisi, rem, kaki-kaki, interior, hingga sistem kelistrikan semuanya untuk memberikan Anda rasa aman dan nyaman.</p>

                    <p>🎯 <strong>Visi kami adalah</strong> memberikan Anda pengalaman membeli mobil yang <strong>tanpa rasa khawatir</strong>, nyaman, dan pasti memuaskan.</p>

                    <p>📞 <strong>Hubungi kami sekarang dan dapatkan penawaran spesial. </strong></p>
                    <ul>
                        <li><strong>Nama:</strong> Alyssa & Co. Showroom</li>
                        <li><strong>Email:</strong> info@alyssa_co.com</li>
                        <li><strong>No. Telp:</strong> +62 311-2347-5678</li>
                        <li><strong>Instagram:</strong> @alyssa.co_showroom</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
