@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/expense_categories') }}">Expense Category</a> :
@endsection
@section("contentheader_description", $expense_category->$view_col)
@section("section", "Expense Categories")
@section("section_url", url(config('laraadmin.adminRoute') . '/expense_categories'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Expense Categories Edit : ".$expense_category->$view_col)

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
				{!! Form::model($expense_category, ['route' => [config('laraadmin.adminRoute') . '.expense_categories.update', $expense_category->id ], 'method'=>'PUT', 'id' => 'expense_category-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'name')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/expense_categories') }}">Cancel</a></button>
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
	$("#expense_category-edit-form").validate({
		
	});
});
</script>
@endpush
