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
                    <br>


                    {{--Search By Nama--}}
                    <form role="form" method="get" action="{{url('/laporan')}}">
                        <table>
                            <tr>
                                <td>
                                    <label for="exampleInputEmail1">Cari by Nama</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text"  name="nama"  class="form-control datepicker" id="exampleInputEmail1" placeholder="Nama">
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
@if(!empty($detail))
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
                        @include('laporan.table_laporan')
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection



