<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */



    public function index()
    {

        $customers= DB::table("customers")->count();
        $orders= DB::table("orders")->count();
        $employees= DB::table("employees")->count();
        $expenses= DB::table("add_expenses")->count();


        $latest_customers = DB::table('customers')->select('*')->orderBy('id','desc')->take(5)->get();
        $latest_orders = DB::table('orders')->select('*')->orderBy('id','desc')->take(5)->get();


        return view('la.dashboard',compact('customers','orders','employees','expenses','latest_customers','latest_orders'));
    }
}