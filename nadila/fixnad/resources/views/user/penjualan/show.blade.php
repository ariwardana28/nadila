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
                <a href="index.html"><img src="{{asset('web/images/logo.png')}}" alt=""/> </a>
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
                        <li><h3>Produk THH</h3><a href=""></a></li>
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
                    Konfirmasi Pembayaran
                    <div style="float: right">
                        <a href="{{url('/penjualan')}}" class="btn btn-sm btn-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <table class="table table-sm table-borderless">
                        @foreach ($penjualan as $item)
                            <tr>
                                <td style="width: 100px">Nama</td>
                                <td>:</td>
                                <td>{{$item->User->name}}</td>
                            </tr>
                            <tr>
                                <td style="width: 100px">Alamat</td>
                                <td>:</td>
                                <td>{{$item->alamat}}</td>
                            </tr>
                            @if ($item->status !=null)
                                <tr>
                                        <td>Status</td>
                                        <td>:</td>
                                        <td><b style="color: green">{{$item->status}}</b></td>
                                </tr>
                                <tr>
                                    <td>Struk</td>
                                    <td>:</td>
                                    <td>
                                        <img src="{{asset('file')}}/{{$item->foto}}" width="100px" height="100px" alt="">
                                    </td>
                                </tr>
                            @endif


                        @endforeach
                    </table>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                               <th>No</th>
                               <th>Nama Pesanan</th>
                               <th>Qty</th>
                               <th>Sub Total</th>
                            </tr>
                        </thead>
                        <?php $no=1;?>
                        @foreach ($DetailPenjualan as $item)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$item->Menu->nama}}</td>
                                <td>{{$item->qty}}</td>
                                <td>Rp.{{number_format($item->subtotal)}}</td>
                            </tr>
                        @endforeach
                        @foreach ($penjualan as $item)
                            <tr>
                                <td colspan="3">
                                    <center><b>Total</b></center>
                                </td>
                                <td>Rp. {{number_format($item->total)}}</td>
                            </tr>
                        @endforeach
                    </table>
                    @foreach ($penjualan as $item)
                        @if ($item->foto == null)
                            <form action="{{route('penjualan.bayar',$item->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="foto" id="" class="form-control" required>
                                <input type="hidden" name="status" id="" value="Sedang diproses" class="form-control" >
                                <br>
                                <input type="submit" value="Submit" class="btn btn-sm btn-success">
                            </form>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

