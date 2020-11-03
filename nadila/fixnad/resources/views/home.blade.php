@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                        <div class="row match-height">
                            <div class="col-lg-12 col-md-12 mb-1">
                                <div class="card alert bg-transparent alert-dismissible mb-2 pl-2" role="alert">
                                    <div class="media-body align-self-center">
                                        <span class="font-large-1"><b>Perhatian</b></span>
                                    </div>
                                    <p>Selamat datang di halaman Dasboard PHH Market, berikut penjelasan fitur dari PHH Market.

                                    <ul>
                                        <li>Silahkan ke menu <code>Kelola User</code> Untuk melakukan pengelolaan User baik itu kelola jenis user ataupun mengelola user.</li>
                                    </ul>
                                    <ul>
                                        <li>Silahkan ke menu <code>Jenis Kendaraan</code> Untuk melakukan perubahan tarif kendaraan ataupun menambah jenis kendaraan.</li>
                                    </ul>
                                    <ul>
                                        <li>Silahkan ke menu <code>Lahan Parkir</code> Untuk melakukan penambahan atau perubahan lahan parkir.</li>
                                    </ul>
                                    <ul>
                                        <li>Silahkan ke menu <code>Lokasi Kerja</code> Untuk melakukan penugasan lokasi kerja para juru parkir.</li>
                                    </ul>

                                    <ul>
                                        <li>Silahkan ke menu <code>Transaksi</code> Untuk melakukan pemantauan hasil transaksi.</li>
                                    </ul>

                                    </p>
                                    <span class="font-medium-1">Terimakasih dan Selamat Berbelanja.</span>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
