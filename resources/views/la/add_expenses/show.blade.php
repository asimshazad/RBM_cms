@extends('la.layouts.app')

@section('htmlheader_title')
	Add Expense View
@endsection


@section('main-content')
<div id="page-content" class="profile2">
	
	<ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
		<li class=""><a href="{{ url(config('laraadmin.adminRoute') . '/add_expenses') }}" data-toggle="tooltip" data-placement="right" title="Back to Add Expenses"><i class="fa fa-chevron-left"></i></a></li>
		<li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> General Info</a></li>
	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active fade in" id="tab-info">
			<div class="tab-content">
				<div class="panel infolist">
					<div class="panel-default panel-heading">
						<h4>General Info</h4>
					</div>
					<div class="panel-body">
						@la_display($module, 'category_id')
						@la_display($module, 'amount')
						@la_display($module, 'description')
						@la_display($module, 'amount_date')
					</div>
				</div>
			</div>
		</div>
		
	</div>
	</div>
	</div>
</div>
@endsection
