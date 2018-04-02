@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/measurement_parts') }}">Measurement Part</a> :
@endsection
@section("contentheader_description", $measurement_part->$view_col)
@section("section", "Measurement Parts")
@section("section_url", url(config('laraadmin.adminRoute') . '/measurement_parts'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Measurement Parts Edit : ".$measurement_part->$view_col)

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
				{!! Form::model($measurement_part, ['route' => [config('laraadmin.adminRoute') . '.measurement_parts.update', $measurement_part->id ], 'method'=>'PUT', 'id' => 'measurement_part-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'category_id')
					@la_input($module, 'part')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/measurement_parts') }}">Cancel</a></button>
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
	$("#measurement_part-edit-form").validate({
		
	});
});
</script>
@endpush
