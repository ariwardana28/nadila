@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    PHH
                    <div style="float: right">
                        @foreach ($penjualan as $item)
                            @if ($item->status == "Mengirim Barang")
                                <form action="{{route('kasir.kirim',$item->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="status" id="" value="Selesai" class="form-control" >
                                    <input type="submit" value="Selesai" class="btn btn-sm btn-success">
                                    <a href="{{url('/penjualan')}}" class="btn btn-sm btn-primary">Kembali</a>
                                </form>
                            @elseif($item->status == "Sedang diproses")
                                <form action="{{route('kasir.kirim',$item->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="status" id="" value="Mengirim Barang" class="form-control" >
                                    <input type="submit" value="Kirim Barang" class="btn btn-sm btn-success">
                                    <a href="{{url('/penjualan')}}" class="btn btn-sm btn-primary">Kembali</a>
                                </form>
                            @else
                            @endif

                          
                    @endforeach
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
                            @if ($item->status !=null && $item->foto !=null)
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
                        @foreach ($penjualan as $items)
                            {{-- @if ($items->id_user == Auth::user()->id) --}}
                                @foreach ($DetailPenjualan as $item)
                                    @if ($items->id == $item->id_penjualan)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$item->Menu->nama}}</td>
                                            <td>{{$item->qty}}</td>
                                            <td>Rp.{{number_format($item->subtotal)}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            {{-- @endif --}}
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
                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
