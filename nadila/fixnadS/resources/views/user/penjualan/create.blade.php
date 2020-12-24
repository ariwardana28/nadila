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
<!-- start header -->
<div class="header_bg">
    <div class="wrap">
        <div class="header">
            <div class="logo">
                <a href="index.html"><img src="{{asset('web/images/logo_copy.png')}}" alt=""/> </a>
            </div>
            <div class="h_icon">
            <ul class="icon1 sub-icon1">
                <?php $total=0;?>

                @foreach ($bayar as $item)
                    @if ($item->id_user == Auth::user()->id)
                        @foreach ($menu as $mn)
                            @if ($item->id_produk == $mn->id)
                                <?php $total += $item->qty*$mn->harga ?>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                <li><a class="active-icon c1" href="#"><i>Rp.{{number_format($total)}}</i></a>
                    <ul class="sub-icon1 list">
                        <li><h3>Produk PHH</h3><a href=""></a></li>
                        <?php $no=1;?>
                        <table class="table table-sm">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>

                            @foreach ($bayar as $item)
                                @if ($item->id_user == Auth::user()->id)
                                    @foreach ($menu as $mn)
                                        @if ($item->id_produk == $mn->id )
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$mn->nama}}</td>
                                                <td>{{$item->qty}}</td>
                                                <td>{{$item->qty*$mn->harga}}</td>
                                                <td>
                                                    <form action="{{ route('barang.hapus',$item->id) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="qty" value="{{$item->qty}}">
                                                        <input type="hidden" name="id_produk" value="{{$item->id_produk}}">
                                                        <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-sm btn-danger">-
                                                        </button>
                                                    </form>
                                                    {{-- <a href="" class="btn btn-danger btn-sm">-</a> --}}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif

                            @endforeach
                            <tr>
                                <td colspan="5">
                                    <div style="float:right">
                                        <a href="{{route('penjualan.menuBayar')}}" class="btn btn-sm btn-primary">Bayar</a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </ul>
                </li>
            </ul>
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
                    <li><a href="{{url('penjualan/konfirmasi')}}">Konfirmasi</a></li> |
                    <li><a href="{{url('penjualan')}}">Histori</a></li> |
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
                    <li class="float-right"><a href="{{route('profile')}}">Profil</a></li> |
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
{{--                <h2 class="style top">Penjualan</h2>--}}
                <div class="col-lg-12 row">
                    @foreach ($menu as $item)
{{--                        <div class="card-body">--}}
                            <div class="col-lg-6">
                                <div class="text-center">
                                    <a href="{{route('penjualan.detail',$item->id)}}">
                                        <img src="{{asset('gambar_menu')}}/{{$item->gambar}}" style="width: 300px; height: 300px;" alt=""/>
                                    </a>
                                </div>
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
                                            <form action="{{route('penjualan.storeBayar')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_produk" value="{{$item->id}}" class="form-control">
                                                <input type="hidden" name="id_user" value="{{ Auth::user()->id }}" class="form-control">
                                                <input type="number" min="0" max="{{$item->stok}}" name="qty" class="form-control" required><br>
                                                <input type="submit"  value="Masukkan Keranjang" class="btn btn-sm btn-block btn-primary">
                                            </form>
                                            <br>
                                            <a href="{{route('penjualan.detail',$item->id)}}" class="btn btn-sm btn-block btn-info">Detail</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
{{--                        </div>--}}
{{--                        <div class="grids_of_4">--}}
{{--                            <div class="grid1_of_4">--}}

{{--                            </div>--}}
{{--                        </div>--}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
