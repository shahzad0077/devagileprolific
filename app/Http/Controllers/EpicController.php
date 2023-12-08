<?php

namespace App\Http\Controllers;
use App\Helpers\Cmf;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
use App\Models\Epic;
use App\Models\activities;
use App\Models\attachments;
use App\Models\flag_members;
use App\Models\flags;
use App\Models\flag_comments;
use App\Models\escalate_cards;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;

class EpicController extends Controller
{
    public function getepicmodal(Request $request)
    {
        $data = Epic::find($request->id);
        $html = view('epics.modal', compact('data'))->render();
        return $html;
    }
    public function updategeneral(Request $request)
    {
        $data = Epic::find($request->epic_id);
        $data->epic_name = $request->epic_name;
        $data->epic_start_date = $request->epic_start_date;
        $data->epic_end_date = $request->epic_end_date;
        $data->epic_detail = $request->epic_detail;
        $data->save();  
    }
    public function showepicinboard(Request $request)
    {
        $e = Epic::find($request->id);
        if($request->organization == 'unit')
        {
            $organization  = DB::table('business_units')->where('slug',$request->slug)->first();
        }        
        if($request->organization == 'stream')
        {
            $organization  = DB::table('value_stream')->where('slug',$request->slug)->first();
        }
        if($request->organization == 'BU')
        {
          $organization  = DB::table('unit_team')->where('slug',$request->slug)->first();        
        }
        if($request->organization == 'VS')
        {
            $organization  = DB::table('value_team')->where('slug',$request->slug)->first();
        }
        $html = view('epics.showepicinboard', compact('organization','e'))->render();
        return $html;
    }
    public function showtab(Request $request)
    {
        
    }
}