@extends('admin.layout.default')
@section('title')
    {{ $title }}
@endsection
@section('page-css')    
@endsection
@section('page-content')
<div class="row">
<div class="col-12">
<div class="card">
    <div class="card-header">
        <h5>{{ $title }}</h5>
    </div>
    <div class="card-content">
    <div class="card-body"> 
        <form class="form form-horizontal validate-form" method="post" action="{{ route('magazines.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <ul class="nav nav-tabs nav-top-border no-hover-bg" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="tab-general" data-toggle="tab" aria-controls="general" href="#tab-general-content" role="tab" aria-selected="true">General</a>
              </li>
            </ul>
            <div class="tab-content px-2 pt-4">
            <div class="tab-pane active" id="tab-general-content" role="tabpanel" aria-labelledby="tab-general">
            <div class="form-body">

              <div class="form-group row">
                  <label class="col-md-3 label-control" for="name">Name</label>
                  <div class="col-md-6">
                      <input type="text" id="name" name="name" class="form-control validate[required]" placeholder="Name" value="{{ old('name', '') }}" >
                  </div>
              </div>

              <div class="form-group row">
                    <label class="col-md-3 label-control" for="image">Image</label>
                    <div class="col-md-6">
                      <input class="form-control-file" type="file" id="image" name="image">
                    </div>
                    </div>
              </div>


              <div class="form-group row">
                  <label class="col-md-3 label-control" for="price">Price</label>
                  <div class="col-md-6">
                      <input type="text" id="price" name="price" class="form-control validate[required,custom[number]]" placeholder="Price" value="{{ old('price', '') }}" >
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-md-3 label-control" for="price">Frequency</label>
                  <div class="col-md-6">
                      <select id="frequency" name="frequency" class="form-control validate[required]" >
                          <option value="week">Weekly</option>
                          <option value="month">Monthly</option>
                          <option value="year">Yearly</option>
                      </select>  
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-md-3 label-control" for="status">Status</label>  
                  <div class="col-md-6">
                  <div class="d-inline-block custom-control custom-radio mr-1">
                    <input type="radio" class="custom-control-input bg-primary" name="status" id="status_active" value="ACTIVE" checked>
                    <label class="custom-control-label" for="status_active">Active</label>
                  </div>
                  <div class="d-inline-block custom-control custom-radio mr-1">
                    <input type="radio" class="custom-control-input bg-danger" name="status" id="status_disabled" value="DISABLED">
                    <label class="custom-control-label" for="status_disabled">Disabled</label>
                  </div>
                  </div>
              </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
            </div>
            </div>
            </div>
        </form>               
    </div>
    </div>
</div>
</div>                    
@endsection
@section('page-js')
@endsection