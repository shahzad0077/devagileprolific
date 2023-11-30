<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     $data = DB::table('kpi_setting')->where('user_id',Auth::id())->get();
    //     return view('Chart.chart',compact('data'));
        
        
    // }
    
    public function index()
    {
        $organization  = Organization::where('user_id',Auth::id())->where('trash',NULL)->Paginate(10);
        return view('organizations.index',compact('organization'));

    }
}
