<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>The Aditii Website Template | Accessories :: w3layouts</title>
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
<!-- start header -->
<div class="header_bg">
    <div class="wrap">
        <div class="header">
            <div class="logo">
                <a href="index.html"><img src="{{asset('web/images/logo.png')}}" alt=""/> </a>
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
                    <li>
                        <a href="{{ route('login') }}">Home</a>
                    </li> |
                    <li>
                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li> |
                    @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                
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

<main class="py-4">
    <div class="main_bg">
        <div class="wrap">
            <div class="main">
                @if (isset($_GET['nama']))
                    @if ($_GET['nama']=='sukses')
                        <div class="alert alert-success" role="alert">
                            Barang Anda Telah ditambahkan Ke Keranjang
                        </div>
                    @elseif($_GET['nama']=='habis')
                        <div class="alert alert-danger" role="alert">
                            Stok Barang Tidak Cukup/Habis
                        </div>
                    
                    @endif
                @endif
                <h2 class="style top">Penjualan</h2>
                @foreach ($menu as $item)
                    <div class="grids_of_3">
                        <div class="grid1_of_3">
                            <a href="{{route('penjualan.detail',$item->id)}}">
                               <img src="{{asset('gambar_menu')}}/{{$item->gambar}}" style="width: 150px;hight:150px" alt=""/>
                            </a>
                            <br>
                            <br>
                            <table class="table table-borderless">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{$item->nama}}</td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td>{{number_format($item->harga)}}</td>
                                </tr>
                                <tr>
                                    <td>Stok</td>
                                    <td>:</td>
                                    <td>{{number_format($item->stok)}}</td>
                                </tr>
                                <tr>
                                    <td  colspan="3" >
                                        
                                        <br>
                                        <a href="{{route('penjualan.detail',$item->id)}}" class="btn btn-sm btn-block btn-info">Detail</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="clear"></div> --}}
                @endforeach
            </div>
        </div>
    </div>
</main>
</body>
</html>