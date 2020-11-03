<table id="table-id" class="table table-sm table-bordered">
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
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#table-id').DataTable();
        });
    </script>
@endsection
