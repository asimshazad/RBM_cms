@extends("la.layouts.app")
@section("contentheader_title")
<a href="{{ url(config('laraadmin.adminRoute') . '/customers') }}">Customer Measurements</a> 
@endsection
@section("Customers Measurement", 'Measurement')
@section("section", "Customers Measurement")
@section("section_url", url(config('laraadmin.adminRoute') . '/customers'))
@section("sub_section", "Edit")
@section("htmlheader_title", "Customers Measurement")
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
				<form method="POST" action="{{  url('admin/customer/save') }}" accept-charset="UTF-8" id="" novalidate="novalidate">
					{{  csrf_field() }}
					<div class="form-group"><label for="cat_id">Select Category* :</label>
						<select class="form-control" name="cat_id" id="cat_id" required="">
							<option>--select--</option>
							@foreach($categories as $row)
							<option value="{{  $row->id }}">{{ $row->name }}</option>
							@endforeach
						</select>
					</div>
					<input type="text" name="customer_id" value="{{request()->route('id')}}" id="customer_id">
					<div class="loader" style="display: none;">
						<img src="{{  asset('la-assets/img/lazy-loader.gif') }}">
					</div>
					<div class="cat_parts"></div>
					<br>
					<div class="form-group">
						<input class="btn btn-success btn-save" type="submit" value="Save"> 
						<button class="btn btn-default pull-right">
							<a href="{{  url('admin/customers') }}">Cancel</a>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	$(function () {
		$('.btn-save').prop('disabled', true);
		$("#customer-edit-form").validate({
		});
	});
</script>
<script type="text/javascript">
	var APP_URL = {!! json_encode(url('/')) !!};
	$("select[name='cat_id']").change(function(){
		var cat_id = $(this).val();
		var token = $("input[name='_token']").val();
		if(cat_id){
			$.ajax({
				url : APP_URL+'/admin/customer/get_categories',
				method: 'POST',
				data: {id:cat_id, _token:token},
				beforeSend: function() {
					$(".loader").show();
				},
				success: function(data) {
					if(data == 0){
						$(".loader").hide();
						$('.btn-save').prop('disabled', true);
						$('.cat_parts').html('<p>No parts found aginst this category</p>');
					}else{
						$(".loader").hide();
						$('.btn-save').prop('disabled', false);
						$('.cat_parts').html(data);
					}
				}
			});
		}
	});
</script>
@endpush
