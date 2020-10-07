@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Pesanan</div>
                <div class="card-body">
                    <form action="{{route('penjualan.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <table class="table table-borderless table-responsive table-sm" >
                            <thead>
                               <tr>
                                   <th style="font-size: 11px">Nama : </th>
                                   <th style="font-size: 11px">Meja : </th>
                               </tr>
                            </thead>
                             <tbody>
                                 <tr>
                                   <td>
                                        <input type="text" value="{{ Auth::user()->name }}" style="font-size: 11px" class="form-control" readonly>
                                        <input type="hidden" value="{{ Auth::user()->id }}" style="font-size: 11px"class="form-control" name="id_user">
                                        <input type="text" value="{{$now}}" style="font-size: 11px"class="form-control" name="tanggal">
                                    </td>
                                   <td>
                                       <input type="number" name="meja" style="font-size: 11px" class="form-control">
                                   </td>
                                 </tr>
                             </tbody>
                        </table>
    
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="font-size: 11px">Barang : </th>
                                    <th style="font-size: 11px">Harga : </th>
                                    <th style="font-size: 11px">Jumlah : </th>
                                    <td>
                                        {{-- <a href="#" class="btn btn-primary addRow">+</a> --}}
                                    </td>
                                </tr>
                            </thead>
                            <tbody class="as">
                                <tr>
                                    <td style="width: 150px">
                                        
                                        <select name="_id_barang[]" style="font-size: 11px"class="form-control id_barang" id="id_barang" onchange="ubahData()">
                                        {{-- <option value="">Pilih Barang</option> --}}
                                        <option value="">Pilih Barang</option>
                                        @foreach ($menu as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="hidden" style="font-size: 11px" name="_nama" class="form-control nama" id="nama" >
                                        <input type="text" style="font-size: 11px" readonly name="_harga_jual" class="form-control harga_beli" id="harga_beli" >
                                    </td>
                                    <td>
                                        <input type="number" min="0"  name="" autocomplete="off" class="form-control " id="qty">
                                        <input type="hidden" class="form-control " id="subtotal">

                                    </td>
                                    <td>
                                        {{-- <a href="#" class="btn btn-danger removes">-</a> --}}
                                        <button class="btn btn-info btn-sm" id="btn-tambah">+</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- <div id="daftar-penjualan">

                        </div> --}}
                        <br>
                        <center>
                            
                        </center>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td style="font-size: 11px">Nama</td>
                                    <td style="font-size: 11px">Harga</td>
                                    <td style="font-size: 11px">Qty</td>
                                    <td style="font-size: 11px">Subtotal</td>
                                    <td style="font-size: 11px">Action</td>
                                </tr>
                            </thead>
                            <tbody  id="daftar-penjualan" class="as">

                            </tbody>
                            <tr>
                                <td colspan="2"></td>
                                <td style="font-size: 11px">Total</td>
                                <td colspan="2">
                                    <input type="number" min="0" style="font-size: 11px" readonly name="total" class="form-control total" id="total">
                                </td>
                                
                            </tr>
                        
                        </table>
                        <br>
                   
                        <br>
                        <input type="submit" value="Pesan" class="btn btn-success">
                    </form>
                
                                 
                </div>
            </div>
        </div>

        <div class="col-md-7" data-spy="scroll" data-target=".navbar" data-offset="50" >
            <div class="card "  >
                <div class="card-header">Produk</div>
                        <div class="card-body" style="overflow: auto;max-height: 450px;">
                            @foreach ($menu as $item)
                                <div class="card" style="float: left; margin-right:10px;margin-bottom:20px;width:180px" >
                                    <div class="card-body">
                                        <center>
                                            <img  src="{{asset('gambar_menu')}}/{{$item->gambar}}" height="80px" width="100px">
                                        </center>
                                    </div>
                                    <style>
                                        td{
                                            font-size: 11px;
                                        }
                                    </style>
                                    <div class="card-body" style="width: 200px ;">
                                        <form action="" method="POST">
                                            <table class="table table-sm table-borderless table-responsive">
                                                <tr>
                                                    <td style="font-size: 11px;">Nama</td>
                                                    <td style="font-size: 11px;">:</td>
                                                    <td style="font-size: 11px;">
                                                        {{$item->nama}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 11px;">Harga</td>
                                                    <td style="font-size: 11px;">:</td>
                                                    <td style="font-size: 11px;">
                                                        Rp. {{number_format($item->harga)}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 11px;">Ket</td>
                                                    <td style="font-size: 11px;">:</td>
                                                    <td style="font-size: 11px;"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" >
                                                        <textarea  style="font-size: 11px;" cols="15" rows="5" class="form-control" readonly>
                                                            {{$item->ket}}
                                                        </textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

  
    $(document).ready(function() {
        var i=1
        
        $('#btn-tambah').on('click',function(e){
            $('#subtotal').val(parseInt($('#harga_beli').val())*parseInt($('#qty').val()));
            $('#qty').val(parseInt($('#qty').val()));
          

            // $("#daftar-penjualan").append('<div class="row">'+
            //     '<div class="col-md-1">'+i+'.'+'</div>'+
            //     '<input type="hidden" readonly class="form-control" name="id_barang[]" value="'+$('#id_barang').val()+'"><'+
            //     '<div class="col-md-3"><input type="text" readonly class="form-control" name="nama_barang[]" value="'+$('#id_barang option:selected').text()+'"></div>'+
            //     '<div class="col-md-2 "><input type="text" readonly class="text-right form-control" name="harga[]" value="'+$('#harga_beli').val()+'"></div>'+
            //     '<div class="col-md-2 "><input type="text" readonly class="text-right form-control "  name="qty[]" value="'+$('#qty').val()+'"></div>'+
            //     '<div class="col-md-2 "><input type="text" readonly class="text-right form-control " name="subtotal[]" value="'+$('#subtotal').val()+'"></div>'+
            // '</div>');
            $("#daftar-penjualan").append('<tr>'+
                '<td><input type="hidden" readonly class="form-control" name="id_menu[]" value="'+$('#id_barang').val()+'">'+
                '<input type="text" style="font-size: 11px" readonly class="form-control" name="" value="'+$('#id_barang option:selected').text()+'"><input type="hidden" style="font-size: 11px" readonly class="form-control" name="date[]" value="<?php echo $now;?>"><input type="hidden" style="font-size: 11px" readonly class="form-control" name="bay[]" value="belum bayar"> </td>'+
                '<td><input type="text" style="font-size: 11px" readonly class=" form-control" name="harga[]" value="'+$('#harga_beli').val()+'"></td>'+
                '<td> <input type="number" style="font-size: 11px" readonly min="0"  name="qty[]" class="form-control qty" id="qty" value="'+$('#qty').val()+'"></td>'+
                '<td><input type="text" style="font-size: 11px" readonly class=" form-control subtotal jumlahs" id="jumlahs" name="subtotal[]" value="'+$('#subtotal').val()+'"></td>'+
                '<td><a href="#" class="btn btn-sm btn-danger removes">-</a></td>'+
             
            '</tr>');
            i++;
            $('#id_barang').val('');
            $('#nama').val('');
            $('#harga_beli').val('');
            $('#qty').val('');
            $('#subtotal').val('');
            $('.select-barang').val(null).trigger('change');

            var total = 0;
            $(".subtotal").each(function() {
                total += parseInt($(this).val());
            });
            $('#total').val(total);

            var jumlah = 0;
            $(".qty").each(function() {
                jumlah += parseInt($(this).val());
            });
            $('#jumlah').val(jumlah);

            e.preventDefault();
        })
    });
    $('#daftar-penjualan').on('click','.removes',function(){
        var last = $('#daftar-penjualan tr').length;
        $(this).parent().parent().remove();
    });

  
</script>
<script>
    function ubahData() { 
      var id_barang = document.getElementById('id_barang').value;
      var hasil = search(id_barang);
    }
    function search(id_barang) {
        <?php foreach($menu as $nom){ ?>
            if(id_barang == <?php echo $nom->id;  ?>) {  
                document.getElementById('nama').value='<?php echo $nom->nama ?>';
                document.getElementById('harga_beli').value='<?php echo $nom->harga ?>';
            }
        <?php } ?>  
    }
</script>
<script>
        $(document).ready(function(){
            
            // Initialize select2
            $("#id_barang").select2();

            // Read selected option
            $('#but_read').click(function(){
                var username = $('#selUser option:selected').text();
                var userid = $('#selUser').val();
           
                $('#result').html("id : " + userid + ", name : " + username);
            });
        });
</script>
@endsection
