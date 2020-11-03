@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">PHH</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Dashboard Admin
                        <section id="minimal-statistics-bg">
                            <div id="crypto-stats-3" class="row">
                                <div class="col-xl-4 col-lg-6 col-12">
                                    <div class="card crypto-card-3 bg-info">
                                        <div class="card-content">
                                            <div class="card-body cc CLOAK pb-1">
                                                <h4 class="text-white font-large-1 mb-2"><i class="icon-user" title="User"></i> User Terdaftar</h4>
                                                <h6 class="text-white">Total</h6>
                                                <h5 class="text-white">{{\App\User::count()}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-12">
                                    <div class="card crypto-card-3 bg-info">
                                        <div class="card-content">
                                            <div class="card-body cc HEAT pb-1">
                                                <h4 class="text-white font-large-1 mb-2"><i class="fa fa-map" title="BTC"></i> Menu</h4>
                                                <h6 class="text-white">Total</h6>
                                                <h5 class="text-white">{{\App\model\Menu::count()}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-12">
                                    <div class="card crypto-card-3 bg-info">
                                        <div class="card-content">
                                            <div class="card-body cc NVC pb-1">
                                                <h4 class="text-white font-large-1 mb-2"><i class="fa fa-money" title="ETH"></i> Transaksi</h4>
                                                <h6 class="text-white">Total</h6>
                                                <h5 class="text-white">{{\App\model\Penjualan::count()}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
