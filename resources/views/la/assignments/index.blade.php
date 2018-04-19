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
				<h4 class="modal-title" id="myModalLabel">Category Assignment</h4>
			</div>
			<form action="{{  url('/admin/assignments/save') }}" method="POST">
				{{ csrf_field() }}
			<div class="modal-body">
				<div class="box-body">
                   <div class="form-group"><label for="cat_id">Select Category* :</label>
						<select class="form-control" name="category_id" id="category_id" required="">
							<option value="">--select--</option>
							@foreach($categories as $row)
							<option value="{{  $row->id }}">{{ $row->name }}</option>
							@endforeach
						</select>
					</div>
                    <div class="form-group" id="parts_list">

                    	<p>Please select a category to assign </p>

					 
					</div>
				</div>
			</div>
			<div class="modal-footer">
				{!! Form::submit( 'Submit', ['class'=>'btn btn-success']) !!}
			</div>
			</form>
		</div>
	</div>

	

	</div>
</div>



@endsection




@push('scripts')
<script type="text/javascript">

	var APP_URL = {!! json_encode(url('/')) !!};

	$("select[name='category_id']").change(function(){

		var cat_id = $(this).val();
		
		var token = $("input[name='_token']").val();
		if(cat_id){
			$.ajax({
				url : APP_URL+'/admin/get_parts_by_cat',
				method: 'POST',
				//dataType: 'json',
				data: {id:cat_id,_token:token},
				beforeSend: function() {
					$(".loader").show();
				},
				success: function(data) {

					$('#parts_list').html(data);

					$(".loader").hide();
					$('.btn-save').prop('disabled', false);
					
				}
			});
		}
	});
</script>

@endpush
