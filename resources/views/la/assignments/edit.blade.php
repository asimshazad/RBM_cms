@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/assignments') }}">Assignment</a> :
@endsection
@section("contentheader_description", $assignment->$view_col)
@section("section", "Assignments")
@section("section_url", url(config('laraadmin.adminRoute') . '/assignments'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Assignments Edit : ".$assignment->$view_col)

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
				{!! Form::model($assignment, ['route' => [config('laraadmin.adminRoute') . '.assignments.update', $assignment->id ], 'method'=>'PUT', 'id' => 'assignment-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'category_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/assignments') }}">Cancel</a></button>
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
	$("#assignment-edit-form").validate({
		
	});
});
</script>
@endpush
