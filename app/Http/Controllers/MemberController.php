<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;
use DB;
use Carbon\Carbon;
use Mail;
use App\Models\OrganizationContacts;
use App\Helpers\Jira;

class MemberController extends Controller
{
    
     public function __construct()
    {
    $this->middleware('auth');
    }
    
    public function AllMembers()
    {
        $Member  = Member::where('org_user',Auth::id())
        ->join('users','members.user_id','=','users.id')->select('members.*','users.*','users.role AS u_role','users.status AS u_status','members.id AS ID','users.id AS u_id','members.name AS Name','members.last_name AS LastName')
        ->get();
        return view('member.member',compact('Member'));

    }
    
    public function SaveMember(Request $request)
    {



        
        $request->validate([
            'email' => 'bail|required|email|unique:users',
        ]);
        
        
        $email = User::where('email',$request->email)->first();
     

        $User  = new User();
        $User->name = $request->member_name;
        $User->email = $request->email;
        $User->password = Hash::make('11223344');
        $User->role = $request->role;
        $User->email_verified_at = Carbon::now();
        $User->save();
        
        

        $Member  = new Member();
        $Member->name = $request->member_name;
        $Member->email = $request->email;
        $Member->phone = $request->phone;
        if($request->add_image)
        {
        $Member->image = $this->sendimagetodirectory($request->add_image);
        }
        $Member->user_id = $User->id;
        $Member->org_id = $request->org_id;
        $Member->org_user = Auth::id();
        $Member->last_name = $request->last_member_name;
        $Member->save();
        
        $Password = "11223344";
        $email =  $request['email'];
        $Name = $request['member_name'];
        $password = $Password;
    
        $data = [
        'Username' => $email,
        'Name' => $Name,
        'password' => $password,

        ];
        Mail::send('email.email-member', $data, function($message) use ($email) {
        $message->to($email, env('MAIL_FROM_NAME'))->subject('Login Credentials');
        $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });
        
       
        return redirect()->back()->with('message', 'Member Added Successfully');

    }

  
   public function Checkemail(Request $request)
    {
        $User = User::where('email',$request->email)->first();
        if($User)
        {
        echo 1;    
        }else
        {
        echo 2;    
        }

    }
    

     public function UpdateMember(Request $request)
    {

            $Member  = Member::find($request->member_id);

            if($request->has('image'))
            {
              $Member->image = $this->sendimagetodirectory($request->image);
            }else{

                $Member->image = $request->old_image;
    
            }
           
          $Member->name = $request->name;
          $Member->phone = $request->phone;
          $Member->status = $request->status;
          $Member->last_name = $request->last_member_name;
          $Member->save();
          
            $User  = User::find($request->user_id);;
            $User->name = $request->name;
            $User->status = $request->status;
            $User->save();
        
        

        return redirect()->back()->with('message', 'Member Updated Successfully');
    }
    
    
     public function DeleteMember(Request $request)
    {

            $Member  = Member::where('id',$request->member_id)->delete();
            $User  = User::where('id',$request->user_id)->delete();
        
    
    }
 

     public function ObjectivesContacts()
    {
        
    $OrgContact = OrganizationContacts::where('user_id',Auth::id())->get();
    return view('member.organization-contacts',compact('OrgContact'));  
        
    }
    
    public function ObjectivesUnit()
    {
        
    // $organization  = Organization::where('slug',$id)->where('trash',NULL)->first();
    $Unit = DB::table('business_units')->where('user_id',Auth::id())->get();
    return view('member.organization-business-units',compact('Unit'));  
        
    }
    
     public function ObjectivesTeam($id)
    {
        
    $organization  = Organization::where('slug',$id)->where('trash',NULL)->first();
    $Team = DB::table('teams')->where('org_id',$organization->id)->get();

    return view('member.Team',compact('organization','Team'));  
        
    }
    
     public function ObjectivesValue($id)
    {
        
    $organization = DB::table('business_units')->where('slug',$id)->first();    
    $Stream = DB::table('value_stream')->where('value_stream.user_id',Auth::id())
              ->join('business_units','value_stream.unit_id','=','business_units.id')
              ->where('value_stream.unit_id',$organization->id)
              ->select('business_units.*','value_stream.*','value_stream.lead_id AS Lead_id','value_stream.id AS ID','value_stream.detail AS DETAIL')
              ->get();
     return view('member.value-streams',compact('Stream','organization'));  
        
    }
 
 
  public function SaveOrganizationMember(Request $request)
    {

        $Member  = new OrganizationContacts();
        $Member->name = $request->name;
        $Member->email = $request->email;
        $Member->phone = $request->phone;
        if($request->image)
        {
        $Member->image = $this->sendimagetodirectory($request->image);
        }

        $Member->role = $request->role;
        $Member->last_name = $request->last_name;
        $Member->user_id = Auth::id();
        $Member->save();
        
      
       
        return redirect()->back()->with('message', 'Organization Contact Added Successfully');

    }


