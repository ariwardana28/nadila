<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Alamat</th>
            <th>Total</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1;?>
        @foreach ($penjualan as $item)
            <?php 
                $tgl = date('Y-m-d', strtotime('+3 days', strtotime($item->tanggal)));
            ?>
            @if ($item->id_user == Auth::user()->id)
                @if ($tgl >= $now && $item->status == null)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{date('d F Y', strtotime($item->tanggal))}}</td>
                    <td>{{$item->alamat}}</td>
                    <td>Rp. {{$item->total}}</td>
                    <td>
                        @if ($item->status == null)
                            <b style="color: red">Belum Bayar</b>
                        @else
                            <b style="color: green">{{$item->status}}</b>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('penjualan.show',$item->id)}}" class="btn btn-primary btn-sm">Detail Pesanan</a>
                    </td>
                </tr>  
               
                @elseif($tgl <= $now && $item->status != null)  
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{date('d F Y', strtotime($item->tanggal))}}</td>
                    <td>{{$item->alamat}}</td>
                    <td>Rp. {{$item->total}}</td>
                    <td>
                        @if ($item->status == null)
                            <b style="color: red">Belum Bayar</b>
                        @else
                            <b style="color: green">{{$item->status}}</b>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('penjualan.show',$item->id)}}" class="btn btn-primary btn-sm">Detail Pesanan</a>
                    </td>
                </tr>       
                @endif
          
            @endif
        @endforeach


    </tbody>
</table>