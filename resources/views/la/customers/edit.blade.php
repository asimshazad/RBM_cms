@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/customers') }}">Customer</a> :
@endsection
@section("contentheader_description", $customer->$view_col)
@section("section", "Customers")
@section("section_url", url(config('laraadmin.adminRoute') . '/customers'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Customers Edit : ".$customer->$view_col)

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($customer, ['route' => [config('laraadmin.adminRoute') . '.customers.update', $customer->id ], 'method'=>'PUT', 'id' => 'customer-edit-form']) !!}
				<?php //echo '<pre>';print_r($module);?>
				@la_form($module)
					
					{{--
					@la_input($module, 'name')
					@la_input($module, 'email')
					@la_input($module, 'phone')
					@la_input($module, 'city')
					@la_input($module, 'department')
					@la_input($module, 'image')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/customers') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#customer-edit-form").validate({
		
	});
});
</script>
@endpush
