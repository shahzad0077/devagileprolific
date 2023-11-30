<?php

namespace App\Http\Controllers;
use App\Helpers\Cmf;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
use App\Models\Epic;
use App\Models\flags;
use App\Models\flag_comments;
use App\Models\escalate_cards;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;

class ReactController extends Controller
{
    public function index($organizationid)
    {
    	$data = [
	        'john', 'doe'
	    ];
	    $organization = DB::table('business_units')->where('slug',$organizationid)->first();
	    $data = json_encode($data);
	    return view('react.index',compact('organization','data')); 
    }
}