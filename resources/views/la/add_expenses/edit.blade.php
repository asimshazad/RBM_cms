@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/add_expenses') }}">Add Expense</a> :
@endsection
@section("contentheader_description", $add_expense->$view_col)
@section("section", "Add Expenses")
@section("section_url", url(config('laraadmin.adminRoute') . '/add_expenses'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Add Expenses Edit : ".$add_expense->$view_col)

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
				{!! Form::model($add_expense, ['route' => [config('laraadmin.adminRoute') . '.add_expenses.update', $add_expense->id ], 'method'=>'PUT', 'id' => 'add_expense-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'category_id')
					@la_input($module, 'amount')
					@la_input($module, 'description')
					@la_input($module, 'amount_date')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/add_expenses') }}">Cancel</a></button>
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
	$("#add_expense-edit-form").validate({
		
	});
});
</script>
@endpush
