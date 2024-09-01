@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-left">
        <div class="col-12">
            <h3 style="padding-bottom: 20px; padding-top: 40px"> <b>Transaksi</b> </h3>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row g-3 align-items-center" style="padding-bottom: 40px">
                    <form class="form-inline" action="" method="GET">
                        @csrf
                        <div class="col-auto" style="text-align: right">
                            <a data-toggle="modal" id="transaksiButton" data-target="#transaksiModal"
                            data-attr="{{ route('transaksi.tambah') }}">
                                <button class="btn btn-dark">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    Add Transaction
                                </button>
                            </a>
                            </button>
                        </div>
                    </form>
                </div>
                @if (Session::has('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="btn-close pull-right" data-dismiss="alert"></button>
                        <strong>{{ Session::get('success') }}</strong>
                    </div>
                @endif

                @if (Session::has('failed'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="btn-close pull-right" data-dismiss="alert"></button>
                        <strong>{{ Session::get('failed') }}</strong>
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
