@extends('admin.layout.default')

@section('title')
   Dashboard
@endsection

@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/plugins/formValidator/css/validationEngine.jquery.css') }}">
@endsection

@section('page-content')

<div class="row">
    <div class="col-xl-6 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-primary bg-darken-2">
                        <i class="icon-camera font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-primary  media-body">
                        <h5>Magazines</h5>
                        <h5 class="text-bold-400 mb-0"><i class="ft-plus"></i>{{ $magazine_count ?? '0' }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="media align-items-stretch">
                    <div class="p-2 text-center bg-danger bg-darken-2">
                        <i class="icon-user font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-gradient-x-danger  media-body">
                        <h5>Users</h5>
                        <h5 class="text-bold-400 mb-0"><i class="ft-arrow-up"></i>{{ $user_count ?? '0' }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Stats -->

      
@endsection

@section('page-js')

@endsection