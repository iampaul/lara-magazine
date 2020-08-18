@extends('admin.layout.default')
@section('title')
{{ $title }}
@endsection
@section('page-css')    
@endsection
@section('header-right')
<div class="btn-group float-md-right" role="group">
    <a href="{{ route('magazines.create') }}" class="btn btn-primary"><i class="fa fa-plus mr-1"></i>Add New Magazine</a>
</div>
@endsection
@section('page-content')

<div class="card">
<div class="card-header">
<h4 class="card-title">Magazines</h4>
</div>
<div class="card-content">
<div class="card-body">
<div class="table-responsive">
<table id="new-cons" class="table table-striped table-bordered responsive dataTable" style="width:100%">
    <thead>
    <tr>
        <th data-priority="1">No</th>
        <th data-priority="1">Image</th>
        <th data-priority="2">Name</th>
        <th data-priority="2">Price</th>
        <th data-priority="2">Frequency</th>
        <th data-priority="4">Status</th>
        <th class="text-center" data-priority="3">Actions</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($magazines))
        @foreach($magazines as $key => $magazine)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><img src="{!! asset('uploads/images/magazines/'.$magazine->image) !!}" width="50" onerror="this.src='{!! asset('images/no_image/item-no-image.jpg') !!}'" /></td>
                <td>{{ $magazine->name }}</td>
                <td>{{ $magazine->price }}</td>
                <td>{{ $magazine->frequency }}</td>
                <td>{{ $magazine->status }}</td>
                <td class="action text-center">
                    <form action="{{ route('magazines.destroy',$magazine->magazine_id) }}" method="POST">
                    {{ csrf_field() }}
                    @method('DELETE')
                    <a href="{{ 
                    route('magazines.edit',$magazine->magazine_id) }}"
                       class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="ft-edit"></i> 
                    </a>

                    
                    <button type="submit" class="btn btn-sm btn-danger delete-confirm" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="ft-trash"></i> 
                    </button>
                    </form>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
</div>
</div>
</div>
</div>
      
@endsection
@section('page-js')
@endsection