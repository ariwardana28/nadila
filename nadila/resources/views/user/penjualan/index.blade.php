@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Petik Merah</div>

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
                                <th>No. Meja</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;?>
                            @foreach ($penjualan as $item)
                                @if (Auth::user()->id == $item->id_user)
                                <?php $count = $item->count('tanggal');
                                ?>
                                @foreach ($DetailPenjualan as $items)
                                    @if ($item->tanggal == $items->tanggal)
                                    <?php
                                    
                                    for ($i=0; $i < $count ; $i++) { ?>
                                        
                                   <?php }
                                    ?>
                                  <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{date('d F Y', strtotime($items->tanggal))}}</td>
                                    <td>{{$item->meja}}</td>
                                    <td>Rp. {{$item->total}}</td>
                                    <td>
                                        @if ($item->status != null)
                                            <b style="color: green">Sudah Bayar</b>
                                        @else
                                            <b style="color: red">Belum Bayar</b>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('penjualan.show',$item->id)}}" class="btn btn-primary btn-sm">Detail Pesanan</a>
                                    </td>
                                </tr>
                            <?php break;?>
                                    @endif
                                    
                                @endforeach
                                @endif
                            @endforeach
                            <?php
                                for ($i=0; $i < 3; $i++) { 
                                   echo $item->tanggal."::::";
                                }
                            ?>
                         
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
