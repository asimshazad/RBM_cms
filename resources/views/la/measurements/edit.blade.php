@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/measurements') }}">Measurement</a> :
@endsection
@section("contentheader_description", $measurement->$view_col)
@section("section", "Measurements")
@section("section_url", url(config('laraadmin.adminRoute') . '/measurements'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Measurements Edit : ".$measurement->$view_col)

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
				{!! Form::model($measurement, ['route' => [config('laraadmin.adminRoute') . '.measurements.update', $measurement->id ], 'method'=>'PUT', 'id' => 'measurement-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'customer_id')
					@la_input($module, 'category_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/measurements') }}">Cancel</a></button>
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
	$("#measurement-edit-form").validate({
		
	});
});
</script>
@endpush
