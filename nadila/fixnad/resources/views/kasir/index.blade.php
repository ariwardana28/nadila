@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">PHH</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <?php $no=1;?>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                       <tbody>
                           @foreach ($penjualan as $item)
                                   <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$item->User->name}}</td>
                                        <td>
                                            <b style="color: green">{{$item->status}}</b>
                                        </td>
                                        <td>
                                            <a href="{{route('kasir.show',$item->id)}}" class="btn btn-primary btn-sm">Detail</a>
                                        </td>
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