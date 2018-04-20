<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */
namespace App\Http\Controllers\LA;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;
use App\Models\Customer;
use App\Models\UserMeasurements;
use App\Models\PartAssignment;
class CustomersController extends Controller
{
	public $show_action = true;
	public $view_col = 'name';
	public $listing_cols = ['id', 'name', 'phone', 'city', 'department'];
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Customers', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Customers', $this->listing_cols);
		}
	}
	/**
	 * Display a listing of the Customers.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Customers');
		if(Module::hasAccess($module->id)) {
			return View('la.customers.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}
	/**
	 * Show the form for creating a new customer.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}
	/**
	 * Store a newly created customer in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Customers", "create")) {
			$rules = Module::validateRules("Customers", $request);
			$validator = Validator::make($request->all(), $rules);
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			$insert_id = Module::insert("Customers", $request);
			return redirect()->route(config('laraadmin.adminRoute') . '.customers.index');
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	/**
	 * Display the specified customer.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Customers", "view")) {
			$customer = Customer::find($id);
			if(isset($customer->id)) {
				$module = Module::get('Customers');
				$module->row = $customer;
				return view('la.customers.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('customer', $customer);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("customer"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	/**
	 * Show the form for editing the specified customer.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Customers", "edit")) {			
			$customer = Customer::find($id);
			if(isset($customer->id)) {	
				$module = Module::get('Customers');
				$module->row = $customer;
				return view('la.customers.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('customer', $customer);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("customer"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	/**
	 * Update the specified customer in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Customers", "edit")) {
			$rules = Module::validateRules("Customers", $request, true);
			$validator = Validator::make($request->all(), $rules);
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			$insert_id = Module::updateRow("Customers", $request, $id);
			return redirect()->route(config('laraadmin.adminRoute') . '.customers.index');
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	/**
	 * Remove the specified customer from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Customers", "delete")) {
			Customer::find($id)->delete();
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.customers.index');
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	public function dtajax()
	{
		$values = DB::table('customers')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();
		$fields_popup = ModuleFields::getModuleFields('Customers');
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) {
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/customers/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			if($this->show_action) {
				$output = '';
				$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/customer/measurement/'.$data->data[$i][0]).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;margin:0 3px;"><i class="fa fa-list"></i></a>';
				if(Module::hasAccess("Customers", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/customers/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				if(Module::hasAccess("Customers", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.customers.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
					$output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
					$output .= Form::close();
				}
				$data->data[$i][] = (string)$output;
			}
		}
		$out->setData($data);
		return $out;
	}
	public function customer_measurement($id)
	{
		$module = Module::get('Measurements');
		$categories = DB::select( DB::raw("SELECT * FROM categories") );
		return view('la.customers.customer_measurement',compact('categories'));
	}

	public function get_categories(Request $request)
	{
		 $id =  $request->id;
		 $customer_id = $request->customer_id;
         DB::enableQueryLog();

        $res = array();
		$output ='';
		$msg ='';

		//$parts = DB::select( DB::raw("SELECT * FROM  part_assignments where category_id =$id") );

		$parts = PartAssignment::with('parts')->whereCategoryId($id)->get();


		//echo '<pre>';print_r($parts);die;



$query = DB::getQueryLog(); 
		$query = end($query);
print_r($query);


		if($parts){

			foreach($parts as $row){
				//echo '<pre>';print_r($row);
				$output.= '<div class="form-group">
							<label for="total_amount">'.($row->parts['name']).'* :</label>
							<input required=""  class="form-control"
							placeholder="Enter '.ucfirst($row->id).'"
							name="'.str_slug($row->id).'"
							type="text" >
						    </div>';
			}
	    } else {

	    	$output.= '0';
	    }

  //       $Umsr = DB::select( DB::raw("SELECT * FROM user_measurements where cat_id = $id && customer_id = $customer_id ") );

		// if(count($Umsr)){

		// 	$json =  $Umsr[0]->description;

	 //        $rec =  json_decode($json, true);

	 //        if($rec)
	 //        {
	 //        	$msg.='<ul class="list-group">';
	 //        	$msg.='<li class="list-group-item active"><strong class="text-center">User Measurements</strong> </li>';
		//     	foreach($rec as $key=>$row){

		//     		$msg.= '<li class="list-group-item">'.$key.'<span class="pull-right">'.$row.'</span></li>';

		//     	}

		//     	$msg.='</ul>';
	 //        }else{

	 //        	$msg.= '0';
	 //        }
		// }




	    $res['parts'] = $output;
	    $res['records'] = $msg;

	    echo json_encode($res);


	}


	public function saveMeasurement(Request $request)
	{
		$all = $request->all();
		$cat_id = $request->cat_id;
		$customer_id = $request->customer_id;
		unset($all['_token']);
		unset($all['cat_id']);
		unset($all['customer_id']);
        $desc = json_encode($all);
		UserMeasurements::updateOrCreate(
		   ['cat_id' => $cat_id, 'customer_id' => $customer_id],
		   ['description' => $desc]
		);
        return redirect('admin/customers')->with('success', 'User Measurements are saved successfully');
	}


}