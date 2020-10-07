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

                    <form action="{{route('menu.store')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
     
                        <div class="form-group">
                            <b>Gambar</b><br/>
                            <input type="file" name="gambar" class="form-control" id="btn-tambah">
                        </div>
     
                        <div class="form-group">
                            <b>Nama</b>
                            <input type="text" name="nama" class="form-control">
                        </div>

                        <div class="form-group">
                            <b>Harga</b>
                            <input type="text" name="harga" class="form-control">
                        </div>
                        <input type="submit" value="Upload" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
