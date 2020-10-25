@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pencarian</div>
                <div class="card-body">
                    <form role="form" method="get" action="{{url('/laporan')}}">
                        <table>
                            <tr>
                                <td>
                                    <label for="exampleInputEmail1">Dari Tanggal</label>
                                </td>
                                <td>
                                    <label for="exampleInputPassword1">Sampai Tanggal</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date"  name="tanggal1"  class="form-control datepicker" id="exampleInputEmail1" placeholder="Dari Tanggal">
                                </td>
                                <td>
                                    <input type="date"  name="tanggal2" class="form-control datepicker" id="exampleInputPassword1" placeholder="Sampai Tanggal">
                                </td>
                                <td>
                                    <p style="color: white">...</p>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Daftar Transaksi</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Customer</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;?>
                                @foreach ($detail as $item)
                                    @if ($item->status == 'Selesai')
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{date('d F Y', strtotime($item->tanggal))}}</td>
                                        <td>{{$item->User->name}}</td>
                                        <td>Rp. {{$item->total}}</td>

                                        <td>
                                            <a href="{{route('kasir.show',$item->id)}}" class="btn btn-primary btn-sm">Detail</a>
                                        </td>
                                    </tr>
                                    @elseif($item->status == null)

                                    @endif
                                @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
