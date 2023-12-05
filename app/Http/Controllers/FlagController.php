<?php

namespace App\Http\Controllers;
use App\Helpers\Cmf;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
use App\Models\Epic;
use App\Models\activities;
use App\Models\attachments;
use App\Models\flags;
use App\Models\flag_comments;
use App\Models\escalate_cards;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;

class FlagController extends Controller
{
    public function flags($organizationid , $flagtype , $type)
    {
        if($type == 'stream')
        {
            $organization = DB::table('value_stream')->where('slug',$organizationid)->first();
        }
        if($type == 'unit')
        {
            $organization = DB::table('business_units')->where('slug',$organizationid)->first();
        }
        if($type == 'BU')
        {
            $organization = DB::table('unit_team')->where('slug',$organizationid)->first();
        }
        if($type == 'VS')
        {
            $organization = DB::table('value_team')->where('slug',$organizationid)->first();
        }
        $doneflag = flags::where('business_units' , $organization->id)->where('archived' , 2)->where('flag_status' , 'doneflag')->orderby('id' , 'desc')->get();
        $inprogress = flags::where('business_units' , $organization->id)->where('archived' , 2)->where('flag_status' , 'inprogress')->orderby('id' , 'desc')->get();
        $todoflag = flags::where('business_units' , $organization->id)->where('archived' , 2)->where('flag_status' , 'todoflag')->orderby('id' , 'desc')->get();
        $epics = DB::table('epics')->where('buisness_unit_id' , $organization->id)->where('trash' , Null)->get();
    	return view('flags.index',compact('organization','doneflag','inprogress','todoflag','type','epics')); 
    }
    public function viewboards(Request $request)
    {
        if($request->type == 'stream')
        {
            $organization = DB::table('value_stream')->where('slug',$request->slug)->first();
        }
        if($request->type == 'unit')
        {
            $organization = DB::table('business_units')->where('slug',$request->slug)->first();
        }
        if($request->type == 'BU')
        {
            $organization = DB::table('unit_team')->where('slug',$request->slug)->first();
        }
        if($request->type == 'VS')
        {
            $organization = DB::table('value_team')->where('slug',$request->slug)->first();
        }
        if($request->id == 'all')
        {
            $doneflag = flags::where('business_units' , $organization->id)->where('archived',2)->where('flag_status' , 'doneflag')->orderby('id' , 'desc')->get();
            $inprogress = flags::where('business_units' , $organization->id)->where('archived',2)->where('flag_status' , 'inprogress')->orderby('id' , 'desc')->get();
            $todoflag = flags::where('business_units' , $organization->id)->where('archived',2)->where('flag_status' , 'todoflag')->orderby('id' , 'desc')->get();
        }
        if($request->id == 'archived')
        {
            $doneflag = flags::where('business_units' , $organization->id)->where('archived' , 1)->where('flag_status' , 'doneflag')->orderby('id' , 'desc')->get();
            $inprogress = flags::where('business_units' , $organization->id)->where('archived' , 1)->where('flag_status' , 'inprogress')->orderby('id' , 'desc')->get();
            $todoflag = flags::where('business_units' , $organization->id)->where('archived' , 1)->where('flag_status' , 'todoflag')->orderby('id' , 'desc')->get();
        }
        $epics = DB::table('epics')->where('buisness_unit_id' , $organization->id)->where('trash' , Null)->get();
        $type = $request->type;
        $html = view('flags.viewboards',compact('organization','doneflag','inprogress','todoflag','type','epics'));
        return $html;
    }
    public function searchflag(Request $request)
    {
        $organization = DB::table('business_units')->where('id',$request->organization_id)->first();
        $flag = flags::where('business_units' , $organization->id)->where('flag_status' , $request->id)->where('flag_title', 'LIKE', "%$request->value%")->orderby('flag_order' , 'asc')->get();
        $html = view('flags.searchcard', compact('flag'))->render();
        return $html;
    }
    public function changestatus(Request $request)
    {
        DB::table('flags')->where('id',$request->droppedElId)->update(['flag_status' => $request->parentElId]);
    }
    public function getflagmodal(Request $request)
    {
        $data = flags::find($request->id);
        $comments = flag_comments::where('flag_id' , $request->id)->wherenull('comment_id')->orderby('id' , 'desc')->get();
        $html = view('flags.editmodal', compact('data','comments'))->render();
        return $html;
    }
    public function updateflag(Request $request)
    {
        $update = flags::find($request->id);
        $update->flag_title = $request->flag_title;
        $update->flag_description = $request->flag_description;
        $update->flag_type = $request->flag_type;
        $update->flag_assign = $request->flag_assign;
        $update->save();
        $r = $update;
        if($update->escalate)
        {
            $escalte_id = escalate_cards::find($update->escalate);
            $update_escalated_flag = flags::find($escalte_id->flag_id);
            $update_escalated_flag->flag_title = $request->flag_title;
            $update_escalated_flag->flag_description = $request->flag_description;
            $update_escalated_flag->flag_type = $request->flag_type;
            $update_escalated_flag->flag_assign = $request->flag_assign;
            $update_escalated_flag->save();
        }
        Cmf::save_activity(Auth::id() , 'Updated a Impediment Flag','flags',$request->id);
        $html = view('flags.simplecard', compact('r'))->render();
        return $html;
    }
    
