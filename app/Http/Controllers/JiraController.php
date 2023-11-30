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
use Exception;
use Illuminate\Support\Facades\Http;

class JiraController extends Controller
{
    
      public function __construct()
    {
        $this->middleware('auth');
    }
    
     public function jira(Request $request)
    {

     
        $jiraBaclog = DB::table('backlog_unit')->where('jira_project',$request->id)->where('user_id',Auth::id())->where('unit_id','!=',$request->unit_id)->count();
        $jiraBaclogValue = DB::table('backlog')->where('jira_project',$request->id)->where('user_id',Auth::id())->where('stream_id','!=',$request->unit_id)->count();
  
        if($jiraBaclog > 0 || $jiraBaclogValue > 0)
        {
         echo 1;
          
        }else
        {
          
        $data = DB::table('jira_setting')->where('user_id',Auth::id())->where('id',$request->y)->first();
        $jira_url = $data->jira_url ; 
        $jira_user_name = $data->user_name; 
        $jira_token = $data->token;
        
        $jira = new Jira($jira_url,$jira_user_name,$jira_token);
        //get a list of Jira items based on the Jquery
        $items=$jira->Search('project="'.$request->id.'" and issuetype=Epic','key,summary,description');
        //$items=$jira->Search('project="Objectives Epics" and issuetype=Epic',);
        
        
        //print_r($items);
        
        
        foreach ($items as $item)
        {
            
            //Print Epic details
            // print("<br><br>" . $item['key']."<br>");
            // print("  Summary=".$item['fields']['summary']."<br>");
            // print("  Desc=".$item['fields']['description']."<br>");
            // //print("  Created=".$item['fields']['created']."<br>");
            // print("  Startdate=".$item['fields']['customfield_10015']."<br>");
            // print("  Duedate=".$item['fields']['duedate']."<br>");
            // print("  InitiativeID=".$item['fields']['customfield_10051']."<br>");
            // print("  E_Status=".$item['fields']['customfield_10052']['value']."<br>");
            
        
           

            //Print child items key and statuses, plus overall progress in percentage
            // $query = 'parent='.$item['key'];
            // $childitems=$jira->Search($query,'key,summary,status');
            // $count=0;
            // $complete=0;
            // foreach ($childitems as $citem)
            // {
            //     $count++;
            //     if('done'==$citem['fields']['status']['statusCategory']['key'])
            //         $complete++;
                

            // }
            // $item['progress']=0;
            // if ($count > 0)
            // {
            //     $item['progress']=$complete/$count*100;
            // }
            // else
            // {
            //     if('done'==$item['fields']['status']['statusCategory']['key'])
            //         $item['progress']=100;
                
            // }

               
            $jiraa = DB::table('jira_data')->where('jira_id',$item['key'])->where('user_id',Auth::id())->first();
       
            
            if($jiraa)
            {
                DB::table('jira_data')
                ->where('jira_id',$item['key'])
                ->where('user_id',Auth::id())
                ->update([
                    'Summary' =>  $item['fields']['summary'],
                    'jira_id' => $item['key'],
                    'detail' => $item['fields']['description'],
                    'user_id' => Auth::id(),
    
            
                    ]);
               
            }else
            {
                DB::table('jira_data')->insert([

                    'Summary' =>  $item['fields']['summary'],
                    // 'Startdate' => $item['fields']['customfield_10015'],
                    // 'Duedate' => $item['fields']['duedate'],
                    // 'InitiativeID' => $item['fields']['customfield_10051'],
                    // 'E_Status' => $item['fields']['customfield_10052']['value'],
                    'jira_id' => $item['key'],
                    'detail' => $item['fields']['description'],
                    // 'progress' => $item['progress'],
                     'user_id' => Auth::id(),
                     'jira_project' => $request->id,
                     'account_id' => $request->y


    
            
                    ]);
               
            }
               
            
        
        }
        

        
        $jiradata = DB::table('jira_data')->where('user_id',Auth::id())->where('jira_project',$request->id)->get();
        return view('Business-units.jira', compact('jiradata')); 
        
        }
        
        
     
     

    
    }
    
    
        public function AssignJiraEpic(Request $request)
    {

      
          $counter = 0;
          if($request->has('jira_epic'))
          {
          $backlog = DB::table('jira_data')->whereIn('id', $request->input('jira_epic'))->get();
          if($request->type == 'unit')
          {
           $data = DB::table('backlog_unit')->orderby('id','DESC')->where('user_id',Auth::id())->first();
           if($data)
           {
           $counter = $data->position; 
           }
           }
           
          if($request->type == 'stream')
          {
           $data = DB::table('backlog')->orderby('id','DESC')->where('user_id',Auth::id())->first();
           if($data)
           {
           $counter = $data->position; 
           }
           }

           if($request->type == 'BU' || $request->type == 'VS')
           {
           $data = DB::table('team_backlog')->orderby('id','DESC')->where('user_id',Auth::id())->first();
            if($data)
            {
            $counter = $data->position; 
            }
            }
          
          foreach($backlog as $log)
          {
                $counter++;
                if($request->type == 'unit')
                {
                 DB::table('backlog_unit')->insert([
                'epic_status' => $log->E_Status,
                'epic_title' => $log->Summary,
                'epic_detail' => $log->detail,
                'epic_start_date' => $log->Startdate,
                'epic_end_date' => $log->Duedate,
                'jira_id' => $log->jira_id,
                'progress' => $log->progress,
                'unit_id' => $request->backlog_id,
                'jira_project' => $request->jira_project,
                 'user_id' => Auth::id(),
                 'position' => $counter,
                 'account_id' => $log->account_id, 


                ]);
                }
                
                 if($request->type == 'stream')
                {
                 DB::table('backlog')->insert([
                'epic_status' => $log->E_Status,
                'epic_title' => $log->Summary,
                'epic_detail' => $log->detail,
                'epic_start_date' => $log->Startdate,
                'epic_end_date' => $log->Duedate,
                'jira_id' => $log->jira_id,
                'progress' => $log->progress,
                'stream_id' => $request->backlog_id,
                'jira_project' => $request->jira_project,
                'user_id' => Auth::id(),
                 'position' => $counter,
                 'account_id' => $log->account_id, 



                ]);
                }

                if($request->type == 'BU' || $request->type == 'VS')
                {
                 DB::table('team_backlog')->insert([
                'epic_status' => $log->E_Status,
                'epic_title' => $log->Summary,
                'epic_detail' => $log->detail,
                'epic_start_date' => $log->Startdate,
                'epic_end_date' => $log->Duedate,
                'jira_id' => $log->jira_id,
                'progress' => $log->progress,
                'unit_id' => $request->backlog_id,
                'jira_project' => $request->jira_project,
                'user_id' => Auth::id(),
                 'position' => $counter,
                 'account_id' => $log->account_id,
                 'type' => $request->type,  



                ]);
                }
               
        
           
          }
          
          DB::table('jira_setting')->where('user_id',Auth::id()) ->update(['sync' => $request->flex]);
          
          }
          
          return redirect()->back()->with('message', 'Jira Connect Successfully');

    }
    
