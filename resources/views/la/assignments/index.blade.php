@extends("la.layouts.app")

@section("contentheader_title", "Assignments")
@section("contentheader_description", "Assignments listing")
@section("section", "Assignments")
@section("sub_section", "Listing")
@section("htmlheader_title", "Assignments Listing")

@section("headerElems")
@la_access("Assignments", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Assignment</button>
@endla_access
@endsection

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

<div class="box box-success">

	<div class="box-body">

		<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Assignment</h4>
			</div>
			{!! Form::open(['action' => 'LA\AssignmentsController@store', 'id' => 'assignment-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                   <div class="form-group"><label for="cat_id">Select Category* :</label>
						<select class="form-control" name="cat_id" id="cat_id" required="">
							<option>--select--</option>
							@foreach($categories as $row)
							<option value="{{  $row->id }}">{{ $row->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				{!! Form::submit( 'Submit', ['class'=>'btn btn-success']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>

	

	</div>
</div>

@la_access("Assignments", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Assignment</h4>
			</div>
			{!! Form::open(['action' => 'LA\AssignmentsController@store', 'id' => 'assignment-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    @la_form($module)

					{{--
					@la_input($module, 'category_id')
					--}}
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				{!! Form::submit( 'Submit', ['class'=>'btn btn-success']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endla_access

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>
$(function () {
	$("#example1").DataTable({
		processing: true,
        serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/assignment_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#assignment-add-form").validate({
		
	});
});
</script>
@endpush
