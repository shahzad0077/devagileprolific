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

class LinkingController extends Controller
{
    public function index($organizationid)
    {
    	$var_objective = 'linking';
	    $organization = DB::table('business_units')->where('slug',$organizationid)->first();
	    return view('linking.index',compact('organization','var_objective')); 
    }
}