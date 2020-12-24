<!DOCTYPE HTML>
<html>
<head>
<title>PHH Market | Politani</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
<link href="{{asset('web/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
<!-- start details -->
<link rel="stylesheet" type="text/css" href="{{asset('web/css/productviewgallery.css')}}" media="all" />
<link href="{{asset('web/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
<script src="{{asset('web/js/jquery.min.js')}}"></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script type="text/javascript" src="{{asset('web/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('web/js/cloud-zoom.1.0.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('web/js/jquery.fancybox.pack.js')}}"></script>
<script type="text/javascript" src="{{asset('web/js/jquery.fancybox-buttons.js')}}"></script>
<script type="text/javascript" src="{{asset('web/js/jquery.fancybox-thumbs.js')}}"></script>
<script type="text/javascript" src="{{asset('web/js/productviewgallery.js')}}"></script>
<!-- start top_js_button -->
<script type="text/javascript" src="{{asset('web/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('web/js/move-top.js')}}"></script>
<script type="text/javascript" src="{{asset('web/js/easing.js')}}"></script>
   <script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
			});
		});
	</script>
</head>
<style>
    * {box-sizing: border-box}
    
    /* Set height of body and the document to 100% */
    body, html {
      height: 100%;
      margin: 0;
      font-family: Arial;
    }
    
    /* Style tab links */
    .tablink {
      background-color: #555;
      color: white;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      font-size: 17px;
      width: 25%;
    }
    
    .tablink:hover {
      background-color: #777;
    }
    
    /* Style the tab content (and add height:100% for full page content) */
    .tabcontent {
      color: black;
      display: none;
      padding: 10px 20px;
      height: 100%;
    }
    
    /* #Home {background-color: red;}
    #News {background-color: green;}
    #Contact {background-color: blue;}
    #About {background-color: orange;} */
</style>    
<body>
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
                        <li class="float-right"><a href="{{url('penjualan/profile')}}">Profil</a></li> |
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
                <div class="card-header">Daftar Transaksi <br>
                    <button class="tablink" onclick="openPage('Home', this, 'red')" id="defaultOpen">Belum Bayar</button>
                    <button class="tablink" onclick="openPage('News', this, 'green')" >Di Kemas</button>
                    <button class="tablink" onclick="openPage('Contact', this, 'blue')">Di Kirim</button>
                    <button class="tablink" onclick="openPage('About', this, 'orange')">Selesai</button>
                </div>
                    <div class="card-body">                
                        <div id="Home" class="tabcontent">
                            <h3>Belum Bayar</h3>
                        
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Alamat</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;?>
                                    @foreach ($penjualan as $item)
                                    <?php 
                                        $tgl = date('Y-m-d', strtotime('+3 days', strtotime($item->tanggal)));
                                    ?>
                                    @if ($item->id_user == Auth::user()->id)
                                        @if ($tgl <= $now && $item->status == null)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{date('d F Y', strtotime($item->tanggal))}}</td>
                                            <td>{{$item->alamat}}</td>
                                            <td>Rp. {{$item->total}}</td>
                                            <td>
                                                @if ($item->status == null)
                                                    <b style="color: red">Cencel</b>
                                                @else
                                                    <b style="color: green">{{$item->status}}</b>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{url('penjualan/show')}}/{{$item->id}}?id=belum" class="btn btn-primary btn-sm">Detail Pesanan</a>
                                            </td>
                                        </tr>  
                                       
                                        @elseif($tgl >= $now && $item->status == null)  
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{date('d F Y', strtotime($item->tanggal))}}</td>
                                            <td>{{$item->alamat}}</td>
                                            <td>Rp. {{$item->total}}</td>
                                            <td>
                                                @if ($item->status == null)
                                                    <b style="color: red">Belum bayar</b>
                                                @else
                                                    <b style="color: green">{{$item->status}}</b>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{url('penjualan/show')}}/{{$item->id}}?id=belum" class="btn btn-primary btn-sm">Detail Pesanan</a>
                                            </td>
                                        </tr>       
                                        @endif
                                  
                                    @endif
                                @endforeach
                            
                            
                                </tbody>
                            </table>
                        </div>

                        <div id="News" class="tabcontent">
                            <h3>Di Kemas</h3>
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Alamat</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;?>
                                    @foreach ($penjualan as $item)
                                        @if ($item->id_user == Auth::user()->id)
                                            @if($item->status == 'Sedang diproses')  
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{date('d F Y', strtotime($item->tanggal))}}</td>
                                                <td>{{$item->alamat}}</td>
                                                <td>Rp. {{$item->total}}</td>
                                                <td>
                                                    @if ($item->status == null)
                                                        <b style="color: red">Belum Bayar</b>
                                                    @else
                                                        <b style="color: green">{{$item->status}}</b>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{url('penjualan/show')}}/{{$item->id}}?id=belum_bayar" class="btn btn-primary btn-sm">Detail Pesanan</a>
                                                </td>
                                            </tr>       
                                            @endif
                                        @endif
                                    @endforeach
                            
                            
                                </tbody>
                            </table>
                        </div>

                        <div id="Contact" class="tabcontent">
                            <h3>Di Kirim</h3>
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Alamat</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;?>
                                    @foreach ($penjualan as $item)
                                        @if ($item->id_user == Auth::user()->id)
                                            @if($item->status == 'Mengirim Barang')  
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{date('d F Y', strtotime($item->tanggal))}}</td>
                                                <td>{{$item->alamat}}</td>
                                                <td>Rp. {{$item->total}}</td>
                                                <td>
                                                    @if ($item->status == null)
                                                        <b style="color: red">Belum Bayar</b>
                                                    @else
                                                        <b style="color: green">{{$item->status}}</b>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{url('penjualan/show')}}/{{$item->id}}?id=belum_bayar" class="btn btn-primary btn-sm">Detail Pesanan</a>
                                                </td>
                                            </tr>       
                                            @endif
                                        @endif
                                    @endforeach
                            
                            
                                </tbody>
                            </table>
                        </div>

                        <div id="About" class="tabcontent">
                            <h3>Selesai</h3>
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Alamat</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1;?>
                                    @foreach ($penjualan as $item)
                                        @if ($item->id_user == Auth::user()->id)
                                            @if($item->status == 'Selesai')  
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{date('d F Y', strtotime($item->tanggal))}}</td>
                                                <td>{{$item->alamat}}</td>
                                                <td>Rp. {{$item->total}}</td>
                                                <td>
                                                    @if ($item->status == null)
                                                        <b style="color: red">Belum Bayar</b>
                                                    @else
                                                        <b style="color: green">{{$item->status}}</b>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{url('penjualan/show')}}/{{$item->id}}?id=belum_bayar" class="btn btn-primary btn-sm">Detail Pesanan</a>
                                                </td>
                                            </tr>       
                                            @endif
                                        @endif
                                    @endforeach
                            
                            
                                </tbody>
                            </table>
                        </div>


                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openPage(pageName,elmnt,color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>