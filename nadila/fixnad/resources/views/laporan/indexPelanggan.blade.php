@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Data Pelanggan</div>

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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Tanggal Lahir</th>
                                <th>No. Hp</th>
{{--                                <th>Action</th>--}}
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;?>
                                @foreach ($pelanggan as $item)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item['alamat']}}</td>
                                        <td>{{$item['tgl_lahir']}}</td>
                                        <td>{{$item['no_hp']}}</td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
