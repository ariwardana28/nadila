@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach ($menu as $item)
                        <form action="{{route('menu.update',$item->id)}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
        
                            <div class="form-group">
                                <b>Gambar</b><br/>
                                <input type="file" name="gambar" class="form-control" id="btn-tambah">
                                <br>
                                <img src="{{asset('gambar_menu')}}/{{$item->gambar}}" height="100px" width="100px" alt="">
                                <input type="hidden" value="{{$item->gambar}}">
                            </div>
        
                            <div class="form-group">
                                <b>Nama</b>
                                <input type="text" name="nama" value="{{$item->nama}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <b>Harga</b>
                                <input type="text" name="harga" value="{{$item->harga}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <b>Stok</b>
                                <input type="number" name="stok" class="form-control" value="{{$item->stok}}">
                            </div>
                            <div class="form-group">
                                <b>Keterangan</b>
                                {{-- <input type="text" name="harga" class="form-control"> --}}
                                <textarea name="ket" id="" cols="30" rows="10" class="form-control">
                                    {{$item->ket}}
                                </textarea>
                            </div>
                            <input type="submit" value="Upload" class="btn btn-primary">
                        </form>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
