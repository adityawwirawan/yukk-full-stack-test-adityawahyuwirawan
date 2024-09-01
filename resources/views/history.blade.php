@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-left">

        {{-- <div class="col-6"></div> --}}
        <div class="col-6" style="text-align: right; padding-top:40px">
            <img src="{{ asset('images/wallet.png') }}" width="60px" height="60px">
        </div>
        <div class="col-6" align="left" style="padding-bottom: 20px; padding-top: 40px">
                <h4><b>Saldo</b></h4>
                <h4><b>IDR <font color="#c31f87"> {{ number_format($saldo) }}</font></b></h4>
        </div>
        <div class="col-12">
            <h3 style="padding-bottom: 20px; padding-top: 40px"> <b>Riwayat Saldo</b> </h3>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row g-3 align-items-center" style="padding-bottom: 40px">
                    <form class="form-inline" action="" method="GET">
                        @csrf
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <input class="form-control" name="search" id="search" type="search" placeholder="Masukkan Kode Transaksi/Keterangan" size="20">
                            </div>
                            <div class="col-auto">
                                <select class="form-select" name="tipe" id="tipe">
                                    <option value="" disabled selected> Tipe Transaksi </option>
                                    <option value="topup"> Top Up </option>
                                    <option value="transaksi"> Transaksi </option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <label><b>Start</b></label>
                            </div>
                            <div class="col-auto">
                                    <input type="date" class="form-control" name="datefrom" id="datefrom">
                            </div>
                            <div class="col-auto">
                                <label><b>End</b></label>
                            </div>
                            <div class="col-auto">
                                    <input type="date" class="form-control" name="dateto" id="dateto">
                            </div>
                            <div class="col-auto" style="padding-top: 7px;">
                                <button type="submit" class="btn btn-outline-dark mb-2">Search</button>
                            </div>
                            <div class="col-auto" style="padding-top: 7px;">
                                <a href="{{ route('riwayat.export', $value_from_filter) }}" class="btn btn-dark mb-2"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</a>
                            </div>
                        </div>
                    </form>
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors as $error)
                                {{ $error }}
                            @endforeach
                        </ul>
                    </div>
                @endif

                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Kode Transaksi</th>
                            <th class="text-center">Tanggal Transaksi</th>
                            <th class="text-center">Tipe</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td align="center">{{ $data->transaction_code }}</td>
                                <td align="center">{{ $data->created_at }}</td>
                                <td align="center">{{ $data->type }}</td>
                                <td align="left">{{ $data->remark }}</td>
                                <td align="right">{{ number_format($data->amount) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="float: right">
                    {{ $datas->links() }}
                    <span style="text-align:right">
                        <p>
                            Showing {{ $datas->count() }} of {{ $datas->total() }} Data(s).
                        </p>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal -->
<div class="modal fade" id="transaksiModal" tabindex="-1" role="dialog" aria-labelledby="transaksiModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="alert alert-danger" style="display:none"></div>
            <div class="modal-header">
                <button type="button" class="btn-close pull-right" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="transaksiBody">
                <div>
                    <!-- the result to be displayed apply here -->
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // display a modal
    $(document).on('click', '#transaksiButton', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        console.log(href);
        $.ajax({
            url: href,
            beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                $('#transaksiModal').modal("show");
                $('#transaksiBody').html(result).show();
            },
            complete: function() {
                $('#loader').hide();
            },
            error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            },
            timeout: 8000
        })
    });

</script>
@endsection