    public function JiraSetting()
     {
         
      $Jiradata = DB::table('jira_setting')->where('user_id',Auth::id())->get();
       return view('Business-units.jira-setting',compact('Jiradata'));  
     }
     
     public function AddJiraSetting(Request $request)
     {
         

      DB::table('jira_setting')
      ->insert([
        'user_name' => $request->user_name, 
        'token' => $request->token,
        'jira_url' => $request->jira_url, 
        'jira_name' => $request->jira_name,
        'user_id' => Auth::id(),  


        ]);
        
        
       
      return redirect()->back()->with('message', 'Jira Connect Successfully');
     }
     
     public function UpdateJiraSetting(Request $request)
     {
         

       DB::table('jira_setting')
      ->where('id',$request->jira_id)
      ->update([
        'user_name' => $request->user_name, 
        'token' => $request->token,
        'jira_url' => $request->jira_url, 
        'jira_name' => $request->jira_name,
        'user_id' => Auth::id(),  


        ]);
       
      return redirect()->back()->with('message', 'Jira Connect Updated Successfully');
     }
     
      public function DeleteJiraSetting(Request $request)
     {
         

       DB::table('jira_setting')->where('id',$request->delete_id)->delete();
       
      return redirect()->back()->with('message', 'Jira Connect Deleted Successfully');
     }
    
    
    public function AddFinancialYear(Request $request)
    {

      DB::table('organization')
      ->where('user_id',Auth::id())
      ->update([
        'month' => $request->month,  
        ]);

      return redirect()->back();

    
    }
    
     public function JiraProject(Request $request)
    {

      
        $data = DB::table('jira_setting')->where('user_id',Auth::id())->where('id',$request->id)->first();
        $jira_url = $data->jira_url; 
        $jira_user_name = $data->user_name; 
        $jira_token = $data->token;
        $apiEndpoint = $data->jira_url.'/rest/api/2/project';

        $username = $data->user_name;
        $apiToken = $data->token;
        
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode("$username:$apiToken"),
        ])->get($apiEndpoint);
        
        if ($response->successful()) {
            $projects = $response->json();
            
        foreach ($projects as $project) 
        {
       
         
         $jiraProject = DB::table('jira_project')->where('user_id',Auth::id())->where('project_name',$project['name'])->first();
            
            if($jiraProject)
            {
                DB::table('jira_project')
                ->where('user_id',Auth::id())
                ->where('project_name',$project['name'])
                ->update([
                    'project_name' => $project['name'],
                    'user_id' => Auth::id(),
    
            
                    ]);
               
            }else
            {
                DB::table('jira_project')->insert([
                    'project_name' => $project['name'],
                     'user_id' => Auth::id(),
            
                    ]);
               
            }
        
        
         
         }
         
         $jiraProjectdata = DB::table('jira_project')->where('user_id',Auth::id())->get();
         return $jiraProjectdata;
        
         
       
            
        } else {
            
            $errorMessage = $response->json();
            return $errorMessage;
            
        }
        
    
    }
    
      public function UpdateBujira()
    {

     
        $jiraBaclog = DB::table('backlog_unit')->where('jira_id','!=','')->get();

        foreach ($jiraBaclog as $backlog)
        {
            
        $data = DB::table('jira_setting')->where('id',$backlog->account_id)->first();
        $jira_url = $data->jira_url ; 
        $jira_user_name = $data->user_name; 
        $jira_token = $data->token;
        
        $jira = new Jira($jira_url,$jira_user_name,$jira_token);
        $items=$jira->Search('project="'.$backlog->jira_project.'" and issuetype=Epic','key,summary,description');
        
        foreach ($items as $item)
        {
         
                DB::table('backlog_unit')
                ->where('jira_id',$item['key'])
                ->update([
                    'epic_title' =>  $item['fields']['summary'],
                    'epic_detail' => $item['fields']['description'],

            
                    ]);   
        
        
        }
        
        }
       

    
    }

}