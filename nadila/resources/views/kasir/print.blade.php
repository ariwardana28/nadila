<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <center>THH</center>
                    </div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <?php $no=1;?>
                        <table class="table table-sm table-borderless">
                            @foreach ($penjualan as $item)
                                <tr>
                                    <td style="width: 100px">Nama</td>
                                    <td style="width: 50px">:</td>
                                    <td>{{$item->User->name}}</td>
                                </tr>
                                <tr>
                                    <td>No. Meja</td>
                                    <td>:</td>
                                    <td>{{$item->meja}}</td>
                                </tr>
                            @endforeach
                        </table>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <th>No</th>
                                <th>Nama Pesanan</th>
                                <th>Qty</th>
                                <th>Sub Total</th>
                            </thead>
                            <tbody>
                                <?php $no=1;?>
                                @foreach ($penjualan as $item)
                                    @foreach ($detail as $items)
                                        @if ($items->id_penjualan == $item->id)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$items->Menu->nama}}</td>
                                                <td>{{$items->qty}}</td>
                                                <td>{{$items->subtotal}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        @foreach ($penjualan as $item)
                            <form action="{{route('kasir.bayar',$item->id)}}" method="POST">
                                @csrf
                                <input type="hidden" value="Bayar" name="status">
                                <input type="hidden" class="btn btn-sm btn-success" value="Bayar">
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>
