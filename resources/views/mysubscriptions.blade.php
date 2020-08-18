@extends('layouts.app')
@section('page-css')
<!-- Data Table -->
<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">      
<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css') }}">
@endsection
@section('content')
<div class="container">
<section class="magazine_blk" data-animation="bounceIn" data-animation-delay="500">
<div class="magazine_page">
<div class="container">
<div class="heading heading-center">
<h2>My Subscriptions</h2>
</div>

@if(count($subscriptions) > 0)
<table id="new-cons" class="table table-striped table-bordered responsive dataTable" style="width:100%">
    <thead>
    <tr>
        <th data-priority="1">No</th>
        <th data-priority="1">Created At</th>
        <th data-priority="2">Product Stripe ID</th>
        <th data-priority="2">Price</th>
        <th data-priority="2">Frequency</th>
        <th data-priority="4">Status</th>        
    </tr>
    </thead>
    <tbody>    
        @foreach($subscriptions as $key => $subscription)
            <tr>
                <td>{{ $loop->iteration }}</td>                
                <td>{{ date('j F, Y', $subscription->created) }}</td>
                <td>{{ $subscription->plan->product }}</td>
                <td>${{ $subscription->plan->amount/100 }}</td>
                <td>{{ ucfirst($subscription->plan->interval) }}</td>
                <td>{{ ucfirst($subscription->status)  }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
<p class="no-items">No Subscriptions Added</p>
@endif

</div>
</div>
</section>
</div>

@endsection

@section('page-js')
<!-- Data Table -->
<script src="{{ asset('admin-assets/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('admin-assets/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript">
 //Datatable
 $('.dataTable').DataTable({
   responsive: true     
 });
</script>  
@endsection