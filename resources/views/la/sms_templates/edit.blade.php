@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/sms_templates') }}">SMS Template</a> :
@endsection
@section("contentheader_description", $sms_template->$view_col)
@section("section", "SMS Templates")
@section("section_url", url(config('laraadmin.adminRoute') . '/sms_templates'))
@section("sub_section", "Edit")

@section("htmlheader_title", "SMS Templates Edit : ".$sms_template->$view_col)

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
				{!! Form::model($sms_template, ['route' => [config('laraadmin.adminRoute') . '.sms_templates.update', $sms_template->id ], 'method'=>'PUT', 'id' => 'sms_template-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'name')
					@la_input($module, 'description')
					@la_input($module, 'mask')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/sms_templates') }}">Cancel</a></button>
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
	$("#sms_template-edit-form").validate({
		
	});
});
</script>
@endpush
