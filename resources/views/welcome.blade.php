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
        <!-- Gambar -->
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <img src="{{ asset('adminlte2/dist/img/bmw2.png') }}" alt="bmw2" class="img-fluid rounded">
            </div>
        </div>

        <!-- Deskripsi -->
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

                    <p>🔧 Setiap unit mobil yang masuk ke showroom kami akan melewati proses pemeriksaan <strong>menyeluruh oleh tim mekanik khusus</strong> yang telah berpengalaman bertahun-tahun di industri otomotif.</p>

                    <p>📂 Kami juga memastikan bahwa <strong>seluruh dokumen kendaraan tersedia dan valid</strong> mulai dari BPKB, STNK, faktur pembelian, hingga riwayat servis jika tersedia.</p>

                    <p>🧯 <strong>Proses inspeksi dilakukan dengan alat modern dan checklist lengkap</strong> yang mencakup sistem mesin, transmisi, rem, kaki-kaki, interior, hingga sistem kelistrikan.</p>
                    
                    <p>🎯 <strong>Visi kami adalah </strong>memberikan Anda pengalaman membeli mobil yang aman, nyaman, dan bebas rasa khawatir.</p>

                    {{-- <p class="mt-3"><strong>🎉 Datang & Rasakan Pengalaman Belanja Mobil yang Berbeda di Alyssa & Co.!</strong></p> --}}
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