    public function updatecomment(Request $request)
    {
        $addcomment = flag_comments::find($request->comment_id);
        $addcomment->comment = $request->comment;
        $addcomment->save();
        $comments = flag_comments::where('flag_id' , $addcomment->flag_id)->wherenull('comment_id')->orderby('id' , 'desc')->get();
        $html = view('flags.allcomments', compact('comments'))->render();
        return $html;
    }
    public function deleteflag(Request $request)
    {
        flag_comments::where('flag_id' , $request->delete_id)->delete();
        flags::where('id' , $request->delete_id)->delete();
    }
    public function createimpediment(Request $request)
    {
        if($request->epic_id)
        {
            $flag = new flags();
            $flag->business_units = $request->business_units;
            $flag->epic_id = $request->epic_id;
            $flag->flag_type = $request->flag_type;
            $flag->flag_assign = $request->flag_assign;
            $flag->flag_title = $request->flag_title;
            $flag->flag_description = $request->flag_description;
            $flag->archived = 2;
            $flag->flag_status = 'todoflag';
            $flag->board_type = $request->board_type;
            $flag->save();
        }
        else
        {
            $flag = new flags();
            $flag->business_units = $request->business_units;
            $flag->epic_id = $request->epic_id;
            $flag->flag_type = $request->flag_type;
            $flag->flag_assign = $request->flag_assign;
            $flag->flag_title = $request->flag_title;
            $flag->flag_description = $request->flag_description;
            $flag->archived = 2;
            $flag->flag_status = 'todoflag';
            $flag->board_type = $request->board_type;
            $flag->save();
        }
        return redirect()->back()->with('message', 'Flag Created Successfully!!');
    }
    public function getepicflag(Request $request)
    {
        $epic = Epic::where('id' , $request->id)->first();
        $html = view('objective.includes.flagmodal', compact('epic'))->render();
        return $html;
    }
    public function updateepicflag(Request $request)
    {
        $flag = new flags();
        $flag->business_units = $request->buisness_unit_id;
        $flag->epic_id = $request->flag_epic_id;
        $flag->flag_type = $request->flag_type;
        $flag->flag_assign = $request->flag_assign;
        $flag->flag_title = $request->flag_title;
        $flag->flag_description = $request->flag_description;
        $flag->archived = 2;
        $flag->flag_status = 'todoflag';
        $flag->board_type = $request->board_type;
        $flag->save();
        if($request->type == 'unit')
        {
            $organization  = DB::table('business_units')->where('slug',$request->slug)->first();
            $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','unit')->get();   
        }
        if($request->type == 'stream')
        {
            $organization  = DB::table('value_stream')->where('slug',$request->slug)->first();
            $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','stream')->get();          
            
        }
        if($request->type == 'BU')
        {
            $organization  = DB::table('unit_team')->where('slug',$request->slug)->first();
            $objective =     DB::table('objectives')->where('unit_id',$organization->id)->where('trash',NULL)->where('type','BU')->get();   
        }
        if($request->type == 'VS')
        {
            $organization  = DB::table('value_team')->where('slug',$request->slug)->first();
            $objective =     DB::table('objectives')->where('unit_id',$organization->id)->where('trash',NULL)->where('type','VS')->get();
        }
        return view('objective.objective-render',compact('organization','objective')); 
    }
    public function archiveflag(Request $request)
    {
        flags::where('id' , $request->id)->update(array('archived' =>1));
    }
    public function unarchiveflag(Request $request)
    {
        flags::where('id' , $request->id)->update(array('archived' =>2));
    }
    public function showepicdetail(Request $request)
    {
        $data  = Epic::where('id' , $request->id)->first();
        $buisness_unit_id = DB::table('business_units')->where('id' , $data->buisness_unit_id)->first()->business_name;
        $obj_id = DB::table('objectives')->where('id' , $data->obj_id)->first()->objective_name;
        $key_id = DB::table('key_result')->where('id' , $data->key_id)->first()->key_name;
        $initiative_id = DB::table('initiative')->where('id' , $data->initiative_id)->first()->initiative_name;
        $string = $buisness_unit_id.' / '.$obj_id.' / '.$key_id.' / '.$initiative_id;
        return response()->json(array('message' => $string, 'error' => 1));
    }
    public function escalateflag(Request $request)
    {
        $flag = flags::find($request->id);
        if($flag->board_type == 'BU')
        {
            $getteam = DB::table('unit_team')->where('id' , $flag->business_units)->first();
            $unit    = DB::table('business_units')->where('id' , $getteam->org_id)->first();
            $add = new escalate_cards();
            $add->flag_id = $request->id;
            $add->from = 'unit_team';
            $add->to = 'business_units';
            $add->from_id = $getteam->id;
            $add->to_id = $unit->id;
            $add->save();
            // Save Flag to Escalate
            $addescalateflag = new flags();
            $addescalateflag->business_units = $add->to_id;
            $addescalateflag->epic_id = $flag->epic_id;
            $addescalateflag->flag_type = $flag->flag_type;
            $addescalateflag->flag_assign = $flag->flag_assign;
            $addescalateflag->flag_title = $flag->flag_title;
            $addescalateflag->flag_description = $flag->flag_description;
            $addescalateflag->archived = 2;
            $addescalateflag->flag_status = 'todoflag';
            $addescalateflag->board_type = 'unit';
            $addescalateflag->escalate = $add->id;
            $addescalateflag->save();
        }
        if($flag->board_type == 'VS')
        {
            $getstream = DB::table('value_team')->where('id' , $flag->business_units)->first();
            $unit    = DB::table('value_stream')->where('id' , $getstream->org_id)->first();
            $add = new escalate_cards();
            $add->flag_id = $request->id;
            $add->from = 'value_team';
            $add->to = 'value_stream';
            $add->from_id = $getstream->id;
            $add->to_id = $unit->id;
            $add->save();
            // Save Flag to Escalate
            $addescalateflag = new flags();
            $addescalateflag->business_units = $add->to_id;
            $addescalateflag->epic_id = $flag->epic_id;
            $addescalateflag->flag_type = $flag->flag_type;
            $addescalateflag->flag_assign = $flag->flag_assign;
            $addescalateflag->flag_title = $flag->flag_title;
            $addescalateflag->flag_description = $flag->flag_description;
            $addescalateflag->archived = 2;
            $addescalateflag->flag_status = 'todoflag';
            $addescalateflag->board_type = 'stream';
            $addescalateflag->escalate = $add->id;
            $addescalateflag->save();
        }
        if($flag->board_type == 'stream')
        {
            $getstream = DB::table('value_stream')->where('id' , $flag->business_units)->first();
            $unit    = DB::table('business_units')->where('id' , $getstream->unit_id)->first();
            $add = new escalate_cards();
            $add->flag_id = $request->id;
            $add->from = 'value_stream';
            $add->to = 'business_units';
            $add->from_id = $getstream->id;
            $add->to_id = $unit->id;
            $add->save();
            // Save Flag to Escalate
            $addescalateflag = new flags();
            $addescalateflag->business_units = $add->to_id;
            $addescalateflag->epic_id = $flag->epic_id;
            $addescalateflag->flag_type = $flag->flag_type;
            $addescalateflag->flag_assign = $flag->flag_assign;
            $addescalateflag->flag_title = $flag->flag_title;
            $addescalateflag->flag_description = $flag->flag_description;
            $addescalateflag->archived = 2;
            $addescalateflag->flag_status = 'todoflag';
            $addescalateflag->board_type = 'unit';
            $addescalateflag->escalate = $add->id;
            $addescalateflag->save();
        }
        
    }
    public function savecomment(Request $request)
    {
        $addcomment = new flag_comments();
        $addcomment->flag_id = $request->flag_id;
        $addcomment->user_id = $request->user_id;
        $addcomment->comment = $request->comment;
        $addcomment->type = 'comment';
        $addcomment->save();
        Cmf::save_activity(Auth::id() , 'Added a New Comment','flags',$request->flag_id);
        $comments = flag_comments::where('flag_id' , $request->flag_id)->wherenull('comment_id')->orderby('id' , 'desc')->get();
        $data = flags::find($request->flag_id);
        $html = view('flags.tabs.comments', compact('comments','data'))->render();
        return $html;
    }
    public function savereply(Request $request)
    {
        $addcomment = new flag_comments();
        $addcomment->flag_id = $request->flag_id;
        $addcomment->user_id = $request->user_id;
        $addcomment->comment = $request->comment;
        $addcomment->type = 'reply';
        $addcomment->comment_id = $request->comment_id;
        $addcomment->save();
        Cmf::save_activity(Auth::id() , 'Reply a Comment','flags',$request->flag_id);
        $comments = flag_comments::where('flag_id' , $request->flag_id)->wherenull('comment_id')->orderby('id' , 'desc')->get();
        $data = flags::find($request->flag_id);
        $html = view('flags.tabs.comments', compact('comments','data'))->render();
        return $html;
    }
    public function deletecomment(Request $request)
    {
        $comment = flag_comments::find($request->id);
        flag_comments::where('id' , $request->id)->delete();
        flag_comments::where('comment_id' , $request->id)->delete();
        $comments = flag_comments::where('flag_id' , $comment->flag_id)->wherenull('comment_id')->orderby('id' , 'desc')->get();
        Cmf::save_activity(Auth::id() , 'Delete a Comment','flags',$comment->flag_id);
        $data = flags::find($comment->flag_id);
        $html = view('flags.tabs.comments', compact('comments','data'))->render();
        return $html;
    }
    public function showtab(Request $request)
    {
        if($request->tab == 'general')
        {
            $data = flags::find($request->id);
            $html = view('flags.tabs.general', compact('data'))->render();
            return $html;
        }
        if($request->tab == 'comment')
        {
            $comments = flag_comments::where('flag_id' , $request->id)->wherenull('comment_id')->orderby('id' , 'desc')->get();
            $data = flags::find($request->id);
            $html = view('flags.tabs.comments', compact('comments','data'))->render();
            return $html;
        }
        if($request->tab == 'activites')
        {
            $activity = activities::where('value_id' , $request->id)->where('type' , 'flags')->orderby('id' , 'desc')->get();
            $data = flags::find($request->id);
            $html = view('flags.tabs.activities', compact('activity','data'))->render();
            return $html;
        }
        if($request->tab == 'attachment')
        {
            $attachments = attachments::where('value_id' , $request->id)->where('type' , 'flags')->orderby('id' , 'desc')->get();
            $data = flags::find($request->id);
            $html = view('flags.tabs.attachments', compact('attachments','data'))->render();
            return $html;
        }
    }
    public function uploadattachment(Request $request)
    {
        $filename = $request->file('file')->getClientOriginalName();
        $add = new attachments();
        $add->user_id = Auth::id();
        $add->attachment = Cmf::sendimagetodirectory($request->file);
        $add->file_name = $request->file('file')->getClientOriginalName();
        $add->extension = Cmf::get_file_extension($filename);
        $add->type = 'flags';
        $add->value_id = $request->value_id;
        $add->save();

        Cmf::save_activity(Auth::id() , 'Added a New Attachment','flags',$request->value_id);

        $attachments = attachments::where('value_id' , $request->value_id)->where('type' , 'flags')->orderby('id' , 'desc')->get();
        $data = flags::find($request->value_id);
        $html = view('flags.tabs.attachments', compact('attachments','data'))->render();
        return $html;
    }
    public function deleteattachment(Request $request)
    {
        $attachment = attachments::find($request->id);
        attachments::where('id',$request->id)->delete();
        $attachments = attachments::where('value_id' , $attachment->value_id)->where('type' , 'flags')->orderby('id' , 'desc')->get();
        Cmf::save_activity(Auth::id() , 'Delete a Attachment','flags',$attachment->value_id);
        $data = flags::find($attachment->value_id);
        $html = view('flags.tabs.attachments', compact('attachments','data'))->render();
        return $html;
    }
    public function showorderby(Request $request)
    {
        if($request->table == 'flag_comments')
        {
            $comments = flag_comments::where('flag_id' , $request->flag_id)->wherenull('comment_id')->orderby('id' , $request->id)->get();
            $orderby = $request->id;
            $data = flags::find($request->flag_id);
            $html = view('flags.tabs.comments', compact('comments','data','orderby'))->render();
            return $html;
        }
        if($request->table == 'activities')
        {
            $activity = activities::where('value_id' , $request->flag_id)->where('type' , 'flags')->orderby('id' , $request->id)->get();
            $orderby = $request->id;
            $data = flags::find($request->flag_id);
            $html = view('flags.tabs.activities', compact('activity','data','orderby'))->render();
            return $html;
        }
        if($request->table == 'attachments')
        {
            $attachments = attachments::where('value_id' , $request->flag_id)->where('type' , 'flags')->orderby('id' , $request->id)->get();
            $data = flags::find($request->flag_id);
            $orderby = $request->id;
            $html = view('flags.tabs.attachments', compact('attachments','data','orderby'))->render();
            return $html;
        }
    }
}