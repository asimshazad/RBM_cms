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

use App\Models\Assignment;
use App\Models\PartAssignment;

class AssignmentsController extends Controller
{
	public $show_action = true;
	public $view_col = 'category_id';
	public $listing_cols = ['id', 'category_id'];

	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Assignments', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Assignments', $this->listing_cols);
		}
	}

	/**
	 * Display a listing of the Assignments.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

        $categories = DB::select( DB::raw("SELECT * FROM categories ORDER BY id DESC") );
        $parts = DB::select( DB::raw("SELECT * FROM parts ORDER BY id DESC") );

		return view('la.assignments.index',compact('categories','parts'));

		if(Module::hasAccess($module->id)) {
			return View('la.assignments.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	function storeAssignments(Request $request)
	{
		$parts = $request->part_id;
		$category_id = $request->category_id;


		if($category_id != '')
		{
			DB::delete('delete from part_assignments where category_id = "'.$category_id.'"');
		}
		

		for ($i = 0; $i < count($parts); $i++) {
   
			   $PartAssignment = new PartAssignment;
			   $PartAssignment->category_id = $category_id;
			   $PartAssignment->part_id =  $parts[$i];
			   $PartAssignment->save();

		}
		return redirect()->route(config('laraadmin.adminRoute') . '.assignments.index');

	}


	function get_parts_by_cat_id(Request $request)
	{

		$id = $request->id;
		$parts = DB::select( DB::raw("SELECT * FROM parts ORDER BY id DESC") );
	    $Datatables = DB::select( DB::raw("SELECT part_id FROM part_assignments WHERE category_id =$id") );


	    if(count($Datatables) > 0){

	    	$old_parts = array();
            foreach ($Datatables as $row) {
            	//echo '<pre>';print_r($row);
                $old_parts[$row->part_id] = $row->part_id;
            }

	    }

	    return view('la.assignments.parts_list',compact('parts','old_parts'));

	}

	/**
	 * Show the form for creating a new assignment.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created assignment in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Assignments", "create")) {
		
			$rules = Module::validateRules("Assignments", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Assignments", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.assignments.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified assignment.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Assignments", "view")) {
			
			$assignment = Assignment::find($id);
			if(isset($assignment->id)) {
				$module = Module::get('Assignments');
				$module->row = $assignment;
				
				return view('la.assignments.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('assignment', $assignment);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("assignment"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified assignment.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Assignments", "edit")) {			
			$assignment = Assignment::find($id);
			if(isset($assignment->id)) {	
				$module = Module::get('Assignments');
				
				$module->row = $assignment;
				
				return view('la.assignments.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('assignment', $assignment);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("assignment"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified assignment in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Assignments", "edit")) {
			
			$rules = Module::validateRules("Assignments", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Assignments", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.assignments.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified assignment from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Assignments", "delete")) {
			Assignment::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.assignments.index');
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
		$values = DB::table('assignments')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Assignments');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/assignments/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("Assignments", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/assignments/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Assignments", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.assignments.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
					$output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
					$output .= Form::close();
				}
				$data->data[$i][] = (string)$output;
			}
		}
		$out->setData($data);
		return $out;
	}
}