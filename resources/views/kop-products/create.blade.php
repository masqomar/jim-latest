@extends('adminlte::page')
@section('title', __('Kop Products'))
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
    </div>
  </div>
</div>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header bg-navy">
            <h3 class="card-title"><b style="font-size: 30px" class="mr-1">T</b>AMBAH </h3><br>
            <hr class="mt-3 mb-0" style="border: 1px solid #fff">
          </div>
            <div class="card-body">
                        <form action="{{ route('kop-products.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        
                        @include('kop-products.include.form')
                        
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>

                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </form>
                    </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 @endsection