   public function UpdateOrganizationMember(Request $request)
    {

            $Member  = OrganizationContacts::find($request->id);

            if($request->has('image'))
            {
              $Member->image = $this->sendimagetodirectory($request->image);
            }else{

                $Member->image = $request->old_image;
    
            }
           
          $Member->name = $request->name;
          $Member->phone = $request->phone;
          $Member->role = $request->role;
          $Member->last_name = $request->last_name;
          $Member->save();
         
        
        

        return redirect()->back()->with('message', 'Organization Contact Updated Successfully');
    }
    
    
      public function DeleteOrganizationMember(Request $request)
    {

     $Member  = OrganizationContacts::where('id',$request->contact)->delete();
        
    
    }
    
       public function MultipleDeleteOrganizationMember(Request $request)
    {

     $Member  = OrganizationContacts::whereIn('id',$request->selectedOptions)->delete();
        
    
    }
    
     public function SaveBusinessUnits(Request $request)
    {

     
        DB::table('business_units')
        ->insert([
            'business_name' => $request->unit_name,
            'lead_id' => $request->lead_manager,
            'detail' => $request->unit_detail,
            'slug' => Str::slug($request->unit_name.'-'.rand(10, 99)),
            'user_id' => Auth::id(),
            
            ]);
      
       
        return redirect()->back()->with('message', 'Business Units Added Successfully');

    }
    
       public function UpdateBusinessUnits(Request $request)
    {

     
        DB::table('business_units')
        ->where('id',$request->unit_id)
        ->update([
            'business_name' => $request->unit_name,
            'lead_id' => $request->lead_manager,
            'detail' => $request->detail,
            'slug' => Str::slug($request->unit_name.'-'.rand(10, 99)),
            
            ]);
      
       
        return redirect()->back()->with('message', 'Business Units Updated Successfully');

    }
    
    
    
    public function SaveBusinessTeam(Request $request)
    {

     
        DB::table('unit_team')
        ->insert([
            'org_id' => $request->team_unit_id,
            'member' => implode(',',$request->member),
            'lead_id' => $request->lead_manager_team,
            'team_title' => $request->team_title,
            'slug' => Str::slug($request->team_title.'-'.rand(10, 99)),
            
            ]);
      
       
        return redirect()->back()->with('message', 'Team Added Successfully');

    }
    
    
    
       public function SaveStreamTeam(Request $request)
    {

        DB::table('value_team')
        ->insert([
            'org_id' => $request->org_stream_id,
            'member' => implode(',',$request->member),
            'lead_id' => $request->lead_manager_team,
            'team_title' => $request->team_title,
            'slug' => Str::slug($request->team_title.'-'.rand(10, 99)),
            
            
            ]);
      
       
        return redirect()->back()->with('message', 'Team Added Successfully');

    }
    
      public function SaveBusinessStream(Request $request)
    {

     
        DB::table('value_stream')
        ->insert([
            'unit_id' => $request->org_value_id,
            'lead_id' => $request->lead_manager,
            'detail' => $request->detail,
            'value_name' => $request->value_name,
            'slug' => Str::slug($request->value_name.'-'.rand(10, 99)),
            'user_id' => Auth::id(),
            
            ]);
      
       
        return redirect()->back()->with('message', 'Value Stream Added Successfully');

    }
    
         public function UpdateBusinessStream(Request $request)
    {

     
        DB::table('value_stream')
        ->where('id',$request->value_id)
        ->update([
            'unit_id' => $request->unit_id,
            'lead_id' => $request->lead_manager,
            'detail' => $request->detail,
            'value_name' => $request->value_name,
            'slug' => Str::slug($request->value_name.'-'.rand(10, 99)),
            
            ]);
      
       
        return redirect()->back()->with('message', 'Value Stream Updated Successfully');

    }
    
          public function SaveGlobTeam(Request $request)
    {

        DB::table('teams')
        ->insert([
            'org_id' => $request->org_id,
            'member' => implode(',',$request->member),
            'lead_id' => $request->lead_manager_team,
            'team_title' => $request->team_title,
            
            ]);
      
       
        return redirect()->back()->with('message', 'Team Added Successfully');

    }
    
      public function StreamBacklog($id)
    {
    
    $organization = DB::table('value_stream')->where('slug',$id)->first();        
    $Backlog  =  DB::table('backlog')->where('stream_id',$organization->id)->where('assign_status',NULL)->orderBy('position')->get();
    
    Jira::UpdateBVsjira();
    return view('member.backlog',compact('Backlog','organization'));  
        
    }
       public function SaveBacklogEpic(Request $request)
    {

     
        DB::table('backlog')
        ->insert([
            'epic_title' => $request->epic_name,
            'epic_start_date' => $request->epic_start_date,
            'epic_end_date' => $request->epic_end_date,
            'epic_status' => $request->epic_status,
            'epic_detail' => $request->epic_description,
            'stream_id' => $request->Stream_id,
            
            ]);
      
       
        return redirect()->back()->with('message', 'Backlog Epic Added Successfully');

    }
    
