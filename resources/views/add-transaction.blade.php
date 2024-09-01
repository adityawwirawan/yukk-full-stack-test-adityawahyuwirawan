<div class="row" style="padding-left: 20px">
    <h4 style="padding-left: 10px; padding-bottom: 20px;"><b>Add Transaction</b></h4>
</div>

<div class="card">
    <div class="card-body">
        <form  id="form" action="{{ route('transaksi.tambah.proses') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row" style="padding-bottom: 20px">
                <div class="col-12" style="padding-top: 20px">
                    <label>Tipe:</label>
                </div>
                <div class="col-12">
                    <select class="form-select" name="tipe" id="tipe" required>
                        <option value="" disabled selected> -- Pilih Tipe -- </option>
                        <option value="topup"> Top Up </option>
                        <option value="transaksi"> Transaksi </option>
                    </select>
                </div>
                <div class="col-12" style="padding-top: 20px">
                    <label>Amount:</label>
                </div>
                <div class="col-12">
                    <input type="text" class="form-control" name="amount" id="amount" style="text-align: right" onKeyUp="this.value=removeLeadingZerosRegex(this.value); this.value=dynamicSeparator(this.value)" required>
                </div>
                <br>
                <div class="col-12"  id="upload-bukti-section" style="display: none;">
                    <div class="col-12" style="padding-top: 20px">
                        <label>Upload:</label>
                    </div>
                    <div class="form-group">
                        <input type="file" id="upload_bukti" name="upload_bukti" class="form-control">
                    </div>
                </div>
                <br>
                <div class="col-12" style="padding-top: 20px">
                    <label>Keterangan:</label>
                </div>
                <div class="col-12">
                    <textarea type="text" class="form-control" name="keterangan" id="keterangan" maxlength="50" onkeyup="this.value = this.value.replace(/[^a-zA-Z0-9]/g, '')" required></textarea>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 text-center">
                    <button id="submit" class="btn btn-outline-dark">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function removeLeadingZerosRegex(str) {
        return str.replace(/^0+(?=\d)/, '');
    }

    function dynamicSeparator(number, prefix) {
        var number_string = number.replace(/[^.\d]/g, "").toString(),
            split = number_string.split("."),
            balance = split[0].length % 3,
            comma = split[0].substr(0, balance),
            thousand = split[0].substr(balance).match(/\d{3}/gi);

        //adding separator while thousand
        if (thousand) {
            separator = balance ? "," : "";
            comma += separator + thousand.join(",");
        }

        comma = split[1] != undefined ? comma + "," + split[1] : comma;
        return prefix == undefined ? comma : comma ? comma : "";
    }

    $('#tipe').on('change', function() {
            let tipe = $(this).val();

            if (tipe === 'topup') {
                $('#upload-bukti-section').show();
            }else{
                $('#upload-bukti-section').hide();
            }
        });
</script>
