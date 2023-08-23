@extends('adminlte::page')

@section('title', __('Topup JIMPay'))

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-navy">
                        <h3 class="card-title"><b style="font-size: 30px" class="mr-1">T</b>OPUP VOUCHER BULANAN </h3><br>
                        <hr class="mt-3 mb-0" style="border: 1px solid #fff">
                    </div>
                    <form action="{{ route('jimpay-vouchers.store') }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="card-body">

                            <div class="form-group">
                                <label>Anggota</label>
                                <select class="chosen-select form-control @error('user_id') is-invalid @enderror" name="user_id[]" id="user-id" data-placeholder="Maksimal 10 orang ya...untuk 1x input" multiple required>
                                    @foreach ($users as $user)
                                    <option value="{!! $user['id'] !!}">
                                        {{ $user->member_id }} || {{ $user->first_name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="amount">{{ __('Nominal') }}</label>
                                <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" value="10000" readonly required />
                                @error('amount')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@section('css')
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<script>
    $(".chosen-select").chosen({
        no_results_text: "Oops, anggota tidak ditemukan!"
    })
</script>
@endsection