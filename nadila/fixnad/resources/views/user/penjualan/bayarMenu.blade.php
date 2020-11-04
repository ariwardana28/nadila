<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>PHH Market | Politani</title>
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
                                                        @method('DELETE')
                                                        <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-sm btn-danger">
                                                    -
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
                                        <a href="" class="btn btn-sm btn-primary">Bayar</a>
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

<main class="py-4">
    <div class="main_bg">
        <div class="wrap">
            <div class="main">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md">
                            <div class="card">

                                <div class="card-header">
                                    @if (isset($_GET['id']))
                                        @if ($_GET['id']=='habis')
                                        <div class="alert alert-danger" role="alert">
                                            Stok Barang Habis/Tidak Cukup
                                        </div>
                                        @endif
                                    @endif
                                    Bayar
                                </div>

                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form action="{{route('penjualan.store')}}" method="post">
                                        @csrf
                                        <label for="">Alamat :</label>
                                        <input type="hidden" name="tanggal" value="{{$now}}">
                                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                        <input type="text" name="alamat" class="form-control" value="{{Auth::user()->alamat}}" required>

                                        <table class="table">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Qty</th>
                                                <th>Harga</th>
                                                <th>Sub Total</th>
                                            </tr>
                                            <?php $no=1;?>
                                            <?php $total=0;?>
                                            @foreach ($bayar as $item)
                                            @if ($item->id_user == Auth::user()->id)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>
                                                    @foreach ($menu as $mn)
                                                        @if ($item->id_produk == $mn->id)
                                                            {{$mn->nama}}
                                                            <input type="hidden" value="{{$mn->nama}}" class="form-control" readonly>
                                                        @endif
                                                    @endforeach
                                                    <input type="hidden" name="id_menu[]" class="form-control" value="{{$item->id_produk}}" readonly>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div>
                                                            <a href="{{route('penjualan.minQty',$item->id)}}" class="btn btn-danger mr-3"><b>-</b></a>
                                                        </div>
                                                        <div>
                                                            <input id="qtyChange" type="text" name="qty[]" class="form-control" value="{{$item->qty}}" readonly>
                                                        </div>
                                                        <div>
                                                            <a href="{{route('penjualan.addQty',$item->id)}}" class="btn btn-info ml-3"><b>+</b></a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @foreach ($menu as $mn)
                                                        @if ($item->id_produk == $mn->id)
                                                            Rp. {{number_format($mn->harga)}}
                                                        <input type="hidden" value="{{$item->qty*$mn->harga}}" name="harga[]" class="form-control" readonly>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($menu as $mn)
                                                        @if ($item->id_produk == $mn->id)
                                                            <?php $total += $item->qty*$mn->harga ?>
                                                            Rp. {{number_format($item->qty*$mn->harga)}}
                                                        <input id="newSub" type="hidden" value="{{$item->qty*$mn->harga}}" name="subtotal[]" class="form-control" readonly>
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                            @endif

                                            @endforeach
                                            <tr>
                                                <td colspan="4">
                                                    <center>Total</center>
                                                </td>
                                                <td>
                                                    Rp. {{number_format($total)}}
                                                    <input id="newTotal" type="hidden" readonly name="total" value="{{$total}}" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">
                                                    <center>
                                                        <input type="submit" value="Cek Out" class="btn btn-sm btn-success">
                                                    </center>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
{{--<script>--}}
{{--    $("#qtyChange").on("input", function(){--}}
{{--        // Print entered value in a div box--}}
{{--        let harga = $("#price").val();--}}
{{--        let qty = $(this).val();--}}
{{--        let newSub = harga*qty;--}}
{{--        let total = $("#newTotal").val();--}}
{{--        console.log(harga);--}}
{{--        $("#newSub").val(newSub);--}}
{{--        $("#newSubTotal").text("Rp. "+newSub);--}}
{{--    });--}}
{{--</script>--}}
</html>
