<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>The Aditii Website Template | Details :: w3layouts</title>
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
<body>
<!-- start header -->
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
		<div class="h_search">
    		<form>
    			<input type="text" value="">
    			<input type="submit" value="">
    		</form>
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
			</ul>
		</div>
		<div class="top-nav">
	          <nav class="nav">	        	
	    	    <a href="#" id="w3-menu-trigger"> </a>
	                  <ul class="nav-list" style="">
	            	        <li class="nav-item"><a class="active" href="index.html">Home</a></li>
							<li class="nav-item"><a href="sale.html">Sale</a></li>
	                 </ul>
	           </nav>
	             <div class="search_box">
				<form>
				   <input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}"><input type="submit" value="">
			    </form>
			</div>
	          <div class="clear"> </div>
	          <script src="js/responsive.menu.js"></script>
         </div>	
	<div class="clear"></div>
</div>
</div>
</div>
<!-- start main -->
<div class="main_bg">
<div class="wrap">	
	<div class="main">
	<!-- start content -->
	<div class="single">
			<!-- start span1_of_1 -->
			<div class="left_content">
			<div class="span1_of_1">
                <!-- start product_slider -->
                @foreach ($detail as $item)
                <div class="product-view">
				    <div class="product-essential">
				        <div class="product-img-box">
                            <div class="more-views" style="float:left;">
                                <div class="more-views-container">
                                {{-- <ul>
                                    <li>
                                        <a class="cs-fancybox-thumbs" data-fancybox-group="thumb" style="width:64px;height:85px;" href=""  title="" alt="">
                                        <img src="" src_main=""  title="" alt="" /></a>            
                                    </li>
                                    <li>
                                        <a class="cs-fancybox-thumbs" data-fancybox-group="thumb" style="width:64px;height:85px;" href=""  title="" alt="">
                                        <img src="" src_main=""  title="" alt="" /></a>
                                    </li>
                                    <li>
                                        <a class="cs-fancybox-thumbs" data-fancybox-group="thumb" style="width:64px;height:85px;" href=""  title="" alt="">
                                        <img src="" src_main=""  title="" alt="" /></a> 
                                    </li>
                                    <li>
                                        <a class="cs-fancybox-thumbs" data-fancybox-group="thumb" style="width:64px;height:85px;" href=""  title="" alt="">
                                        <img src="" src_main="" title="" alt="" /></a>  
                                    </li>
                                    <li>
                                        <a class="cs-fancybox-thumbs" data-fancybox-group="thumb" style="width:64px;height:85px;" href=""  title="" alt="">
                                        <img src="" src_main="" title="" alt="" /></a>
                                    </li>
                                </ul> --}}
                                </div>
                            </div>
                    <img src="" alt="">
				    <div class="product-image"> 
				        <a class="cs-fancybox-thumbs cloud-zoom" rel="adjustX:30,adjustY:0,position:'right',tint:'#202020',tintOpacity:0.5,smoothMove:2,showTitle:true,titleOpacity:0.5" data-fancybox-group="thumb" href="{{asset('gambar_menu')}}/{{$item->gambar}}" title="Women Shorts" alt="Women Shorts">
				           	<img src="{{asset('gambar_menu')}}/{{$item->gambar}}" alt="Women Shorts" title="Women Shorts" />
				        </a>
				   </div>
				</div>
                @endforeach
				
				</div>
				</div>
				<!-- end product_slider -->
			</div>
            <!-- start span1_of_1 -->
            @foreach ($detail as $item)
            <div class="span1_of_1_des">
                <div class="desc1">
                  <h3>{{$item->nama}} </h3>
                  <form action="{{route('penjualan.storeBayar')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id_produk" value="{{$item->id}}" id="">
                    <input type="hidden" name="id_user" value="{{ Auth::user()->id }} " id="">
                    <input type="number" name="qty" min="0" max="{{$item->stok}}" class="form-control"> Terseisa {{$item->stok}} Buah
                    <br>
                    <br>
                    <input type="submit" class="btn btn-primary" value="Masukkan Keranjang">
                  </form>
                  <h5>Rp.{{number_format($item->harga)}} </h5>
                
                  <section class="tabs" style="width: 400px">
                    <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked">
                    <label for="tab-1" class="tab-label-1">overview</label>
                    <div class="clear-shadow"></div>        
                    <div class="content">
                        <div class="content-1">
                            <p class="para top"><span>Keterangan</span>
                              {{$item->ket}}
                            </p>
                            <div class="clear"></div>
                        </div>
                    </div>
                    </section>
                     <!-- end tabs -->
                   </div>
                   <!-- start sidebar -->
            
                    <!-- end sidebar -->
                  <div class="clear"></div>
                  </div>	
              @endforeach
          </section>
                  </div>
                 </div>
                 <div class="clear"></div>
                 <!-- start tabs -->
        
			
	<!-- end content -->
	</div>
</div>
</div>		
<!-- start footer -->
<div class="footer_bg">

</div>	
<!-- start footer -->
<div class="footer_bg1">
<div class="wrap">
	<div class="footer">
		<!-- scroll_top_btn -->
	    <script type="text/javascript">
			$(document).ready(function() {
			
				var defaults = {
		  			containerID: 'toTop', // fading element id
					containerHoverID: 'toTopHover', // fading element hover id
					scrollSpeed: 1200,
					easingType: 'linear' 
		 		};
				
				
				$().UItoTop({ easingType: 'easeOutQuart' });
				
			});
		</script>
		 <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
		<!--end scroll_top_btn -->
		<div class="copy">
			<p class="link">&copy;  All rights reserved | Template by&nbsp;&nbsp;<a href="http://w3layouts.com/"> W3Layouts</a></p>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>
</body>
</html>