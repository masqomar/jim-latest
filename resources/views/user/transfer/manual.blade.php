<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Transfer Manual - JIMPay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <style>
        body {
            font-family: "Ovo", serif;
            font-size: 14px;
            color: #171717;
            background: #e8eaec;
        }
    </style>
</head>

<body>

    <div class="container">
        <br>
        <div class="card">
            <div class="card-body">
                <h6>Silahkan isi sesuai kebutuhan!</h6>
                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <form action="{{ route('user.transfer.simpanManualTransfer') }}" method="POST">
                    @csrf

                    <div class="input-group mb-3">
                        <input class="typeahead form-control" id="search" type="text" name="nama_penerima" placeholder="Cari Anggota..." required>
                    </div>
                    <div class="input-group mb-3">
                        <input class="typeahead form-control" id="member_id" type="text" name="member_id" placeholder="No Anggota" readonly>
                    </div>
                    <input id="anggotaID" type="hidden" name="anggota_id">
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="nominal_transfer" min="1000" placeholder="Masukan Nominal Transfer" required>
                    </div>
            </div>
        </div>
        <br>
        <div class="text-center">
            <button class="btn btn-sm btn-primary" type="submit">Transfer Sekarang
            </button>
            <a class="btn btn-sm btn-warning" href="{{url('/home')}}" role="button">Batal</a>
        </div>
    </div>

    <script type="text/javascript">
        var path = "{{ route('user.transfer.fetch') }}";

        $("#search").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: path,
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $('#search').val(ui.item.label);
                $('#anggotaID').val(ui.item.id);
                $('#member_id').val(ui.item.member_id);
                console.log(ui.item);
                return false;
            }
        });
    </script>
</body>

</html>