         public function UpdateBacklogEpic(Request $request)
       {

        DB::table('backlog')
        ->where('id',$request->backlog_id)
        ->update([
            'epic_title' => $request->epic_name,
            'epic_start_date' => $request->epic_start_date,
            'epic_end_date' => $request->epic_end_date,
            'epic_status' => $request->epic_status,
            'epic_detail' => $request->epic_description,
            'team_id' => $request->team,
            
            ]);
            
         $jira = DB::table('backlog')->where('id',$request->backlog_id)->first();
         if($jira->jira_id != '')
         {
         $backlog = DB::table('epics')->where('jira_id',$jira->jira_id)->first();
         if($backlog)
         {
           DB::table('epics')
           ->where('jira_id',$jira->jira_id)
           ->update(['epic_name' => $request->epic_name]);
           
         }
         
    if($jira->jira_id != '')
    {
    $Account = DB::table('jira_setting')->where('user_id',Auth::id())->first();
    $username = $Account->user_name;
    $apiToken = $Account->token;
    $issueKeyOrId = $jira->jira_id;
    $apiEndpoint = "{$Account->jira_url}/rest/api/3/issue/{$issueKeyOrId}";

    $auth = base64_encode("$username:$apiToken");

        $updateData = [
    "fields" => [
        "description" => [
            "type" => "doc",
            "version" => 1,
            "content" => [
                [
                    "type" => "paragraph",
                    "content" => [
                        [
                            "type" => "text",
                            "text" => $request->epic_description
                        ]
                    ]
                ]
            ]
        ],
        
       "summary" => $request->epic_name, 
    ],
    
     
];
        
        $ch = curl_init($apiEndpoint);
        
        if ($ch === false) {
            die("cURL initialization failed");
        }
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($updateData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Basic {$auth}",
            "Content-Type: application/json",
        ]);
        
        $response = curl_exec($ch);
        
        curl_close($ch);

     }
             
         }
      
       
        return redirect()->back()->with('message', 'Backlog Epic Updated Successfully');

    }
    
    public function GetBacklogObj(Request $request)
    {
    if($request->type == 'BU')
    {   
    $objective = DB::table('objectives')->where('unit_id',$request->id)->where('type','BU')->where('trash',NULL)->get();
    }
    if($request->type == 'VS')
    {   
    $objective = DB::table('objectives')->where('unit_id',$request->id)->where('type','VS')->where('trash',NULL)->get();
    }
    if($request->type == 'unit')
    {
    $objective = DB::table('objectives')->where('unit_id',$request->id)->where('type','unit')->where('trash',NULL)->get();
    }
    if($request->type == 'stream')
    {
    $objective = DB::table('objectives')->where('unit_id',$request->id)->where('type','stream')->where('trash',NULL)->get();
    }       
    
    return $objective;
    }
    
    public function GetBacklogKey(Request $request)
    {
    $objective = DB::table('key_result')->where('obj_id',$request->id)->get();
    return $objective;
    }
    
     public function GetBacklogInit(Request $request)
    {
    $objective = DB::table('initiative')->where('key_id',$request->id)->get();
    return $objective;
    }


    
     public function AssignBacklogEpic(Request $request)
    {

      
          $backlogIds = explode(',', $request->input('backlog_id'));

          foreach($backlogIds  as $key => $value)
          {
              
           $log = DB::table('backlog')->where('id',$value)->first();
          foreach($request->end_date  as $key => $value)
          {
           $monthName = Carbon::parse($request->end_date[$key])->format('F');
           $month = DB::table('quarter_month')->where('initiative_id',$request->locinit)->where('month',$monthName)->first();
           
           if(!$month)
           {
            return redirect()->back()->with('message', 'initiative Quarter Month Not Found');
           }

               $EpicId = DB::table('epics')->insertGetId([
        
                'epic_status' => $log->epic_status,
                'epic_name' => $log->epic_title,
                'epic_detail' => $log->epic_detail,
                'epic_start_date' => $request->start_date[$key],
                'epic_end_date' => $request->end_date[$key],
                'initiative_id' => $request->locinit,
                'user_id' => Auth::id(),
                'month_id' => $month->id,
                'quarter_id' => $month->quarter_id, 
                'backlog_id' => $log->id,
                'type' => 'stream',
                'key_id' => $request->lockey,
                'jira_id' =>  $log->jira_id,
                'account_id' => $log->account_id,
                'jira_project' =>  $log->jira_project,


        
                ]);
            
                 

          }
          
            foreach($request->end_date  as $k => $value)
          {
               DB::table('backlog')->where('id', $value)->update(['epic_start_date' => $request->start_date[$k],'epic_end_date' => $request->end_date[$k]]);
          }
          
    }
    
         

        //   $backlog = DB::table('backlog')->whereIn('id', $backlogIds)->get();
        //   foreach($backlog as $log)
        //   {
              
        //   $monthName = Carbon::parse($request->end_date)->format('F');
        //   $month = DB::table('quarter_month')->where('initiative_id',$request->locinit)->where('month',$monthName)->first();
           
        //   if(!$month)
        //   {
        //     return redirect()->back()->with('message', 'initiative Quarter Month Not Found');
        //   }

        //         DB::table('epics')->insert([
        
        //         'epic_status' => $log->epic_status,
        //         'epic_name' => $log->epic_title,
        //         'epic_detail' => $log->epic_detail,
        //         'epic_start_date' => $request->start_date,
        //         'epic_end_date' => $request->end_date,
        //         'initiative_id' => $request->locinit,
        //         'user_id' => Auth::id(),
        //         'month_id' => $month->id,
        //         'quarter_id' => $month->quarter_id, 
        //         'backlog_id' => $log->id,
        //         'type' => 'stream',

        
        //         ]);
        
           
        //   }
          
        $backlogstatus = DB::table('backlog')->whereIn('id', $backlogIds)->update(['assign_status'=> 1,'quarter'=> $month->quarter_name.' '.$month->year,'epic_start_date' => $request->start_date,'epic_end_date' => $request->end_date]);

        $Quartertotal = 0;
        $totalinitiative = 0;
        $finaltotal  = 0;
    
        $currentDate = Carbon::now();
        $currentYear = $currentDate->year;
        $currentMonth = $currentDate->month;
        $yearMonthString = $currentDate->format('Y');
        $yearMonth = $currentDate->format('F');
        $CurrentQuarter = '';
        $QuarterCount = '';
        $CurrentQuarter = DB::table('quarter_month')->where('initiative_id',$request->locinit)->where('month',$yearMonth)->where('year',$yearMonthString)->first();
    
    $Quarter = DB::table('epics')->where('id',$EpicId)->first();
    if($CurrentQuarter)
    {
    $QuarterCount = DB::table('epics')->where('quarter_id',$CurrentQuarter->quarter_id)->where('trash',NULL)->count();
    $Quarterprogress  = DB::table('epics')->where('quarter_id',$CurrentQuarter->quarter_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    }
    if($QuarterCount > 0)
    {
    $Quartertotal = round(($Quarterprogress / $QuarterCount * 100),2);
    DB::table('quarter')->where('id',$CurrentQuarter->quarter_id)->update(['quarter_progress' => $Quartertotal]);
    DB::table('initiative')->where('id',$CurrentQuarter->initiative_id)->update(['q_initiative_prog' => $Quartertotal]);

    
    }

     
    $initcount = DB::table('initiative')->where('key_id',$request->lockey)->sum('initiative_weight');

    if($initcount == 100)
    {
    $epic = DB::table('epics')->where('id',$EpicId)->first();

    $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
    $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    $totalinitiative =  ($initiativeprogress/$epicinitiativecount); 
    $finaltotal =  ($totalinitiative * 100); 
    
     $intw = DB::table('initiative')->where('id',$epic->initiative_id)->first();
     $resultinit = ($intw->initiative_weight / 100);
     $newresultinit = round(($resultinit * $finaltotal),2);
     DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $newresultinit]);

    }else
    {
        
    $epic = DB::table('epics')->where('id',$EpicId)->first();
    $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
    $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->where('epic_progress','=',100)->count();
    if($epicinitiativecount > 0)
    {
    $totalinitiative =  ($initiativeprogress/$epicinitiativecount); 
    $finaltotal =  ($totalinitiative * 100);
    }
    
    DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $finaltotal]);
    


        
    }

      
  
    
      $objwcount = DB::table('key_result')->where('obj_id',$request->locstate)->sum('weight');
  
     
     if($objwcount == 100)
     {
   
     
     $keycount = DB::table('initiative')->where('key_id',$request->lockey)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->lockey)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  ($totalkey * 100);      
    
     $keyw = DB::table('key_result')->where('id',$request->lockey)->first();
     $result = ($keyw->weight / 100);
     $newresult = intval($result * $finaltotalkey);
      
     DB::table('key_result')->where('id',$request->lockey)->update(['key_prog' => $newresult]);

    
     }else{
     
     
         
     $keycount = DB::table('initiative')->where('key_id',$request->lockey)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->lockey)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  ($totalkey * 100);      
     DB::table('key_result')->where('id',$request->lockey)->update(['key_prog' => $finaltotalkey]);
     
    $QuarterprogressKey  = DB::table('initiative')->where('key_id',$request->lockey)->where('q_initiative_prog','=',100)->count();
    $QuartertotalKey = round(($QuarterprogressKey / $keycount * 100),2);
     DB::table('key_result')->where('id',$request->lockey)->update(['q_key_prog' => $QuartertotalKey]);
     }
     
     $objcount = DB::table('key_result')->where('obj_id',$request->locstate)->count();
     $objprogress  = DB::table('key_result')->where('obj_id',$request->locstate)->where('key_prog','=',100)->count();
     $totalobj =  ($objprogress / $objcount); 
     $finaltotalobj =  ($totalobj * 100); 
     
     DB::table('objectives')->where('id',$request->locstate)->update(['obj_prog' => $finaltotalobj]);
     
      $QuarterprogressObj  = DB::table('key_result')->where('obj_id',$request->locstate)->where('q_key_prog','=',100)->count();
    $QuartertotalObj = round(($QuarterprogressObj / $objcount * 100),2);
    DB::table('objectives')->where('id',$request->locstate)->update(['q_obj_prog' => $QuartertotalObj]);
          
          return redirect()->back()->with('message', 'Backlog Assign Successfully');

    }
    
    
    
    public function ValueChart($id,$type)
    {
     if($type == 'unit')
     {
     $organization = DB::table('business_units')->where('slug',$id)->first();   
     $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$organization->id)->where('type','unit')->get();  
     }
     if($type == 'stream')
     {
     $organization = DB::table('value_stream')->where('slug',$id)->first();   
     $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$organization->id)->where('type','stream')->get();  
     }

     if($type == 'BU')
     {
     $organization  = DB::table('unit_team')->where('slug',$id)->first();
     $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$organization->id)->where('type','BU')->get();  

            
     }

     if($type == 'VS')
     {
     $organization  = DB::table('value_team')->where('slug',$id)->first();
     $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$organization->id)->where('type','VU')->get();  

            
     }
     
     return view('Chart.chart',compact('data','organization','type'));
    }
    
      public function ObjectivesValueTeam($id)
    {
        
    $organization = DB::table('value_stream')->where('slug',$id)->first();
    
    $Team = DB::table('value_team')->where('org_id',$organization->id)->get();
    return view('member.value-streams-team',compact('organization','Team'));  
        
    }
    
   
    
        public function UpdateStreamTeam(Request $request)
    {

        DB::table('value_team')
        ->where('id',$request->id)
        ->update([
            'member' => implode(',',$request->edit_member),
            'lead_id' => $request->edit_lead_manager_team,
            'team_title' => $request->team_title_edit,
            'slug' => Str::slug($request->team_title_edit.'-'.rand(10, 99)),
            
            
            ]);
      
       
        return redirect()->back()->with('message', 'Team Updated Successfully');

    }
    
    public function AssignEpic(Request $request)
    {
    

    $organization = DB::table('value_stream')->where('slug',$request->slug)->first();
    if($request->val == 1)
    {
      $Backlog  =  DB::table('backlog')->where('stream_id',$organization->id)->where('assign_status',1)->get();  
    }
    if($request->val == 0)
    {
      $Backlog  =  DB::table('backlog')->where('stream_id',$organization->id)->where('assign_status',NULL)->get();  
    }
    
     if($request->val == 'all')
    {
      $Backlog  =  DB::table('backlog')->where('stream_id',$organization->id)->get();  
    }
    return view('member.backlog-assign',compact('Backlog','organization'));  
    }
    
    
    public function ObjectivesUnitTeam($id)
    {
    $organization = DB::table('business_units')->where('slug',$id)->first();
    $Team = DB::table('unit_team')->where('org_id',$organization->id)->get();
    return view('Business-units.unit-team',compact('organization','Team'));  
        
    }
    
     public function UnitBacklog($id)
    {
    
    $organization = DB::table('business_units')->where('slug',$id)->first();        
    $Backlog  =  DB::table('backlog_unit')->where('unit_id',$organization->id)->where('assign_status',NULL)->orderBy('position')->get();
    
    Jira::UpdateBujira();
 
    return view('Business-units.unit-backlog',compact('Backlog','organization'));  
        
    }
    
    public function SaveUnitBacklogEpic(Request $request)
    {

     
        DB::table('backlog_unit')
        ->insert([
            'epic_title' => $request->epic_name,
            'epic_start_date' => $request->epic_start_date,
            'epic_end_date' => $request->epic_end_date,
            'epic_status' => $request->epic_status,
            'epic_detail' => $request->epic_description,
            'unit_id' => $request->unit_id,
            
            ]);
      
       
        return redirect()->back()->with('message', 'Backlog Epic Added Successfully');

    }
    
    
    public function UpdateUnitBacklogEpic(Request $request)
    {

     
        DB::table('backlog_unit')
        ->where('id',$request->backlog_id)
        ->update([
            'epic_title' => $request->epic_name,
            'epic_start_date' => $request->epic_start_date,
            'epic_end_date' => $request->epic_end_date,
            'epic_status' => $request->epic_status,
            'epic_detail' => $request->epic_description,
            'team_id' => $request->team,
            
            ]);
      
         $jira = DB::table('backlog_unit')->where('id',$request->backlog_id)->first();
         if($jira->jira_id != '')
         {
         $backlog = DB::table('epics')->where('jira_id',$jira->jira_id)->first();
         if($backlog)
         {
           DB::table('epics')
           ->where('jira_id',$jira->jira_id)
           ->update(['epic_name' => $request->epic_name]);
           
         }
         
    if($jira->jira_id != '')
    {
    $Account = DB::table('jira_setting')->where('user_id',Auth::id())->first();
    $username = $Account->user_name;
    $apiToken = $Account->token;
    $issueKeyOrId = $jira->jira_id;
    $apiEndpoint = "{$Account->jira_url}/rest/api/3/issue/{$issueKeyOrId}";

    $auth = base64_encode("$username:$apiToken");

 
$updateData = [
    "fields" => [
        "description" => [
            "type" => "doc",
            "version" => 1,
            "content" => [
                [
                    "type" => "paragraph",
                    "content" => [
                        [
                            "type" => "text",
                            "text" => $request->epic_description
                        ]
                    ]
                ]
            ]
        ],
        
       "summary" => $request->epic_name, 
    ],
    
     
];

        
        $ch = curl_init($apiEndpoint);
        
        if ($ch === false) {
            die("cURL initialization failed");
        }
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($updateData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Basic {$auth}",
            "Content-Type: application/json",
        ]);
        
        $response = curl_exec($ch);
        
        curl_close($ch);

     }
         
             
         }
 
       
        return redirect()->back()->with('message', 'Backlog Epic Updated Successfully');

    }
    
       public function AssignUnitBacklogEpic(Request $request)
    {

      
          $backlogIds = explode(',', $request->input('backlog_id'));
          
           foreach($backlogIds  as $key => $value)
          {
              
          $log = DB::table('backlog_unit')->where('id',$value)->first();
          foreach($request->end_date  as $key => $value)
          {
        
         $monthName = Carbon::parse($request->end_date[$key])->format('F');
           $month = DB::table('quarter_month')->where('initiative_id',$request->locinit)->where('month',$monthName)->first();
           if(!$month)
           {
            return redirect()->back()->with('message', 'initiative Quarter Month Not Found');
           }
           
            $EpicId = DB::table('epics')->insertGetId([
        
                'epic_status' => $log->epic_status,
                'epic_name' => $log->epic_title,
                'epic_detail' => $log->epic_detail,
                'epic_start_date' => $request->start_date[$key],
                'epic_end_date' => $request->end_date[$key],
                'initiative_id' => $request->locinit,
                'user_id' => Auth::id(),
                'month_id' => $month->id,
                'quarter_id' => $month->quarter_id, 
                'backlog_id' => $log->id,
                 'type' => 'unit',
                 'key_id' => $request->lockey,
                'jira_id' =>  $log->jira_id,
                'account_id' => $log->account_id,
                'jira_project' =>  $log->jira_project,

        
                ]);
           
        //   $backlog = DB::table('backlog_unit')->whereIn('id', $backlogIds)->get();
        //   foreach($backlog as $log)
        //   {
              
        //   $monthName = Carbon::parse($request->end_date)->format('F');
        //   $month = DB::table('quarter_month')->where('initiative_id',$request->locinit)->where('month',$monthName)->first();
        //   if(!$month)
        //   {
        //     return redirect()->back()->with('message', 'initiative Quarter Month Not Found');
        //   }
        //         DB::table('epics')->insert([
        
        //         'epic_status' => $log->epic_status,
        //         'epic_name' => $log->epic_title,
        //         'epic_detail' => $log->epic_detail,
        //         'epic_start_date' => $request->start_date,
        //         'epic_end_date' => $request->end_date,
        //         'initiative_id' => $request->locinit,
        //         'user_id' => Auth::id(),
        //         'month_id' => $month->id,
        //         'quarter_id' => $month->quarter_id, 
        //         'backlog_id' => $log->id,
        //          'type' => 'unit',

        
        //         ]);
        
           
        //   }
        
          }
          
           foreach($request->end_date  as $k => $value)
          {
               DB::table('backlog_unit')->where('id', $value)->update(['epic_start_date' => $request->start_date[$k],'epic_end_date' => $request->end_date[$k]]);
          }
          }
          
        //   $backlogstatus = DB::table('backlog_unit')->whereIn('id', $backlogIds)->update(['assign_status'=> 1,'quarter'=> $month->quarter_name.' '.$month->year]);
                    $backlogstatus = DB::table('backlog_unit')->whereIn('id', $backlogIds)->update(['assign_status'=> 1,'quarter'=> $month->quarter_name.' '.$month->year,'epic_start_date' => $request->start_date,'epic_end_date' => $request->end_date]);

   
    $Quartertotal = 0;
    $totalinitiative = 0;
    $finaltotal  = 0;
    
        $currentDate = Carbon::now();
        $currentYear = $currentDate->year;
        $currentMonth = $currentDate->month;
        $yearMonthString = $currentDate->format('Y');
        $yearMonth = $currentDate->format('F');
        $CurrentQuarter = '';
        $QuarterCount = '';
        $CurrentQuarter = DB::table('quarter_month')->where('initiative_id',$request->locinit)->where('month',$yearMonth)->where('year',$yearMonthString)->first();
    
    $Quarter = DB::table('epics')->where('id',$EpicId)->first();
    if($CurrentQuarter)
    {
    $QuarterCount = DB::table('epics')->where('quarter_id',$CurrentQuarter->quarter_id)->where('trash',NULL)->count();
    $Quarterprogress  = DB::table('epics')->where('quarter_id',$CurrentQuarter->quarter_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    }
    if($QuarterCount > 0)
    {
    $Quartertotal = round(($Quarterprogress / $QuarterCount * 100),2);
    DB::table('quarter')->where('id',$CurrentQuarter->quarter_id)->update(['quarter_progress' => $Quartertotal]);
    DB::table('initiative')->where('id',$CurrentQuarter->initiative_id)->update(['q_initiative_prog' => $Quartertotal]);

    
    }

     
    $initcount = DB::table('initiative')->where('key_id',$request->lockey)->sum('initiative_weight');

    if($initcount == 100)
    {
    $epic = DB::table('epics')->where('id',$EpicId)->first();

    $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
    $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    $totalinitiative =  ($initiativeprogress/$epicinitiativecount); 
    $finaltotal =  ($totalinitiative * 100); 
    
     $intw = DB::table('initiative')->where('id',$epic->initiative_id)->first();
     $resultinit = ($intw->initiative_weight / 100);
     $newresultinit = round(($resultinit * $finaltotal),2);
     DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $newresultinit]);

    }else
    {
        
    $epic = DB::table('epics')->where('id',$EpicId)->first();
    $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
    $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->where('epic_progress','=',100)->count();
    if($epicinitiativecount > 0)
    {
    $totalinitiative =  ($initiativeprogress/$epicinitiativecount); 
    $finaltotal =  ($totalinitiative * 100);
    }
    
    DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $finaltotal]);
    


        
    }

      
  
    
      $objwcount = DB::table('key_result')->where('obj_id',$request->locstate)->sum('weight');
  
     
     if($objwcount == 100)
     {
   
     
     $keycount = DB::table('initiative')->where('key_id',$request->lockey)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->lockey)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  ($totalkey * 100);      
    
     $keyw = DB::table('key_result')->where('id',$request->lockey)->first();
     $result = ($keyw->weight / 100);
     $newresult = intval($result * $finaltotalkey);
      
     DB::table('key_result')->where('id',$request->lockey)->update(['key_prog' => $newresult]);

    
     }else{
     
     
         
     $keycount = DB::table('initiative')->where('key_id',$request->lockey)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->lockey)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  ($totalkey * 100);      
     DB::table('key_result')->where('id',$request->lockey)->update(['key_prog' => $finaltotalkey]);
     
    $QuarterprogressKey  = DB::table('initiative')->where('key_id',$request->lockey)->where('q_initiative_prog','=',100)->count();
    $QuartertotalKey = round(($QuarterprogressKey / $keycount * 100),2);
     DB::table('key_result')->where('id',$request->lockey)->update(['q_key_prog' => $QuartertotalKey]);
     }
     
     $objcount = DB::table('key_result')->where('obj_id',$request->locstate)->count();
     $objprogress  = DB::table('key_result')->where('obj_id',$request->locstate)->where('key_prog','=',100)->count();
     $totalobj =  ($objprogress / $objcount); 
     $finaltotalobj =  ($totalobj * 100); 
     
     DB::table('objectives')->where('id',$request->locstate)->update(['obj_prog' => $finaltotalobj]);
     
      $QuarterprogressObj  = DB::table('key_result')->where('obj_id',$request->locstate)->where('q_key_prog','=',100)->count();
    $QuartertotalObj = round(($QuarterprogressObj / $objcount * 100),2);
    DB::table('objectives')->where('id',$request->locstate)->update(['q_obj_prog' => $QuartertotalObj]);


          return redirect()->back()->with('message', 'Backlog Assign Successfully');

    }
    
       public function UpdateBusinessTeam(Request $request)
    {

     
        DB::table('unit_team')
        ->where('id',$request->id)
        ->update([
            'member' => implode(',',$request->member),
            'lead_id' => $request->lead_manager_team,
            'team_title' => $request->team_title,
            'slug' => Str::slug($request->team_title.'-'.rand(10, 99)),
            
            ]);
      
       
        return redirect()->back()->with('message', 'Team Updated Successfully');

    }
    
       public function AssignEpicBacklog(Request $request)
    {
    

    $organization = DB::table('business_units')->where('slug',$request->slug)->first();
    if($request->val == 1)
    {
      $Backlog  =  DB::table('backlog_unit')->where('unit_id',$organization->id)->where('assign_status',1)->get();  
    }
    if($request->val == 0)
    {
      $Backlog  =  DB::table('backlog_unit')->where('unit_id',$organization->id)->where('assign_status',NULL)->get();  
    }
      if($request->val == 'all')
    {
      $Backlog  =  DB::table('backlog_unit')->where('unit_id',$organization->id)->get();  
    }
    return view('Business-units.assign-backlog',compact('Backlog','organization'));  
    }
  
       public function DeleteBusinessTeam(Request $request)
    {

     
        DB::table('unit_team')->where('id',$request->delete_id)->delete();
      
       
        return redirect()->back()->with('message', 'Team Deleted Successfully');

    }
    
        public function DeleteValueTeam(Request $request)
    {

     
        DB::table('value_team')->where('id',$request->delete_id)->delete();
      
       
        return redirect()->back()->with('message', 'Team Deleted Successfully');

    }
    
        public function DeleteAllMember(Request $request)
    {

     
        $data = DB::table('members')->whereIn('id',$request->selectedOptions)->get();
        
        $members = array();
        foreach($data as $member)
        {
            $members[] = $member->user_id;
        }
        
        DB::table('members')->whereIn('id',$request->selectedOptions)->delete();
        DB::table('users')->whereIn('id',$members)->delete();

      
       
        return redirect()->back()->with('message', 'User Deleted Successfully');

    }
    
       public function SearchMember(Request $request)
    {

        if($request->has('val'))
        {
        $member = DB::table('members')->where('org_user',Auth::id())->where('name', 'like', '%' . $request->val . '%')->get();
        }else
        {
        $member = DB::table('members')->where('org_user',Auth::id())->get();

        }
        return view('Business-units.search-member',compact('member'));  
      
       
    }
    
     public function DeleteBusinessUnits(Request $request)
    {


        $name = DB::table('business_units')->where('id',$request->delete_id)->where('business_name',$request->val)->first();
        
        if(!$name)
        {
        return redirect()->back()->with('message', 'Please Enter Correct Business Units Name');
        }else
        {
        DB::table('business_units')->where('id',$request->delete_id)->delete();
        DB::table('value_stream')->where('unit_id',$request->delete_id)->delete();
        DB::table('objectives')->where('unit_id',$request->delete_id)->delete();
        DB::table('unit_team')->where('org_id',$request->delete_id)->delete();
        return redirect()->back()->with('message', 'Business Units Deleted Successfully');
   
        }
      
       

       

    }
    
     public function DeleteValueStream(Request $request)
    {

     
        DB::table('value_stream')->where('id',$request->delete_id)->delete();
        DB::table('objectives')->where('unit_id',$request->delete_id)->delete();
        DB::table('value_team')->where('org_id',$request->delete_id)->delete();

       
        return redirect()->back()->with('message', 'Value Stream Deleted Successfully');

    }
    
       public function DeleteUnitBacklogEpic(Request $request)
    {

     
        DB::table('backlog_unit')->where('id',$request->delete_id)->delete();
      
       
        return redirect()->back()->with('message', 'Backlog Epic Deleted Successfully');

    }
    
      public function DeleteStreamBacklogEpic(Request $request)
    {

     
        DB::table('backlog')->where('id',$request->delete_id)->delete();
      
       
        return redirect()->back()->with('message', 'Backlog Epic Deleted Successfully');

    }
    
    public function GetMonth(Request $request)
    {

    $currentDate = now();
    $currentMonth = $currentDate->format('F');
    $currentYear = $currentDate->format('Y');
    $data = DB::table('quarter_month')->where('initiative_id',$request->x)->where('month',$currentMonth)->where('year',$currentYear)->first();
    if($data)
    {
    $datanew = DB::table('quarter')->where('id',$data->quarter_id)->first();
    }else
    {
    $data = DB::table('quarter_month')->where('initiative_id',$request->x)->orderby('id','DESC')->first();
    $datanew = DB::table('quarter')->where('id',$data->quarter_id)->first();
    }

    return $datanew;
      
       
    }
    
    
    public function UpdatePosBacklogEpic(Request $request)
    {

      $existsInModelA = DB::table('backlog_unit')->where('id',$request->backlogId)->where('assign_status',NULL)->first();

      if($existsInModelA)
      { 
        $existsOldE = DB::table('backlog_unit')->where('position',$request->newPosition)->where('assign_status',NULL)->first();
        DB::table('backlog_unit')->where('id',$existsOldE->id)->update(['position' => $existsInModelA->position,]);
        DB::table('backlog_unit')->where('id',$request->backlogId)->update(['position' => $request->newPosition,]);
      }
      
      $existsInModelB = DB::table('backlog')->where('id',$request->backlogId)->where('assign_status',NULL)->first();
      
      if($existsInModelB)
      { 
        $existsOld = DB::table('backlog')->where('position',$request->newPosition)->where('assign_status',NULL)->first();
        DB::table('backlog')->where('id',$existsOld->id)->update(['position' => $existsInModelB->position,]);
        DB::table('backlog')->where('id',$request->backlogId)->update(['position' => $request->newPosition,]);
      }

       

    }

    public function CheckemailEdit(Request $request)
    {
     
        $oldemail = User::where('id',$request->member)->first();
        $email = User::where('email',$request->email)->first();

        if($oldemail->email == $email->email)
        {
        echo 1;     
        }else
        {
        echo 2;    
        }

    }


    public static function sendimagetodirectory($imagename)

    {

        $file = $imagename;

        $filename = rand() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('assets/images'), $filename);

        return $filename;

    }
    
  


}