<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>PHH Market</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
<link href="{{asset('web/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
<script src="{{asset('web/js/jquery.min.js')}}"></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<!-- start top_js_button -->
<script type="text/javascript" src="{{asset('web/js/move-top.js')}}"></script>
<script type="text/javascript" src="{{asset('js/easing.js')}}"></script>
   <script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
			});
		});
	</script>
</head>
<body>
<div class="header_bg">
    <div class="wrap">
        <div class="header">
            <div class="logo">
                <a href="index.html"><img src="{{asset('web/images/logo_copy.png')}}" alt=""/> </a>
            </div>
            <div class="h_icon">
            </div>

            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="header_btm">
    <div class="wrap">
        <div class="header_sub">
            <div class="h_menu">
                <ul>
                    <li><a href="{{url('penjualan/create')}}">Produk</a></li> |
                    <li><a href="{{url('penjualan')}}">Konfirmasi</a></li> |
                    <li>
                        <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                    </li>
                </ul>
            </div>
            <div class="top-nav">
                <nav class="nav">
                    <a href="#" id="w3-menu-trigger"> </a>
                        <ul class="nav-list" style="">
                            <li class="nav-item"><a class="active" href="index.html">Pesan</a></li>
                            <li class="nav-item"><a href="sale.html">Transaksi</a></li>
                        </ul>
                </nav>
                <div class="clear"> </div>
                <script src="js/responsive.menu.js"></script>
            </div>
        <div class="clear"></div>
    </div>
</div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                   Data Profil
                    <div style="float: right">
                        <a href="{{url('/penjualan/create')}}" class="btn btn-sm btn-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Nama Field -->
                    <div class="form-group row mb-1">
                        <label class="col-md-3  label-control text-bold-800">Nama:</label>
                        <div class="col-md-9">
                            <p class="text-body">{!! $profile->name !!}</p>
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div class="form-group row mb-1">
                        <label class="col-md-3  label-control text-bold-800">Email:</label>
                        <div class="col-md-9">
                            <p class="text-body">{!! $profile->email !!}</p>
                        </div>
                    </div>

                    <!-- Alamat Field -->
                    <div class="form-group row mb-1">
                        <label class="col-md-3  label-control text-bold-800">Alamat:</label>
                        <div class="col-md-9">
                            <p class="text-body">{!! $profile['alamat'] !!}</p>
                        </div>
                    </div>

                    <!-- Tgl Lahir Field -->
                    <div class="form-group row mb-1">
                        <label class="col-md-3  label-control text-bold-800">Tanggal Lahir:</label>
                        <div class="col-md-9">
                            <p class="text-body">{!! $profile['tgl_lahir'] !!}</p>
                        </div>
                    </div>

                    <!-- No Hp Field -->
                    <div class="form-group row mb-1">
                        <label class="col-md-3  label-control text-bold-800">No. Handphone:</label>
                        <div class="col-md-9">
                            <p class="text-body">{!! $profile['no_hp'] !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

