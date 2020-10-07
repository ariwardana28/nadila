@extends('layouts.kasir')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">THH
                    <div style="float: right">
                        @foreach ($penjualan as $item)
                            <a href="{{route('kasir.print',$item->id)}}" target="_blank" class="btn btn-success btn-sm">Print</a>
                        @endforeach
                        <a href="{{route('kasir.penjualan')}}" class="btn btn-sm btn-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <?php $no=1;?>
                    <table class="table table-sm table-borderless">
                        @foreach ($penjualan as $item)
                            <tr>
                                <td style="width: 100px">Nama</td>
                                <td style="width: 50px">:</td>
                                <td>{{$item->User->name}}</td>
                            </tr>
                            <tr>
                                <td>No. Meja</td>
                                <td>:</td>
                                <td>{{$item->meja}}</td>
                            </tr>
                        @endforeach
                    </table>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <th>No</th>
                            <th>Nama Pesanan</th>
                            <th>Jumlah</th>
                            <th>Sub Total</th>
                        </thead>
                        <tbody>
                            <?php $no=1;?>
                            @foreach ($penjualan as $item)
                                @foreach ($detail as $items)
                                    @if ($items->id_penjualan == $item->id)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$items->Menu->nama}}</td>
                                            <td>{{$items->qty}}</td>
                                            <td>Rp.{{number_format($items->subtotal)}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <td colspan="3">
                                        <center>
                                            <b>Total</b>
                                        </center>
                                    </td>
                                    <td>
                                        <b>Rp.
                                            {{number_format($item->total)}}
                                        </b>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @foreach ($penjualan as $item)
                        <form action="{{route('kasir.bayar',$item->id)}}" method="POST">
                            @csrf
                            <input type="hidden" value="id" name="{{$item->id}}">
                            <input type="hidden" value="Bayar" name="status">
                            @if ($item->status == null)
                                <input type="submit" class="btn btn-sm btn-success" value="Bayar">
                            @endif
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
