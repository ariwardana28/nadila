@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Petik Merah
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
                                <td style="width: 100px">No. Meja</td>
                                <td>:</td>
                                <td>{{$item->meja}}</td>
                            </tr>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
