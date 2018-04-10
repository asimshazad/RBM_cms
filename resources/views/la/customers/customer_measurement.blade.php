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
			<div class="col-md-6 col-md-offset-2" id="user_fields">
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
					<input type="hidden" name="customer_id" value="{{request()->route('id')}}" id="customer_id">
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

			<div class="col-md-2 user_record" style="display: none;">
				<ul class="list-group">
					  <li class="list-group-item active"><strong class="text-center">User Measurements</strong> </li>
					  <li class="list-group-item">Dapibus ac facilisis in <span class="pull-right">Test</span></li>
					  <li class="list-group-item">Morbi leo risus</li>
					  <li class="list-group-item">Porta ac consectetur ac</li>
					  <li class="list-group-item">Vestibulum at eros</li>
					</ul>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	$(function () {
		$('.btn-save').prop('disabled', true);
	});
</script>
<script type="text/javascript">
	var APP_URL = {!! json_encode(url('/')) !!};
	$("select[name='cat_id']").change(function(){
		var cat_id = $(this).val();
		var customer_id = $('#customer_id').val();
		var token = $("input[name='_token']").val();
		if(cat_id){
			$.ajax({
				url : APP_URL+'/admin/customer/get_categories',
				method: 'POST',
				dataType: 'json',
				data: {id:cat_id,customer_id:customer_id,_token:token},
				beforeSend: function() {
					$(".loader").show();
				},
				success: function(data) {

					$(".loader").hide();
					$('.btn-save').prop('disabled', false);
					if(data.parts){

						$('.cat_parts').html(data.parts);
						$('.user_record').hide();

					}

					if(data.records){

						$('#user_fields').removeClass('col-md-8').addClass('col-md-6');
						$('.user_record').show();
						$('.user_record').html(data.records);
					}
				}
			});
		}
	});
</script>
@endpush
