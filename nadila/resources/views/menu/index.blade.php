@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Menu
                    <div style="float: right">
                        <a href="{{route('menu.create')}}" class="btn btn-sm btn-primary">+</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;?>
                            @forelse ($menu as $item)
                                @if ($item->deleted == null)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>
                                        <img src="{{asset('gambar_menu')}}/{{$item->gambar}}" height="100px" width="100px" alt="">
                                    </td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->harga}}</td>
                                    <td>
                                        <form action="{{ route('menu.hapus',$item->id) }}" method="POST">
                                            <a href="{{route('menu.edit',$item->id)}}" class="btn btn-sm btn-warning">Edit</a>
                                            @csrf
                                            {{-- @method('DELETE') --}}
                                            <input type="hidden" name="deleted" value="delete">
                                            <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-sm btn-danger">
                                               Hapus {{-- <img src="{{asset('h.png')}}" width="20px" height="20px"> --}}
                                            </button>
                                        </form>
                                        
                                    </td>
                                </tr>
                                @endif
                               
                            @empty
                                
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
